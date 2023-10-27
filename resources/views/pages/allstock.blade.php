@extends('layouts.main')
@section('styles')
    <link rel="stylesheet" href="{{ asset('datatables/dataTables.bs4.css') }}" />
    <link rel="stylesheet" href="{{ asset('datatables/dataTables.bs4-custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('datatables/buttons.bs.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bs-select.css') }}">
    <style>
        @page {
            size: 10cm 10cm;
            scale: 188;
        }
    </style>
@endsection
@section('content')
    <div class="row gutters">
        <div class="table-responsive">
            <table id="fixedHeader" class="table custom-table">
                <thead>
                    <tr>
                        <th>{{ __('product') }}</th>
                        <th>{{ __('garage') }}</th>
                        <th>{{ __('brand') }}</th>
                        <th>{{ __('supplier') }}</th>
                        <th>{{ __('tax') }}</th>
                        <th>{{ __('price') }}</th>
                        <th>{{ __('stocked_quantity ') }}</th>
                        <th>{{ __('unit_stocked') }}</th>
                        <th>{{ __('unit_left') }}</th>
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
                    @foreach ($data as $d)
                        <tr>

                            <td>{{ $d->product->{'name' . localePrefix()} }}</td>
                            <td>{{ $d->garage->{'name' . localePrefix()} }}</td>
                            <td>{{ $d->brand == null ? '--' : $d->brand->{'name' . localePrefix()} }}</td>
                            <td>{{ $d->supplier->{'supplier_name' . localePrefix()} }}</td>
                            <td>{{ $d->tax }}</td>
                            <td>{{ $d->price }}</td>
                            @if (!$d->stockedquantity->isEmpty())
                                <td>{{ $d->stockedquantity[0]->totalitem }}</td>
                                <td>{{ $d->stockedquantity[0]->stored }}- {{ $d->product->productdetail[0]->unit }}</td>
                                <td>{{ $d->stockedquantity[0]->unitleft }}-{{ $d->product->productdetail[0]->unit }}</td>
                            @else
                                <td>--</td>
                                <td>--</td>
                                <td>--</td>
                            @endif
                            <td>{{ $d->rows }}</td>
                            <td>{{ $d->columns }}</td>
                            <td>{{ $d->reference }}</td>
                            <td>{{ $d->purchase_date }}</td>
                            <td>{{ $d->expiry_date }}</td>
                            <td>{{ $d->guarantee_expiry_date }}</td>

                            <td><a href="{{ route('edit_stock', $d->id) }}" class="btn btn-primary btn-sm ">{{ __('edit') }}</a>


                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
@endsection
@section('script')
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
    <script src="{{ asset('js/bs-select.min.js') }}"></script>
    <script></script>
@endsection
