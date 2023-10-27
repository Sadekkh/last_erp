@extends('layouts.main')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/bs-select.css') }}">
@endsection
@section('content')
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="nav-tabs-container">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{ __('edit') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">{{ __('stockeditem') }}</a>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <form action="{{ route('update_stock', $data->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('product') }}</label>
                                        <input class="form-control" disabled value="{{ $data->product->{'name' . localePrefix()} }}">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('brand') }}</label>

                                        <select class="form-control selectpicker" name="brand_id" data-live-search="true">
                                            <option data-tokens="" value=""></option>
                                            @foreach ($brand as $d)
                                                <option @if ($data->brand_id == $d->id) selected @endif value="{{ $d->id }}">{{ $d->{'name' . localePrefix()} }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('supplier') }}</label>

                                        <select class="form-control selectpicker" name="supplier_id" data-live-search="true">
                                            @foreach ($supplier as $d)
                                                <option @if ($data->supplier_id == $d->id) selected @endif data-tokens="{{ $d->{'supplier_name' . localePrefix()} }}" value="{{ $d->id }}">{{ $d->{'supplier_name' . localePrefix()} }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('price') }}</label>
                                        <input type="number" class="form-control" value="{{ $data->price }}" name="price">

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('tax') }}</label>
                                        <input type="number" class="form-control" value="{{ $data->tax }}" name="tax">

                                    </div>
                                </div>
                            </div>
                            <div class="row">


                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('purchase_date') }}</label>
                                        <input type="date" class="form-control" value="{{ $data->purchase_date }}" name="purchase_date">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('reference') }}</label>
                                        <input type="text" class="form-control" value="{{ $data->reference }}" name="reference">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('rows') }}</label>
                                        <input type="text" class="form-control" value="{{ $data->rows }}" name="rows">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('columns') }}</label>
                                        <input type="text" class="form-control" value="{{ $data->columns }}" name="columns">

                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('expiry_date') }}</label>
                                        <input type="date" class="form-control" value="{{ $data->expiry_date }}" name="expiry_date">

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('guarantee_expiry_date') }}</label>
                                        <input type="date" class="form-control" value="{{ $data->guarantee_expiry_date }}" name="guarantee_expiry_date">

                                    </div>
                                </div>
                            </div>


                            <div class="row">

                                <div class="col"><button type="submit" class="btn btn-success">{{ __('save') }}</button></div>
                            </div>


                        </form>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="table-responsive">
                            <table id="copy-print-csv" class="table custom-table">
                                <thead>
                                    <tr>
                                        <th>{{ __('serial_number') }}</th>
                                        <th>{{ __('state') }}</th>
                                        <th></th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data->stockeditem as $d)
                                        <tr>

                                            <td>{{ $d->serial_num }}</td>
                                            <td>{{ __($d->state) }}</td>
                                            <td> <button data-product-id="{{ $d->id }}" class="btn btn-primary generateQRCodeButton"><span class="icon-radio_button_checked"></span></button>
                                            </td>


                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <div id="qrcodeDiv" hidden>

    </div>
@endsection
@section('script')
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
