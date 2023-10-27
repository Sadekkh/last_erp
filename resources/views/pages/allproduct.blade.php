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
                        <th>{{ __('image') }}</th>
                        <th>{{ __('code') }}</th>
                        <th>{{ __('name') }}</th>
                        <th>{{ __('category') }}</th>
                        <th>{{ __('description') }}</th>
                        <th>{{ __('type') }}</th>
                        <th>{{ __('edit') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                        <tr>
                            <td>

                            </td>
                            <td>{{ $d->code }}</td>
                            <td>{{ $d->{'name' . localePrefix()} }}</td>
                            <td>{{ $d->category->{'name' . localePrefix()} }}</td>
                            <td>{{ $d->{'description' . localePrefix()} }}</td>


                            <td>{{ $d->type }}</td>
                            <td><a href="{{ route('edit_prod', $d->id) }}" class="btn btn-primary btn-sm ">{{ __('edit') }}</a>

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
    <div id="qrcodeDiv" hidden>

    </div>
@endsection
@section('script')
    <script src="{{ asset('datatables/dataTables.min.js') }}"></script>
    <script src="{{ asset('datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('datatables/custom/custom-datatables.js') }}"></script>
    <script src="{{ asset('datatables/custom/fixedHeader.js') }}"></script>
    <script src="{{ asset('datatables/buttons.min.js') }}"></script>

    <script src="{{ asset('js/bs-select.min.js') }}"></script>
    <script></script>
@endsection
