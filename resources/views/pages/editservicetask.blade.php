@extends('layouts.main')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/bs-select.css') }}">
    <style>
        .trucking {
            position: absolute;
        }

        .checkboxes {
            position: absolute;
        }
    </style>
@endsection
@section('content')
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="accordion" id="withIconsAccordion">
                <div class="accordion-container">
                    <div class="accordion-header" id="withIconOne">
                        <a href="" class="" data-toggle="collapse" data-target="#collapseWithIconOne" aria-expanded="true" aria-controls="collapseWithIconOne">
                            <i class="icon icon-shield1"></i>{{ __('edit') }}
                        </a>
                    </div>
                    <div id="collapseWithIconOne" class="collapse show" aria-labelledby="withIconOne" data-parent="#withIconsAccordion">
                        <div class="accordion-body">
                            <form action="{{ route('updatetask', $data->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <label for="recipient-name" class="col-form-label">{{ __('service') }}</label>

                                        <input type="text" class="form-control" disabled value="{{ $data->product->{'name' . localePrefix()} }}">
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">{{ __('worker') }}</label>

                                            <select class="form-control selectpicker" name="category_id" data-live-search="true">
                                                @foreach ($worker as $d)
                                                    <option data-tokens="{{ $d->{'name' . localePrefix()} }}" @if ($data->worker_id == $d->id) selected @endif value="{{ $d->id }}">{{ $d->{'name' . localePrefix()} }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col">
                                        <label for="recipient-name" class="col-form-label">{{ __('entry_time') }}</label>
                                        <input type="datetime-local" class="form-control" value="{{ $data->entry_time }}" name="entry_time">
                                    </div>

                                    <div class="col">
                                        <label for="recipient-name" class="col-form-label">{{ __('leaving_time') }}</label>
                                        <input type="datetime-local" class="form-control" value="{{ $data->leaving_time }}" name="leaving_time">
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col">
                                        <label for="recipient-name" class="col-form-label">{{ __('description') }}</label>
                                        <input type="text" class="form-control" name="description" value="{{ $data->description }}">
                                    </div>
                                    <div class="col">
                                        <br>
                                        <button class="btn btn-success" type="submit">{{ __('save') }}</button>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
                @if ($data->product_id == 3)
                    <div class="accordion-container">
                        <div class="accordion-header" id="withIconTwo">
                            <a href="" class="collapsed" data-toggle="collapse" data-target="#collapseWithIconTwo" aria-expanded="false" aria-controls="collapseWithIconTwo">
                                <i class="icon icon-tag1"></i>{{ __('change_wheel') }}
                            </a>
                        </div>
                        <div id="collapseWithIconTwo" class="collapse" aria-labelledby="withIconTwo" data-parent="#withIconsAccordion">
                            <div class="accordion-body">
                                <form action="{{ route('save_changed_items') }}" method="POST">
                                    @csrf
                                    <div id="changing" style="display: none">
                                        <div class="row">
                                            <input type="text" hidden value="{{ $data->id }}" name="maintenance_task_id">
                                            <input type="text" hidden value="{{ $data->product_id }}" name="product_id">
                                            <input type="text" class="form-control" hidden id="wheel_position" name="wheel_position">
                                            <div class="col">
                                                <label for="recipient-name" class="col-form-label">{{ __('wheel_position') }} <span id="whee"></span></label>
                                            </div>
                                            <div class="col">
                                                <label for="recipient-name" class="col-form-label">{{ __('old_item_id') }}</label>
                                                <select class="form-control selectpicker" name="old_item_id" data-live-search="true">
                                                    @foreach ($old as $d)
                                                        <option data-tokens="{{ $d->serial_num }}" value="{{ $d->id }}">{{ $d->serial_num }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label for="recipient-name" class="col-form-label">{{ __('old_serial_num') }}</label>
                                                <input type="text" class="form-control" name="old_serial_num">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label for="recipient-name" class="col-form-label">{{ __('new_item_id') }}</label>
                                                <select class="form-control selectpicker" name="new_item_id" data-live-search="true">
                                                    @foreach ($new as $d)
                                                        <option data-tokens="{{ $d->serial_num }}" value="{{ $d->id }}">{{ $d->serial_num }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label for="recipient-name" class="col-form-label">{{ __('old_prod_desc') }}</label>
                                                <select class="form-control selectpicker" id="decision" name="old_prod_desc" data-live-search="true">

                                                    <option data-tokens="on_guarantee" value="on_guarantee">on_guarantee</option>
                                                    <option data-tokens="back_to_stock" value="back_to_stock">back_to_stock</option>
                                                    <option data-tokens="damaged" value="damaged">damaged</option>

                                                </select>
                                            </div>
                                            <div class="col" id="damagedsection" style="display: none">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="recipient-name" class="col-form-label">{{ __('reason') }}</label>
                                                        <select class="form-control selectpicker" name="reason" data-live-search="true">
                                                            <option data-tokens="normal" value="normal">normal</option>
                                                            <option data-tokens="driver_mistake" value="driver_mistake">driver_mistake</option>
                                                            <option data-tokens="technical_error" value="technical_error">technical_error</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="recipient-name" class="col-form-label">{{ __('description') }}</label>
                                                        <input type="text" class="form-control" name="description">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-success" type="submit">{{ __('save') }}</button>
                                </form>
                                <div class="row">
                                    <div class="truck-container">
                                        <div class="checkboxes">
                                            <button class="btn btn-danger trucking" style="margin:7px 0 0 1065px;" data-id="1"><span class="icon-check_circle"></span>1</button>
                                            <button class="btn btn-danger trucking" style="margin: 340px 0 0 1065px;;" data-id="2"><span class="icon-check_circle"></span>2</button>
                                            <button class="btn btn-danger trucking" style="margin:7px 0 0 742px;" data-id="3"><span class="icon-check_circle"></span>3</button>
                                            <button class="btn btn-danger trucking" style="margin:137px 0 0 742px;" data-id="4"><span class="icon-check_circle"></span>4</button>
                                            <button class="btn btn-danger trucking" style="margin:211px 0 0 742px;" data-id="5"><span class="icon-check_circle"></span>5</button>
                                            <button class="btn btn-danger trucking" style="margin:335px 0 0 742px;" data-id="6"><span class="icon-check_circle"></span>6</button>
                                            <button class="btn btn-danger trucking" style="margin:7px 0 0 630px;" data-id="7"><span class="icon-check_circle"></span>7</button>
                                            <button class="btn btn-danger trucking" style="margin:137px 0 0 630px;" data-id="8"><span class="icon-check_circle"></span>8</button>
                                            <button class="btn btn-danger trucking" style="margin:211px 0 0 630px;" data-id="9"><span class="icon-check_circle"></span>9</button>
                                            <button class="btn btn-danger trucking" style="margin:335px 0 0 630px;" data-id="10"><span class="icon-check_circle"></span>10</button>
                                            <button class="btn btn-danger trucking" style="margin:7px 0 0 350px;" data-id="11"><span class="icon-check_circle"></span>11</button>
                                            <button class="btn btn-danger trucking" style="margin:123px  0 0 350px;" data-id="12"><span class="icon-check_circle"></span>12</button>
                                            <button class="btn btn-danger trucking" style="margin:235px 0 0 350px;" data-id="13"><span class="icon-check_circle"></span>13</button>
                                            <button class="btn btn-danger trucking" style="margin:346px  0 0 350px;" data-id="14"><span class="icon-check_circle"></span>14</button>
                                            <button class="btn btn-danger trucking" style="margin:7px 0 0 241px;" data-id="15"><span class="icon-check_circle"></span>15</button>
                                            <button class="btn btn-danger trucking" style="margin:123px  0 0 241px;" data-id="16"><span class="icon-check_circle"></span>16</button>
                                            <button class="btn btn-danger trucking" style="margin:235px 0 0 241px;" data-id="17"><span class="icon-check_circle"></span>17</button>
                                            <button class="btn btn-danger trucking" style="margin:346px  0 0 241px;" data-id="18"><span class="icon-check_circle"></span>18</button>
                                            <button class="btn btn-danger trucking" style="margin:7px 0 0 130px;" data-id="19"><span class="icon-check_circle"></span>19</button>
                                            <button class="btn btn-danger trucking" style="margin:123px  0 0 130px;" data-id="20"><span class="icon-check_circle"></span>20</button>
                                            <button class="btn btn-danger trucking" style="margin:235px 0 0 130px;" data-id="21"><span class="icon-check_circle"></span>21</button>
                                            <button class="btn btn-danger trucking" style="margin:346px  0 0 130px;" data-id="22"><span class="icon-check_circle"></span>22</button>
                                        </div>
                                        <img src="{{ asset('images/truck.jpg') }}" alt="Truck Image">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif ($data->product_id == 2)
                    <div class="accordion-container">
                        <div class="accordion-header" id="withIconThree">
                            <a href="" class="collapsed" data-toggle="collapse" data-target="#collapseWithIconThree" aria-expanded="false" aria-controls="collapseWithIconThree">
                                <i class="icon icon-triangle"></i>{{ __('oil_change') }}
                            </a>
                        </div>
                        <div id="collapseWithIconThree" class="collapse" aria-labelledby="withIconThree" data-parent="#withIconsAccordion">
                            <div class="accordion-body">
                                <form action="{{ route('save_changed_items') }}" method="POST">
                                    @csrf
                                    <div>
                                        <div class="row">
                                            <input type="text" hidden value="{{ $data->id }}" name="maintenance_task_id">
                                            <input type="text" hidden value="{{ $data->product_id }}" name="product_id">
                                            <div class="col">
                                                <label for="recipient-name" class="col-form-label">{{ __('oil_amount') }}</label>
                                                <input type="number" class="form-control" name="oil_amount">
                                            </div>
                                            <div class="col">
                                                <label for="recipient-name" class="col-form-label">{{ __('for') }}</label>

                                                <select class="form-control selectpicker" name="for" data-live-search="true">
                                                    <option data-tokens="truck" value="truck">truck</option>
                                                    <option data-tokens="trailer" value="trailer">trailer</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <button class="btn btn-success" type="submit">{{ __('save') }}</button>
                                </form>

                            </div>
                        </div>
                    </div>
                @else
                    <div class="accordion-container">
                        <div class="accordion-header" id="withIconThree2">
                            <a href="" class="collapsed" data-toggle="collapse" data-target="#collapseWithIconThree2" aria-expanded="false" aria-controls="collapseWithIconThree">
                                <i class="icon icon-triangle"></i>{{ $data->product->{'name' . localePrefix()} }}
                            </a>
                        </div>
                        <div id="collapseWithIconThree2" class="collapse" aria-labelledby="withIconThree2" data-parent="#withIconsAccordion">
                            <div class="accordion-body">
                                <form action="{{ route('save_changed_items') }}" method="POST">
                                    @csrf
                                    <div>
                                        <div class="row">
                                            <input type="text" hidden value="{{ $data->id }}" name="maintenance_task_id">
                                            <input type="text" hidden value="{{ $data->product_id }}" name="product_id">

                                            <div class="col">
                                                <label for="recipient-name" class="col-form-label">{{ __('old_item_id') }}</label>
                                                <select class="form-control selectpicker" name="old_item_id" data-live-search="true">
                                                    @foreach ($old as $d)
                                                        <option data-tokens="{{ $d->serial_num }}" value="{{ $d->id }}">{{ $d->serial_num }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label for="recipient-name" class="col-form-label">{{ __('old_serial_num') }}</label>
                                                <input type="text" class="form-control" name="old_serial_num">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label for="recipient-name" class="col-form-label">{{ __('new_item_id') }}</label>
                                                <select class="form-control selectpicker" name="new_item_id" data-live-search="true">
                                                    @foreach ($new as $d)
                                                        <option data-tokens="{{ $d->serial_num }}" value="{{ $d->id }}">{{ $d->serial_num }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label for="recipient-name" class="col-form-label">{{ __('old_prod_desc') }}</label>
                                                <select class="form-control selectpicker" id="decision2" name="old_prod_desc" data-live-search="true">

                                                    <option data-tokens="on_guarantee" value="on_guarantee">on_guarantee</option>
                                                    <option data-tokens="back_to_stock" value="back_to_stock">back_to_stock</option>
                                                    <option data-tokens="damaged" value="damaged">damaged</option>

                                                </select>
                                            </div>
                                            <div class="col" id="damagedsection2" style="display: none">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="recipient-name" class="col-form-label">{{ __('reason') }}</label>
                                                        <select class="form-control selectpicker" name="reason" data-live-search="true">
                                                            <option data-tokens="normal" value="normal">normal</option>
                                                            <option data-tokens="driver_mistake" value="driver_mistake">driver_mistake</option>
                                                            <option data-tokens="technical_error" value="technical_error">technical_error</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="recipient-name" class="col-form-label">{{ __('description') }}</label>
                                                        <input type="text" class="form-control" name="description">

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label for="recipient-name" class="col-form-label">{{ __('for') }}</label>

                                                <select class="form-control selectpicker" name="for" data-live-search="true">
                                                    <option data-tokens="truck" value="truck">truck</option>
                                                    <option data-tokens="trailer" value="trailer">trailer</option>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <br>
                                                <button class="btn btn-success" type="submit">{{ __('save') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/bs-select.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.trucking').click(function() {
                var id = $(this).data('id');
                console.log(id)
                // Hide all divs
                $('#wheel_position').val(id);
                $('#whee').html(id);


                $('#changing').show();


            });
        });
        $(document).ready(function() {
            $('#decision').change(function() {
                var value = $(this).val();

                if (value == 'damaged') {
                    $('#damagedsection').show();

                } else {
                    $('#damagedsection').hide();
                }
            });
        });
        $(document).ready(function() {
            $('#decision2').change(function() {
                var value = $(this).val();

                if (value == 'damaged') {
                    $('#damagedsection2').show();

                } else {
                    $('#damagedsection2').hide();
                }
            });
        });
    </script>
@endsection
