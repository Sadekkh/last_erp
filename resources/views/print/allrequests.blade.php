@extends('layouts.printmain')
@section('content')
    <div class="card-body">
        <center>
            <h3>{{ __('all_requests') }}</h3><br>
            {{ $start }}-{{ $end }}</h3>
        </center>
    </div>
    <div class="table-responsive-sm">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ __('garage') }}</th>
                    <th>{{ __('code') }}</th>
                    <th>{{ __('date') }}</th>
                    <th>{{ __('state') }}</th>
                    <th>{{ __('totalprice') }}</th>
                    <th>{{ __('number_of_items') }}</th>


                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach ($data as $d)
                    <tr>
                        <td>{{ $d->garage->{'name' . localePrefix()} }}</td>
                        <td>{{ $d->code }}</td>
                        <td>{{ $d->date }}</td>
                        <td>{{ $d->state }}</td>
                        <td>
                            @if (!$d->totalQuantity->isEmpty())
                                {{ $d->totalQuantity[0]->totalprice }}
                                @php
                                    $total += $d->totalQuantity[0]->totalprice;
                                @endphp
                            @else
                                0
                            @endif
                        </td>

                        <td>
                            @if (!$d->totalitems->isEmpty())
                                {{ $d->totalitems[0]->totalitem }}
                            @else
                                0
                            @endif
                        </td>


                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <div class="card-body">
        <div class="d-md-flex flex-md-wrap">


            <div class="pt-2 mb-3 wmin-md-400 ml-auto">
                <h6 class="mb-3 text-left">{{ __('invoice') }}</h6>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th class="text-left">{{ __('Subtotal') }}:</th>
                                <td class="text-right"><span id="subtotal"></span>{{ $total }}</td>
                            </tr>
                            <tr>
                                <th class="text-left">{{ __('Tax:') }} </th>
                                <td class="text-right"><span id="tax"></span>{{ $settings[0]->value }}</td>
                            </tr>
                            @php
                                $total += ($total * $settings[0]->value) / 100;
                            @endphp
                            <tr>
                                <th class="text-left">{{ __('total:') }}</th>
                                <td class="text-right text-primary">
                                    <h3 class="font-weight-semibold">{{ $total }}</h3>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
@endsection