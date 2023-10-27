@extends('layouts.main')
@section('styles')
@endsection

@section('content')
    <div class="t-header">{{ __('vehicle_management') }}</div>
    <br>
    <br>
    <br>
    <button type="button" id="addnew" class="btn btn-primary">
        {{ __('add_new') }}
    </button>

    <div style="display: none" id="forms">
        <form action="{{ route('vehicle.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('vehicle_type') }}</label>
                        <select class="form-control" name="type">
                            <option value="truck">{{ __('truck') }}</option>
                            <option value="trailer">{{ __('trailer') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('model') }}</label>
                        <input type="text" class="form-control" name="model">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('year') }}</label>
                        <input type="number" min="1900" max="2099" step="1" value="2023" class="form-control" name="year" required="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('number_wheels') }}</label>
                        <input type="text" class="form-control" name="number_wheels">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('oil_change') }}</label>
                        <input type="number" class="form-control" name="oil_change">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('vin') }}</label>
                        <input type="text" class="form-control" name="vin">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('mileage') }}</label>
                        <input type="number" class="form-control" name="mileage">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="garageImages">{{ __('image') }}</label>
                    <input type="file" class="form-control-file" name="image[]" multiple>
                </div>
            </div>


            <button type="submit" class="btn btn-success">{{ __('save') }}</button>





        </form>
    </div>


    <div class="table-responsive">
        <div class="table-responsive">
            <table id="copy-print-csv" class="table custom-table">
                <thead>
                    <tr>
                        <th>{{ __('model') }}</th>
                        <th>{{ __('year') }}</th>
                        <th>{{ __('type') }}</th>
                        <th>{{ __('number_wheels') }}</th>
                        <th>{{ __('oil_change') }}</th>
                        <th>{{ __('vin') }}</th>
                        <th>{{ __('mileage') }}</th>
                        <th>{{ 'edit' }}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                        <tr>
                            <td>{{ $d->model }}</td>
                            <td>{{ $d->year }}</td>
                            <td>{{ $d->type }}</td>
                            <td>{{ $d->number_wheels }}</td>
                            <td>{{ $d->oil_change }}</td>
                            <td>{{ $d->vin }}</td>
                            <td>{{ $d->mileage }}</td>



                            <td><a href="{{ route('vehicle.edit', $d->id) }}" class="btn btn-primary btn-sm">{{ __('edit') }}</a>

                                <form action="{{ route('vehicle.destroy', $d->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('Are_you_sure_you_want_to_delete_this_item?') }}')">{{ __('delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

        </div>

    </div>
    </div>
@endsection

@section('script')
    <!-- Add this script to your view -->

    <script>
        $(document).ready(function() {
            $('#addnew').click(function(e) {
                e.preventDefault();

                $('#forms').toggle();
            })
            // Handle click event on "Edit" button

        });
    </script>
@endsection
