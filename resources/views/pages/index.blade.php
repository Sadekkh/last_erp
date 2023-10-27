@extends('layouts.main')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/bs-select.css') }}">
    <link rel="stylesheet" href="{{ asset('datatables/dataTables.bs4.css') }}" />
    <link rel="stylesheet" href="{{ asset('datatables/dataTables.bs4-custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('datatables/buttons.bs.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bs-select.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style>
        .daterangepicker {
            color: black
        }

        .btn-group {
            width: 100%;
            text-align: center
        }

        .bt {
            width: 34vh
        }

        @media screen and (max-width:576px) {
            .btn-group {
                display: flex;
                flex-direction: column;
            }
        }
    </style>
@endsection
@section('content')
    <form id="dateForm" action="/dashboards" method="get">
        <div id="reportrange" style=" cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
            <i class="fa fa-calendar"></i>&nbsp;
            <span></span> <i class="fa fa-caret-down"></i>
        </div>
        <input id="startdate" type="date" name="startdate" hidden value="">
        <input id="enddate" type="date" name="enddate" hidden value="">
    </form>
    <br>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group mr-2 " role="group" aria-label="button group">
                    <a href="/print/all_prod"><button type="button" class="btn btn-success bt">{{ __('all_prod') }}</button></a>
                    <a href="/print/all_service"><button type="button" class="btn btn-warning bt">{{ __('all_service') }}</button></a>
                    <a href="/print/all_stocked_items"><button type="button" class="btn btn-success bt">{{ __('all_stocked_items') }}</button></a>
                    <a href="/print/all_requests"><button type="button" class="btn btn-danger bt" id="requests">{{ __('all_requests') }}</button></a>
                    <a href="/print/transaction"><button type="button" class="btn btn-success bt" id="transaction">{{ __('all_transaction') }}</button></a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group mr-2 " role="group" aria-label="button group">
                    <a href="/print/bought_items"><button type="button" class="btn btn-success bt" id="bought_items">{{ __('bought_items') }}</button></a>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle bt" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('bought_items_garage') }}</button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            @foreach ($garage as $g)
                                <a class="dropdown-item garage" data-id="{{ $g->id }}" href="#">{{ $g->{'name' . localePrefix()} }}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle bt" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('finished-maintenance') }}</button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            @foreach ($mainf as $g)
                                <a class="dropdown-item mainf" data-id="{{ $g->id }}" href="#">{{ $g->code }}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle bt" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('pending-maintenance') }}</button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            @foreach ($maing as $g)
                                <a class="dropdown-item mainf" data-id="{{ $g->id }}" href="#">{{ $g->code }}</a>
                            @endforeach
                        </div>
                    </div>
               </div>
            </div>
        </div>
    </div>

    <br>
    <div class="row">
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{ $mai1 }}</h3>
                            </div>
                        </div>

                    </div>
                    <h6 class="text-muted font-weight-normal">{{ __('finished-maintenance') }}</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{ $outsider }}</h3>
                            </div>
                        </div>

                    </div>
                    <h6 class="text-muted font-weight-normal">{{ __('outsider-truck') }}</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0"> {{ $mai }}</h3>
                            </div>
                        </div>

                    </div>
                    <h6 class="text-muted font-weight-normal">{{ __('pending-maintenance') }}</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{ $req }}</h3>
                            </div>
                        </div>

                    </div>
                    <h6 class="text-muted font-weight-normal">{{ __('requests') }}</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-7 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('latest_requests') }}</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>

                                    <th>{{ __('code') }} </th>
                                    <th>{{ __('garage') }}</th>
                                    <th>{{ __('total_items') }}</th>
                                    <th> {{ __('price') }}</th>
                                    <th> {{ __('state') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($request as $r)
                                    <tr>
                                        <td>{{ $r->code }}</td>
                                        <td> {{ $r->garage->{'name' . localePrefix()} }}</td>
                                        <td>
                                            @if (!$r->totalQuantity->isEmpty())
                                                {{ $r->totalQuantity[0]->totalprice }}
                                            @else
                                                0
                                            @endif
                                        </td>

                                        <td>
                                            @if (!$r->totalitems->isEmpty())
                                                {{ $r->totalitems[0]->totalitem }}
                                            @else
                                                0
                                            @endif
                                        </td>
                                        <td>
                                            <div class="badge badge-outline-success">{{ __($r->state) }}</div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-5 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('trucks_maintenance_alert') }}</h4>
                    <div class="table-responsive">
                        <table class="table" id="fixedHeader">
                            <thead>
                                <tr>
                                    <th>{{ __('truck') }}</th>
                                    <th>{{ __('vin') }}</th>
                                    <th>{{ __('last_check') }}</th>
                                    <th>{{ __('maintenance_date') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($truck as $t)
                                    <tr>
                                        <td>{{ $t->model }}</td>
                                        <td>{{ $t->vin }}</td>
                                        <td>{{ $t->last_check }}</td>
                                        <td>{{ $t->next_check }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Navbar -->
@endsection
@section('script')
    <script src="{{ asset('datatables/dataTables.min.js') }}"></script>
    <script src="{{ asset('datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('datatables/custom/custom-datatables.js') }}"></script>
    <script src="{{ asset('datatables/custom/fixedHeader.js') }}"></script>
    <script src="{{ asset('datatables/buttons.min.js') }}"></script>
    <script src="{{ asset('js/bs-select.min.js') }}"></script>

    <script src="{{ asset('js/moment.js') }}"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        var currentDate = {!! json_encode($currentDate) !!};
        var oneWeekFromNow = {!! json_encode($oneWeekFromNow) !!};
        console.log(currentDate)
        $(function() {

            var start = moment(currentDate);
            var end = moment(oneWeekFromNow);

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                startDate = start;
                endDate = end;
                var startDateISO = startDate.format('YYYY-MM-DD');
                var endDateISO = endDate.format('YYYY-MM-DD');
                $('#startdate').val(startDateISO);
                $('#enddate').val(endDateISO);
                $('#dateForm').submit();


            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, function(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                startDate = start;
                endDate = end;
                var startDateISO = startDate.format('YYYY-MM-DD');
                var endDateISO = endDate.format('YYYY-MM-DD');
                $('#startdate').val(startDateISO);
                $('#enddate').val(endDateISO);
                $('#dateForm').submit();


            });

            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

        });
        $(document).ready(function() {
            $('#requests').on('click', function(e) {
                event.preventDefault()
                var url = '/print/all_requests/?start=' + encodeURIComponent(currentDate) + '&end=' + encodeURIComponent(oneWeekFromNow);
                var newWindow = window.open(url, '_blank');
                if (newWindow) {

                } else {

                    alert('The new window was blocked by the browser\'s pop-up blocker.');
                }

            });
            $('#transaction').on('click', function(e) {
                event.preventDefault()
                var url = '/print/transaction/?start=' + encodeURIComponent(currentDate) + '&end=' + encodeURIComponent(oneWeekFromNow);
                var newWindow = window.open(url, '_blank');
                if (newWindow) {} else {
                    alert('The new window was blocked by the browser\'s pop-up blocker.');
                }
            });
            $('#bought_items').on('click', function(e) {
                event.preventDefault()
                var url = '/print/bought_items/?start=' + encodeURIComponent(currentDate) + '&end=' + encodeURIComponent(oneWeekFromNow);
                var newWindow = window.open(url, '_blank');
                if (newWindow) {} else {
                    alert('The new window was blocked by the browser\'s pop-up blocker.');
                }
            });
            $('.garage').on('click', function(e) {
                event.preventDefault()
                let id = $(this).data('id');
                var url = '/print/bought_items/garage/?start=' + encodeURIComponent(currentDate) + '&end=' + encodeURIComponent(oneWeekFromNow) + '&id=' + encodeURIComponent(id);
                var newWindow = window.open(url, '_blank');
                if (newWindow) {} else {
                    alert('The new window was blocked by the browser\'s pop-up blocker.');
                }
            });
            $('.mainf').on('click', function(e) {
                event.preventDefault()
                let id = $(this).data('id');
                var url = '/print/finished/?start=' + encodeURIComponent(currentDate) + '&end=' + encodeURIComponent(oneWeekFromNow) + '&id=' + encodeURIComponent(id);
                var newWindow = window.open(url, '_blank');
                if (newWindow) {} else {
                    alert('The new window was blocked by the browser\'s pop-up blocker.');
                }
            });

        });
    </script>
@endsection
