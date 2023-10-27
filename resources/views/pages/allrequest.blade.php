@extends('layouts.main')
@section('styles')
    <link rel="stylesheet" href="{{ asset('datatables/dataTables.bs4.css') }}" />
    <link rel="stylesheet" href="{{ asset('datatables/dataTables.bs4-custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('datatables/buttons.bs.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bs-select.css') }}">
    <style>
        @page {
            size: 10cm 10cm;
            scale: 188;
        }
    </style>
@endsection
@section('content')
    <div class="row gutters">
        <div class="table-responsive">
            <table id="fixedHeader" class="table custom-table">
                <thead>
                    <tr>
                        <th>{{ __('garage') }}</th>
                        <th>{{ __('code') }}</th>
                        <th>{{ __('date') }}</th>
                        <th>{{ __('state') }}</th>
                        <th>{{ __('totalprice') }}</th>
                        <th>{{ __('number_of_items') }}</th>
                        <th>{{ __('edit') }}</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                        <tr>
                            <td>{{ $d->garage->{'name' . localePrefix()} }}</td>
                            <td>{{ $d->code }}</td>
                            <td>{{ $d->date }}</td>
                            <td>{{ $d->state }}</td>
                            <td>
                                @if (!$d->totalQuantity->isEmpty())
                                    {{ $d->totalQuantity[0]->totalprice }}
                                @else
                                    0
                                @endif
                            </td>

                            <td>
                                @if (!$d->totalitems->isEmpty())
                                    {{ $d->totalitems[0]->totalitem }}
                                @else
                                    0
                                @endif
                            </td>

                            <td><a href="{{ route('edit_request', $d->id) }}" class="btn btn-primary btn-sm ">{{ __('edit') }}</a>
                                <a href="{{ route('restriction', $d->id) }}" class="btn btn-primary btn-sm ">{{ __('restriction') }}</a>
                                <a href="{{ route('printrequest', $d->id) }}" class="btn btn-primary btn-sm ">{{ __('print') }}</a>
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
    <script src="{{ asset('datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('datatables/html5.min.js') }}"></script>
    <script src="{{ asset('datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/bs-select.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".generateQRCodeButton").click(function() {
                var productId = $(this).data("product-id");

                $.ajax({
                    url: "/products/qrcode/" + productId,
                    type: "GET",
                    success: function(data) {
                        let data2 = data.slice(42);
                        console.log(data)
                        console.log(data2)
                        var img = new Image();

                        // Set the source of the image to the SVG data
                        img.src = 'data:image/svg+xml,' + encodeURIComponent(data2);

                        // Get the div where you want to display the image
                        var qrcodeDiv = document.getElementById('qrcodeDiv');
                        qrcodeDiv.innerHTML = ''; // Clear the div before appending

                        // Append the image to the div
                        qrcodeDiv.appendChild(img);

                        var mywindow = window.open('', 'PRINT', 'height=400,width=600');

                        mywindow.document.write('<html><head><title></title>');
                        mywindow.document.write('<style>');
                        mywindow.document.write('@page { size:4.5cm 4.5cm;scale: 178; }'); // Set the page size to 'auto'
                        mywindow.document.write('</style>');
                        mywindow.document.write('</head><body >');
                        mywindow.document.write(qrcodeDiv.innerHTML);
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
