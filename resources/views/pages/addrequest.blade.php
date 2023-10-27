@extends('layouts.main')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/bs-select.css') }}">
@endsection
@section('content')
    <div class="nav-tabs-container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
            </li>

        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                        <form action="{{ route('addrequest') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('deal') }}</label>

                                        <select class="form-control selectpicker" name="deal_id" data-live-search="true">
                                            @foreach ($deal as $d)
                                                <option data-tokens="{{ $d->{'name' . localePrefix()} }}" value="{{ $d->productdetail[0]->id }}">{{ $d->{'name' . localePrefix()} }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('date') }}</label>

                                        <input type="date" class="form-control" name="date">

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('delay_to') }}</label>
                                        <input type="date" class="form-control" name="delay_to">

                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('payment') }}</label>

                                        <select class="form-control selectpicker" name="payment" data-live-search="true">

                                            <option data-tokens="{{ __('cash') }}" value="cash">{{ __('cash') }}</option>
                                            <option data-tokens="{{ __('transaction') }}" value="transaction">{{ __('transaction') }}</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('cuurency') }}</label>

                                        <select class="form-control selectpicker" name="currency" data-live-search="true">

                                            <option data-tokens="{{ __('SR') }}" value="SR">{{ __('SR') }}</option>

                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row">

                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('announcement') }}</label>
                                        <input type="text" class="form-control" name="announcement">

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('cash_account') }}</label>
                                        <input type="text" class="form-control" name="cash_account">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('refrence') }}</label>
                                        <input type="text" class="form-control" name="refrence">

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('refrence_number') }}</label>
                                        <input type="text" class="form-control" name="refrence_number">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('refrence_date') }}</label>
                                        <input type="date" class="form-control" name="refrence_date">

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('supply') }}</label>
                                        <input type="date" class="form-control" name="supply">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('sales_emp') }}</label>
                                        <input type="text" class="form-control" name="sales_emp">

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('side_project') }}</label>
                                        <input type="date" class="form-control" name="side_project">

                                    </div>
                                </div>
                            </div>



                            <div class="row">

                                <div class="col"><button type="submit" class="btn btn-success">{{ __('save') }}</button></div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                        <form id="add_request" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('request') }}</label>

                                        <select class="form-control selectpicker" id="request" name="request_id" data-live-search="true">
                                            @foreach ($req as $d)
                                                <option data-tokens="{{ $d->code }}" value="{{ $d->id }}">{{ $d->code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('product') }}</label>

                                        <select class="form-control selectpicker" id="product" name="product_id" data-live-search="true">
                                            @foreach ($product as $d)
                                                <option data-tokens="{{ $d->{'name' . localePrefix()} }}" value="{{ $d->id }}">{{ $d->{'name' . localePrefix()} }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('supplier') }}</label>
                                        <select class="form-control selectpicker" id="supplier" name="supplier_id" data-live-search="true">
                                            @foreach ($supplier as $d)
                                                <option data-tokens="{{ $d->{'supplier_name' . localePrefix()} }}" value="{{ $d->id }}">{{ $d->{'supplier_name' . localePrefix()} }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('price') }}</label>
                                        <select class="form-control selectpicker" id="approx_price" name="approx_price" data-live-search="true">

                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('quantity_requested') }}</label>

                                        <input type="number" class="form-control" id="quantity_requested" name="quantity_requested">

                                    </div>
                                </div>

                            </div>
                            <div class="row">

                                <div class="col"><button id="add_btn" class="btn btn-success">{{ __('save') }}</button></div>
                            </div>


                        </form>
                        <div class="table-responsive">
                            <table class="table table-lg" id="tableList">
                                <thead>
                                    <tr>
                                        <th>{{ __('product') }}</th>
                                        <th>{{ __('supplier') }}</th>
                                        <th>{{ __('quantity') }}</th>
                                        <th>{{ __('price') }}</th>
                                        <th>{{ __('total') }}</th>

                                    </tr>
                                </thead>
                                <tbody>




                                </tbody>
                            </table>
                        </div>

                        <div class="card-body">
                            <div class="d-md-flex flex-md-wrap">


                                <div class="pt-2 mb-3 wmin-md-400 ml-auto">
                                    <h6 class="mb-3 text-left">{{ __('invoice') }}</h6>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th class="text-left">{{ __('Subtotal') }}:</th>
                                                    <td class="text-right"><span id="subtotal"></span></td>
                                                </tr>
                                                <tr>
                                                    <th class="text-left">{{ __('Tax:') }} </th>
                                                    <td class="text-right"><span id="tax"></span>{{ $settings[0]->value }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-left">{{ __('plafon:') }} </th>
                                                    <td class="text-right"><span id="plafon">{{ $garage->plafon }}</span></td>
                                                </tr>
                                                <tr>
                                                    <th class="text-left">{{ __('left:') }}</th>
                                                    <td class="text-right text-primary">
                                                        <h5 class="font-weight-semibold"><span id="left"></span></h5>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="text-right mt-3">

                                        <button type="button" id="confirmrequest" class="btn btn-primary"><b><i class="fa fa-paper-plane-o mr-1"></i></b> {{ _('confirm') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="footerCenterIconsModal" tabindex="-1" role="dialog" aria-labelledby="footerCenterIconsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="footerCenterIconsModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table" id="suggestions"></table>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="icon-close"></i></button>
                    <button type="button" class="btn btn-primary"><i class="icon-check2"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="stopit" tabindex="-1" role="dialog" aria-labelledby="footerCenterIconsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="footerCenterIconsModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('error.png') }}" style="width: 18rem;margin-left:6rem;margin-right:6rem" alt="">
                    <h3 style="color: red;text-align:center">{{ __('you_cant_add_more') }}</h3>
                </div>
                <div class="modal-footer justify-content-center">
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/bs-select.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $('#supplier').on('change', function() {
                const id = $(this).val();
                const prod = $('#product').val();
                $('#approx_price').empty();
                $.ajax({
                    type: 'GET',
                    url: '/suggestedprice/' + id + '/' + prod,
                    success: function(data) {
                        console.log(data);
                        $('#approx_price').append('<option value="' + data[1][0].max_quantity_stored + '">' + data[1][0].max_quantity_stored + '</option>');

                        $.each(data[0], function(key, value) {
                            $('#approx_price').append('<option value="' + value.price + '">' + value.price + '</option>');
                        });
                        $('#approx_price').selectpicker('refresh');
                    }
                });
            });
        });
        $(document).ready(function() {
            $('#product').on('change', function() {
                var id = $(this).val();
                $('#suggestions').empty();
                $('#approx_price').empty();
                $('#approx_price').selectpicker('refresh');
                $.ajax({
                    type: 'GET',
                    url: '/get-product_history/' + id,
                    success: function(data) {

                        if (data.length > 0) {
                            $('#footerCenterIconsModal').modal('show');
                            $.each(data, function(key, value) {
                                $('#suggestions').append('<tr><td>' + value.supplier.supplier_name_en + '</td><td>' + value.price + '</td><td>' + value.purchase_date + '</td><tr>');
                            });
                        }
                    }
                });
            });
        });
        $(document).ready(function() {
            $('#request').on('change', function() {
                var id = $(this).val();
                $('#tableList tbody').empty();
                $.ajax({
                    type: 'GET',
                    url: '/get-request_list/' + id,

                    success: function(data) {

                        let subtotal = 0;
                        $.each(data, function(key, value) {

                            let total = value.quantity_requested * value.approx_price;
                            subtotal += total;
                            $('#tableList tbody').append('<tr><td>' + value.product.name_en + '</td><td><h6>' + value.supplier.supplier_name_en + '</h6><span class="text-muted">' + value.supplier.address_en + '</span></td>' +
                                '<td>' + value.quantity_requested + '</td>' +
                                '<td><span class="font-weight-semibold">' + value.approx_price + '</span></td>' +
                                '<td><span class="font-weight-semibold">' + total + '</span></td></tr>');
                        });
                        $('#subtotal').html(subtotal);
                        let plafon = parseInt($('#plafon').text())
                        $('#left').html(plafon - subtotal)
                        console.log(plafon);
                    }
                });
            });
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $('#confirmrequest').on('click', function() {
                var id = $('#request').val();

                $.ajax({
                    type: 'post',
                    url: '/confirmrequest/' + id,

                    success: function(data) {

                        window.location.reload();
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#add_btn').on('click', function() {
                event.preventDefault();
                let total = parseInt($('#subtotal').text())
                let plafon = parseInt($('#plafon').text())
                let approx_price = parseInt($('#approx_price').text())
                let requested = parseInt($('#quantity_requested').val())

                const left = plafon - total - approx_price * requested;
                console.log(left, total, plafon, approx_price, requested);
                if (left > 0) {
                    total += approx_price * requested;
                    $('#subtotal').html(total)
                    $('#left').html(left)
                    var formData = new FormData($('#add_request')[0]);
                    $.ajax({
                        url: '{{ route('add_req_item') }}',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            console.log(data);
                            $('#succ-message').show();
                            setTimeout(function() {
                                $('#succ-message').hide();
                            }, 1000); // Adjust the duration as needed
                            let total = data.quantity_requested * data.product.productdetail[0].max_purchase_price;
                            console.log(total)
                            $('#tableList tbody').append('<tr><td>' + data.product.name_en + '</td><td><h6>' + data.supplier.supplier_name_en + '</h6><span class="text-muted">' + data.supplier.address_en + '</span></td>' +
                                '<td>' + data.quantity_requested + '</td>' +
                                '<td><span class="font-weight-semibold">' + data.product.productdetail[0].max_purchase_price + '</span></td>' +
                                '<td><span class="font-weight-semibold">' + total + '</span></td></tr>');

                        },
                        error: function(xhr, status, error) {
                            $('#error-message').show();

                            // Set a timer to hide the success message after 3 seconds (3000 milliseconds)
                            setTimeout(function() {
                                $('#error-message').hide();
                            }, 1000); // Adjust the duration as needed
                        }
                    });
                } else {
                    $('#stopit').modal('show');
                }

            });

        });
    </script>
@endsection
