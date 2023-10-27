@extends('layouts.printmain')
@section('content')
    <div class="card-body">
        <center>
            <h3>{{ __('all_transaction') }}</h3><br>
            {{ $start }}-{{ $end }}</h3>
        </center>
    </div>
    <div class="table-responsive-sm">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ __('garage') }}</th>
                    <th>{{ __('workshop') }}</th>
                    <th>{{ __('code') }}</th>
                    <th>{{ __('worker') }}</th>
                    <th>{{ __('serial_num') }}</th>
                    <th>{{ __('quantity') }}</th>
                    <th>{{ __('date') }}</th>



                </tr>
            </thead>
            <tbody>
                @foreach ($data as $d)
                    <tr>
                        <td>{{ $d->garage->{'name' . localePrefix()} }}</td>
                        <td>{{ $d->workshop->{'name' . localePrefix()} }}</td>
                        <td>{{ $d->maintenanceOrder->code }}</td>
                        <td>{{ $d->worker->{'name' . localePrefix()} }}</td>
                        <td>{{ $d->stocked_item->serial_num }}</td>
                        <td>{{ $d->quantity_taken }}</td>
                        <td>{{ $d->created_at }}</td>



                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
