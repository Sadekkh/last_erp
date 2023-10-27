    <form action="{{ route('productStore') }}" method="post" enctype="multipart/form-data">
        @csrf


        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">{{ __('category') }}</label>

                    <select class="form-control selectpicker" name="category_id" data-live-search="true">
                        @foreach ($category as $d)
                            <option data-tokens="{{ $d->name_en }}" value="{{ $d->id }}">{{ $d->name_en }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">{{ __('type') }}</label>
                    <select class="form-control selectpicker" id="type" name="type" data-live-search="true">

                        <option data-tokens="service" value="service">{{ __('servicy') }}</option>
                        <option data-tokens="product" value="product">{{ __('producty') }}</option>

                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">{{ __('name_ar') }}</label>

                    <input type="text" class="form-control" name="name_ar">

                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">{{ __('name_en') }}</label>

                    <input type="text" class="form-control" name="name_en">

                </div>
            </div>

        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">{{ __('description_ar') }}</label>
                    <input type="text" class="form-control" name="description_ar">

                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">{{ __('description_en') }}</label>
                    <input type="text" class="form-control" name="description_en">

                </div>
            </div>
        </div>
        <div id="service" style="display: none;">
            <div class="row">

                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('unit') }}</label>
                        <select class="form-control selectpicker" name="unit" data-live-search="true">

                            <option data-tokens="service" value="job">{{ __('job') }}</option>
                            <option data-tokens="service" value="day">{{ __('day') }}</option>
                            <option data-tokens="service" value="hour">{{ __('hour') }}</option>

                        </select>

                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('price') }}</label>
                        <input type="number" class="form-control" name="price">

                    </div>
                </div>


            </div>
        </div>
        <div id="product" style="display: none;">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('garages') }}</label>

                        <select class="form-control selectpicker" name="garage_id" data-live-search="true">
                            @foreach ($garage as $d)
                                <option data-tokens="{{ $d->name_en }}" value="{{ $d->id }}">{{ $d->name_en }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('brand') }}</label>
                        <select class="form-control selectpicker" name="brand_id" data-live-search="true">
                            @foreach ($brand as $d)
                                <option data-tokens="{{ $d->name_en }}" value="{{ $d->id }}">{{ $d->name_en }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('model') }}</label>

                        <input type="text" class="form-control" name="model">

                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('min_quantity_stored') }}</label>
                        <input type="number" class="form-control" name="min_quantity_stored">

                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('max_quantity_stored') }}</label>
                        <input type="number" class="form-control" name="max_quantity_stored">

                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('selling_price ') }}</label>
                        <input type="number" class="form-control" name="selling_price">

                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('min_purchase_price') }}</label>
                        <input type="number" class="form-control" name="min_purchase_price">

                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('max_purchase_price') }}</label>
                        <input type="number" class="form-control" name="max_purchase_price">

                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('selling_price ') }}</label>
                        <input type="number" class="form-control" name="selling_price ">

                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('transport_price') }}</label>
                        <input type="number" class="form-control" name="transport_price">

                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('request_type') }}</label>
                        <select class="form-control" name="request_type" id="">
                            <option value="by_agent">by_agent</option>
                            <option value="by_factory">by_factory</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('weight') }}</label>
                        <input type="number" class="form-control" name="weight">

                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('unit') }}</label>
                        <select class="form-control" name="unit" id="">
                            <option value="piece">piece</option>
                            <option value="litre">litre</option>
                            <option value="kilo">kilo</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('visibility') }}</label>
                        <select class="form-control" name="state" id="">
                            <option value="active">active</option>
                            <option value="inactive">inactive</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('weight') }}</label><br>
                        <select class="selectpicker" name="color[]" multiple data-selected-text-format="count">
                            <option value="red">{{ __('red') }}</option>
                            <option value="green">{{ __('green') }}</option>
                            <option value="black">{{ __('black') }}</option>
                            <option value="yellow">{{ __('yellow') }}</option>
                            <option value="white">{{ __('white') }}</option>

                        </select>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="recipient-name" class="col-form-label">{{ __('images') }}</label>
                <input type="file" class="form-control-file" name="image[]" multiple>
            </div>
            <div class="col"><button type="submit" class="btn btn-success">{{ __('save') }}</button></div>
        </div>


    </form>
