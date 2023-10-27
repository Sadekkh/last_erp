@extends('layouts.main')
@section('styles')
    <link rel="stylesheet" href="{{ asset('datatables/dataTables.bs4.css') }}" />
    <link rel="stylesheet" href="{{ asset('datatables/dataTables.bs4-custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('datatables/buttons.bs.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bs-select.css') }}">
@endsection
@section('content')
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="nav-tabs-container">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">edit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">stock</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">media</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <form action="{{ route('updateproduct', $data->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('category') }}</label>

                                        <select class="form-control selectpicker" name="category_id" data-live-search="true">
                                            @foreach ($category as $d)
                                                <option @if ($data->category_id == $d->id) selected @endif data-tokens="{{ $d->{'name' . localePrefix()} }}" value="{{ $d->id }}">{{ $d->{'name' . localePrefix()} }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('type') }}</label>
                                        <select class="form-control selectpicker" disabled id="type" name="type" data-live-search="true">

                                            <option data-tokens="service" @if ($data->type == 'service') selected @endif value="service">{{ __('servicy') }}</option>
                                            <option data-tokens="product" @if ($data->type == 'product') selected @endif value="product">{{ __('producty') }}</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('name_ar') }}</label>

                                        <input type="text" class="form-control" name="name_ar" value="{{ $data->name_ar }}">

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('name_en') }}</label>

                                        <input type="text" class="form-control" name="name_en" value="{{ $data->name_en }}">

                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('description_ar') }}</label>
                                        <input type="text" class="form-control" name="description_ar" value="{{ $data->description_ar }}">

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('description_en') }}</label>
                                        <input type="text" class="form-control" name="description_en" value="{{ $data->description_en }}">

                                    </div>
                                </div>
                            </div>
                            @if ($data->type == 'service')
                                <div id="service">
                                    <div class="row">

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">{{ __('unit') }}</label>
                                                <select class="form-control selectpicker" name="unit" data-live-search="true">

                                                    <option data-tokens="service" @if ($data->servicedetail[0]->unit == 'job') selected @endif value="job">{{ __('job') }}</option>
                                                    <option data-tokens="service" @if ($data->servicedetail[0]->unit == 'day') selected @endif value="day">{{ __('day') }}</option>
                                                    <option data-tokens="service" @if ($data->servicedetail[0]->unit == 'hour') selected @endif value="hour">{{ __('hour') }}</option>

                                                </select>

                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">{{ __('price') }}</label>
                                                <input type="number" class="form-control" name="price" value="{{ $data->servicedetail[0]->price }}">

                                            </div>
                                        </div>


                                    </div>
                                </div>
                            @else
                                <div id="product">
                                    <div class="row">

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">{{ __('model') }}</label>

                                                <input type="text" class="form-control" name="model" value="{{ $data->productdetail[0]->model }}">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">{{ __('min_quantity_stored') }}</label>
                                                <input type="number" class="form-control" name="min_quantity_stored" value="{{ $data->productdetail[0]->min_quantity_stored }}">

                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">{{ __('max_quantity_stored') }}</label>
                                                <input type="number" class="form-control" name="max_quantity_stored" value="{{ $data->productdetail[0]->max_quantity_stored }}">

                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">{{ __('selling_price ') }}</label>
                                                <input type="number" class="form-control" name="selling_price" value="{{ $data->productdetail[0]->selling_price }}">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">{{ __('min_purchase_price') }}</label>
                                                <input type="number" class="form-control" name="min_purchase_price" value="{{ $data->productdetail[0]->min_purchase_price }}">

                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">{{ __('max_purchase_price') }}</label>
                                                <input type="number" class="form-control" name="max_purchase_price" value="{{ $data->productdetail[0]->max_purchase_price }}">

                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">{{ __('selling_price ') }}</label>
                                                <input type="number" class="form-control" name="selling_price " value="{{ $data->productdetail[0]->selling_price }}">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">{{ __('transport_price') }}</label>
                                                <input type="number" class="form-control" name="transport_price" value="{{ $data->productdetail[0]->transport_price }}">

                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">{{ __('request_type') }}</label>
                                                <select class="form-control" name="request_type" id="">
                                                    <option @if ($data->productdetail[0]->request_type == 'by_factory') selected @endif value="by_agent">by_agent</option>
                                                    <option @if ($data->productdetail[0]->request_type == 'by_agent') selected @endif value="by_factory">by_factory</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">{{ __('weight') }}</label>
                                                <input type="number" class="form-control" name="weight" value="{{ $data->productdetail[0]->weight }}">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">{{ __('unit') }}</label>
                                                <select class="form-control" name="unit" id="">
                                                    <option @if ($data->productdetail[0]->unit == 'piece') selected @endif value="piece">piece</option>
                                                    <option @if ($data->productdetail[0]->unit == 'litre') selected @endif value="litre">litre</option>
                                                    <option @if ($data->productdetail[0]->unit == 'kilo') selected @endif value="kilo">kilo</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">{{ __('visibility') }}</label>
                                                <select class="form-control" name="state" id="">
                                                    <option @if ($data->productdetail[0]->state == 'active') selected @endif value="active">active</option>
                                                    <option @if ($data->productdetail[0]->state == 'inactive') selected @endif value="inactive">inactive</option>
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
                            @endif
                            <div class="row">
                                <div class="col">
                                    <label for="recipient-name" class="col-form-label">{{ __('images') }}</label>
                                    <input type="file" class="form-control-file" name="image[]" multiple>
                                </div>
                                <div class="col"><button type="submit" class="btn btn-success">{{ __('save') }}</button></div>
                            </div>


                        </form>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="table-responsive">
                            <table id="copy-print-csv" class="table custom-table">
                                <thead>
                                    <tr>
                                        <th>{{ __('garage') }}</th>
                                        <th>{{ __('brand') }}</th>
                                        <th>{{ __('supplier') }}</th>
                                        <th>{{ __('tax') }}</th>
                                        <th>{{ __('price') }}</th>
                                        <th>{{ __('stocked_quantity ') }}</th>
                                        <th>{{ __('left_quantity') }}</th>
                                        <th>{{ __('serial_num') }}</th>
                                        <th>{{ __('rows') }}</th>
                                        <th>{{ __('columns') }}</th>
                                        <th>{{ __('reference') }}</th>
                                        <th>{{ __('purchase_date') }}</th>
                                        <th>{{ __('expiry_date') }}</th>
                                        <th>{{ __('guarantee_expiry_date') }}</th>
                                        <th>{{ __('edit') }}</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data->stock as $d)
                                        <tr>

                                            <td>{{ $d->garage->{'name' . localePrefix()} }}</td>
                                            <td>{{ $d->brand == null ? '--' : $d->brand->{'name' . localePrefix()} }}</td>
                                            <td>{{ $d->supplier->{'name' . localePrefix()} }}</td>
                                            <td>{{ $d->tax }}</td>
                                            <td>{{ $d->price }}</td>
                                            <td>{{ $d->stocked_quantity }}</td>
                                            <td>{{ $d->used_quantity }}</td>
                                            <td>{{ $d->serial_num }}</td>
                                            <td>{{ $d->rows }}</td>
                                            <td>{{ $d->columns }}</td>
                                            <td>{{ $d->reference }}</td>
                                            <td>{{ $d->purchase_date }}</td>
                                            <td>{{ $d->expiry_date }}</td>
                                            <td>{{ $d->guarantee_expiry_date }}</td>

                                            <td><a href="{{ route('edit_prod', $d->id) }}" class="btn btn-primary btn-sm "><span class="icon-border_color"></span></a>
                                                <button data-product-id="{{ $d->id }}" class="btn btn-primary generateQRCodeButton"><span class="icon-radio_button_checked"></span></button>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="baguetteBoxThree gallery">
                            <div class="row gutters">
                                @foreach ($images as $i)
                                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-6">
                                        <a href="{{ asset('images/products/' . $i->file_name) }}" class="effects">
                                            <img src="{{ asset('images/products/' . $i->file_name) }}" class="img-fluid" alt="Wafi Admin">
                                            <div class="overlay">
                                                <span class="expand">+</span>
                                            </div>
                                        </a>

                                    </div>
                                @endforeach
                            </div>
                            <!-- Row end -->
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/bs-select.min.js') }}"></script>
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
    <script></script>
@endsection
