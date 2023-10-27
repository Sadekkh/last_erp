@extends('layouts.main')
@section('styles')
    <link rel="stylesheet" href="{{ asset('datatables/dataTables.bs4.css') }}" />
    <link rel="stylesheet" href="{{ asset('datatables/dataTables.bs4-custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('datatables/buttons.bs.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bs-select.css') }}">
@endsection
@section('content')
    <div class="table-container">
        <div class="table-responsive">
            <table id="fixedHeader" class="table custom-table">
                <thead>
                    <tr>
                        <th>{{ __('product') }}</th>
                        <th>{{ __('purchase_date') }}</th>
                        <th>{{ __('expiry_date') }}</th>
                        <th>{{ __('guarantee_expiry_date') }}</th>
                        <th>{{ __('unit_stocked') }}</th>
                        <th>{{ __('unit_left') }}</th>
                        <th>{{ __('rows') }}</th>
                        <th>{{ __('columns') }}</th>
                        <th>{{ __('serial_number') }}</th>
                        <th>{{ __('state') }}</th>
                        <th></th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                        <tr>

                            <td>{{ $d->product->{'name' . localePrefix()} }}</td>
                            <td>{{ $d->stock->purchase_date }}</td>
                            <td>{{ $d->stock->expiry_date }}</td>
                            <td>{{ $d->stock->guarantee_expiry_date }}</td>
                            <td>{{ $d->unit_storage }}-{{ $d->product->productdetail[0]->unit }}</td>
                            <td>{{ $d->unit_left }}-{{ $d->product->productdetail[0]->unit }}</td>
                            <td>{{ $d->stock->rows }}</td>
                            <td>{{ $d->stock->columns }}</td>

                            <td>{{ $d->serial_num }}</td>
                            <td>{{ __($d->state) }}</td>
                            <td> <button data-product-id="{{ $d->id }}" class="btn btn-primary generateQRCodeButton">{{ __('qrcode') }}</button>
                            </td>


                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <div id="qrcodeDiv" hidden>

    </div>
@endsection
@section('script')
    <script src="{{ asset('datatables/dataTables.min.js') }}"></script>
    <script src="{{ asset('datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('datatables/custom/custom-datatables.js') }}"></script>
    <script src="{{ asset('datatables/custom/fixedHeader.js') }}"></script>
    <script src="{{ asset('datatables/buttons.min.js') }}"></script>
    <script src="{{ asset('datatables/html5.min.js') }}"></script>

    <script src="{{ asset('js/bs-select.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $(".generateQRCodeButton").click(function() {
                var productId = $(this).data("product-id");

                $.ajax({
                    url: "/stock/qrcode/" + productId,
                    type: "GET",
                    success: function(data) {
                        console.log(data)
                        let data2 = data.qrcode.slice(39);
                        console.log(data2)
                        var img = new Image();

                        // Set the source of the image to the SVG data
                        img.src = 'data:image/svg+xml,' + encodeURIComponent(data2);

                        // Get the div where you want to display the image
                        var qrcodeDiv = document.getElementById('qrcodeDiv');
                        qrcodeDiv.innerHTML = ''; // Clear the div before appending

                        // Append the image to the div
                        qrcodeDiv.appendChild(img);

                        var mywindow = window.open('', 'PRINT', 'height=600,width=600');

                        mywindow.document.write('<html><head><title></title>');
                        mywindow.document.write('<style>');
                        mywindow.document.write('@page { size:4.5cm 7cm;scale: 178; }'); // Set the page size to 'auto'
                        mywindow.document.write('</style>');
                        mywindow.document.write('</head><body >');
                        mywindow.document.write('<h3 style="text-align:center; color:blue"">' + data.product.product.name_en + '</h3>');
                        mywindow.document.write(qrcodeDiv.innerHTML);
                        mywindow.document.write('<h3 style="text-align:center; color:blue"">' + data.product.serial_num + '</h3>');
                        mywindow.document.write('</body></html>');

                        mywindow.document.close();
                        mywindow.focus();

                        mywindow.print();
                        mywindow.close();

                        return true;

                    }

                });
            });

        });
    </script>
@endsection
