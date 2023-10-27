@extends('layouts.printmain')
@section('content')
    <div class="card-body">
        <center>
            <h3>{{ __('all_service') }}</h3>
        </center>
    </div>
    <div class="table-responsive-sm">
        <table class="table table-striped">
            <tr>
                <th>{{ __('code') }}</th>
                <th>{{ __('name') }}</th>
                <th>{{ __('category') }}</th>
                <th>{{ __('description') }}</th>
                <th>{{ __('unit ') }}</th>
                <th>{{ __('price') }}</th>


            </tr>
            </thead>
            <tbody>
                @foreach ($data as $d)
                    <tr>

                        <td>{{ $d->code }}</td>
                        <td>{{ $d->{'name' . localePrefix()} }}</td>
                        <td>{{ $d->category->{'name' . localePrefix()} }}</td>
                        <td>{{ $d->{'description' . localePrefix()} }}</td>
                        <td>{{ $d->unit }}</td>
                        <td>{{ $d->price }}</td>




                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
