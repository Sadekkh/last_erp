@extends('layouts.printmain')
@section('content')
    <div class="card-body">
        <center>
            <h3>{{ __('maintenance_order') }}:{{ $data->code }}</h3><br>
            </h3>
        </center>
        <div class="row mb-4">
            <div class="col-sm-6">
                <p class="card-text">{{ __('truck_model') }}: {{ $data->truck->model }}</p>
                <p class="card-text">{{ __('truck_vin') }}: {{ $data->truck->vin }}</p>
                <p class="card-text">{{ __('trailer_model') }}: {{ $data->trailer->model }}</p>
                <p class="card-text">{{ __('trailer_vin') }}: {{ $data->trailer->vin }}</p>
                <p class="card-text">{{ __('driver_name') }}: {{ $data->driver->{'name' . localePrefix()} }}</p>
            </div>
            <div class="col-sm-6">
                <p class="card-text">{{ __('entry_time') }}: {{ $data->entry_time }}</p>
                <p class="card-text">{{ __('leaving_time') }}: {{ $data->leaving_time }}</p>
                <p class="card-text">{{ __('entry_state') }}: {{ $data->entry_state }}</p>
                <p class="card-text">{{ __('reason') }}: {{ $data->reason }}</p>
                <p class="card-text">{{ __('complain') }}: {{ $data->complain }}</p>
            </div>

        </div>

    </div>
    <center>
        <h3>{{ __('service') }}</h3>
    </center><br>
    @foreach ($data->mainteancetask as $d)
        <center>
            <h4>{{ $d->product->{'name' . localePrefix()} }}</h4>
        </center>
        @if (!$d->replaceditem->isEmpty())
            <div class="table-responsive-sm">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('product') }}</th>
                            <th>{{ __('old_item') }}</th>
                            <th>{{ __('new_item') }}</th>
                            <th>{{ __('old_prod_desc') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($d->replaceditem as $r)
                            <tr>
                                <td>{{ $r->product->{'name' . localePrefix()} }}</td>
                                <td>{{ $r->olditem->serial_num }}</td>
                                <td>{{ $r->newitem->serial_num }}</td>
                                <td>{{ __($r->old_prod_desc) }}</td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        @else
            <center>
                <h2>--</h2>
            </center>
        @endif
    @endforeach
@endsection
