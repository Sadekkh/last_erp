@extends('layouts.main')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/bs-select.css') }}">
@endsection
@section('content')
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <form action="{{ route('addstock', $data->id) }}" method="post" enctype="multipart/form-data">
                @csrf

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
                                @foreach ($brand as $d)
                                    <option data-tokens="{{ $d->{'name' . localePrefix()} }}" value="{{ $d->id }}">{{ $d->{'name' . localePrefix()} }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">{{ __('supplier') }}</label>

                            <select class="form-control selectpicker" name="supplier_id" data-live-search="true">
                                @foreach ($supplier as $d)
                                    <option data-tokens="{{ $d->{'supplier_name' . localePrefix()} }}" value="{{ $d->id }}">{{ $d->{'supplier_name' . localePrefix()} }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">{{ __('price') }}/{{ $data->product->productdetail[0]->unit }}</label>
                            <input type="number" class="form-control" name="price">

                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">{{ __('tax') }}</label>
                            <input type="number" class="form-control" name="tax">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">{{ __('stocked_quantity') }}</label>
                            <input type="number" class="form-control" id="quantity" name="stocked_quantity">
                        </div>
                    </div>
                    @if ($data->product->productdetail[0]->unit != 'piece')
                        <div class="col">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">{{ __('unit_storage') }}</label>
                                <input type="number" class="form-control" name="unit_storage">
                            </div>
                        </div>
                    @endif

                    <div class="col">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">{{ __('purchase_date') }}</label>
                            <input type="date" class="form-control" name="purchase_date">
                        </div>
                    </div>

                </div>
                <div class="row">

                    <div class="col">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">{{ __('reference') }}</label>
                            <input type="text" class="form-control" name="reference">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">{{ __('rows') }}</label>
                            <input type="text" class="form-control" name="rows">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">{{ __('columns') }}</label>
                            <input type="text" class="form-control" name="columns">

                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">{{ __('expiry_date') }}</label>
                            <input type="date" class="form-control" name="expiry_date">

                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">{{ __('guarantee_expiry_date') }}</label>
                            <input type="date" class="form-control" name="guarantee_expiry_date">

                        </div>
                    </div>
                </div>
                <div class="row" id="serialNumbers">
                    <label for="recipient-name" class="col-form-label">{{ __('serial_numbers') }}</label>

                </div>

                <div class="row">

                    <div class="col"><button type="submit" class="btn btn-success">{{ __('save') }}</button></div>
                </div>


            </form>
        </div>
    </div>
    <br>
@endsection
@section('script')
    <script src="{{ asset('js/bs-select.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $("#quantity").change(function() {
                var quantity = $("#quantity").val();
                var serialNumbersContainer = $("#serialNumbers");

                // Clear any previous input fields
                serialNumbersContainer.empty();

                for (var i = 1; i <= quantity; i++) {
                    var inputField = $('<input class="form-control" type="text" name="serial_number[]"><br> ');
                    serialNumbersContainer.append(inputField);
                }
            });
        });
    </script>
@endsection
