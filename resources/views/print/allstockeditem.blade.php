@extends('layouts.printmain')
@section('content')
    <div class="card-body">
        <center>
            <h3>{{ __('all_items') }}</h3>
        </center>
    </div>
    <div class="table-responsive-sm">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ __('product') }}</th>
                    <th>{{ __('purchase_date') }}</th>
                    <th>{{ __('expiry_date') }}</th>
                    <th>{{ __('guarantee_expiry_date') }}</th>
                    <th>{{ __('unit_stocked') }}</th>
                    <th>{{ __('unit_left') }}</th>
                    <th>{{ __('rows') }}</th>
                    <th>{{ __('columns') }}</th>
                    <th>{{ __('serial_number') }}</th>
                    <th>{{ __('state') }}</th>



                </tr>
            </thead>
            <tbody>
                @foreach ($data as $d)
                    <tr>

                        <td>{{ $d->product->{'name' . localePrefix()} }}</td>
                        <td>{{ $d->stock->purchase_date }}</td>
                        <td>{{ $d->stock->expiry_date }}</td>
                        <td>{{ $d->stock->guarantee_expiry_date }}</td>
                        <td>{{ $d->unit_storage }}-{{ $d->product->productdetail[0]->unit }}</td>
                        <td>{{ $d->unit_left }}-{{ $d->product->productdetail[0]->unit }}</td>
                        <td>{{ $d->stock->rows }}</td>
                        <td>{{ $d->stock->columns }}</td>

                        <td>{{ $d->serial_num }}</td>
                        <td>{{ __($d->state) }}</td>



                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
