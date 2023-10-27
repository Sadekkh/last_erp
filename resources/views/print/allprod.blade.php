@extends('layouts.printmain')
@section('content')
    <div class="card-body">
        <center>
            <h3>{{ __('all_prod') }}</h3>
        </center>
    </div>
    <div class="table-responsive-sm">
        <table class="table table-striped">
            <tr>
                <th>{{ __('image') }}</th>
                <th>{{ __('code') }}</th>
                <th>{{ __('name') }}</th>
                <th>{{ __('category') }}</th>
                <th>{{ __('description') }}</th>
                <th>{{ __('stocked_quantity ') }}</th>
                <th>{{ __('unit_stocked') }}</th>
                <th>{{ __('unit_left') }}</th>


            </tr>
            </thead>
            <tbody>
                @foreach ($data as $d)
                    <tr>
                        <td>
                            @if (!$d->media->isEmpty())
                                <img src="{{ asset('images/products/' . $d->media[0]->file_name) }}" style="width: 4rem">
                            @endif
                        </td>
                        <td>{{ $d->code }}</td>
                        <td>{{ $d->{'name' . localePrefix()} }}</td>
                        <td>{{ $d->category->{'name' . localePrefix()} }}</td>
                        <td>{{ $d->{'description' . localePrefix()} }}</td>
                        @if (!$d->stockedquantity->isEmpty())
                            <td>{{ $d->stockedquantity[0]->totalitem }}</td>
                            <td>{{ $d->stockedquantity[0]->stored }}- {{ __($d->productdetail[0]->unit) }}</td>
                            <td>{{ $d->stockedquantity[0]->unitleft }}-{{ __($d->productdetail[0]->unit) }}</td>
                        @else
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                        @endif



                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
