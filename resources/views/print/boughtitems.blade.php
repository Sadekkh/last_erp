@extends('layouts.printmain')
@section('content')
    <div class="card-body">
        <center>
            <h3>{{ __('bought_items') }} <br>
                {{ date('d-m-Y', strtotime($start)) }}_/_{{ date('d-m-Y', strtotime($end)) }}</h3>
        </center>
    </div>
    <div class="table-responsive-sm">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ __('garage') }}</th>
                    <th>{{ __('product') }}</th>
                    <th>{{ __('request') }}</th>
                    <th>{{ __('price') }}</th>
                    <th>{{ __('serrial_num') }}</th>
                    <th>{{ __('purshace_date') }}</th>
                    <th>{{ __('unit_stock') }}</th>



                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach ($data as $d)
                    <tr>
                        <td>{{ $d->stock->garage->{'name' . localePrefix()} }}</td>
                        <td>{{ $d->product->{'name' . localePrefix()} }}</td>
                        <td>{{ $d->stock->request->code }}</td>
                        <td>{{ $d->stock->price }}</td>
                        @php
                            $total += $d->stock->price;
                        @endphp
                        <td>{{ $d->serial_num }}</td>
                        <td>{{ $d->stock->purchase_date }}</td>
                        <td>{{ $d->unit_storage }}</td>

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
