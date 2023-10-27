@extends('layouts.main')
@section('styles')
@endsection
@section('content')
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <div class="row">
                <div class="col">
                    <div id="reader" width="600px"></div>
                </div>
                <div class="col">
                    <form action="{{ url('/add_stock_item') }} " method="post">

                        @csrf
                        <div class="row">
                            <div class="col">
                                <h5 id="product_name"></h5>
                                <input type="text" name="stocked_item_id" id="prod" hidden>
                            </div>
                            <div class="col">
                                <h5 id="maintenanceOrder"></h5>
                                <input type="text" name="maintenance_orders_id" id="main" hidden>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">{{ __('worker') }}</label>

                                    <select class="form-control selectpicker" name="worker_id" data-live-search="true">
                                        @foreach ($worker as $d)
                                            <option data-tokens="{{ $d->{'name' . localePrefix()} }}" value="{{ $d->id }}">{{ $d->{'name' . localePrefix()} }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">{{ __('for') }}</label>

                                    <select class="form-control selectpicker" name="for" data-live-search="true">

                                        <option data-tokens="{{ __('truck') }}" value="truck">{{ __('truck') }}</option>
                                        <option data-tokens="{{ __('trailer') }}" value="trailer">{{ __('trailer') }}</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col" id="quan" style="display: none">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">{{ __('quantity') }}</label>
                                    <input type="number" class="form-control" value="1" name="quantity_taken">

                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">{{ __('add') }}</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('script')
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like, for example:
            console.log(decodedResult.result)
            var x = decodedResult.result.text
            let y = x.replaceAll("'", '"');
            const jsonObject = JSON.parse(y);
            console.log(jsonObject);
            const type = jsonObject.type;

            if (type == 'product') {
                const unit = jsonObject.unit
                const productName = jsonObject.productname;
                const id = jsonObject.id;
                $('#product_name').html(productName)
                $('#prod').val(id)
                if (unit != 'piece') {
                    $('#quan').show()

                }

            } else if (type == 'maintenanceOrder') {
                const code = jsonObject.code;
                const id = jsonObject.id;
                $('#maintenanceOrder').html(code)
                $('#main').val(id)
            }
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                }
            },
            /* verbose= */
            false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
@endsection
