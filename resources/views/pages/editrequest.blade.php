@extends('layouts.main')
@section('styles')
    <link rel="stylesheet" href="{{ asset('datatables/dataTables.bs4.css') }}" />
    <link rel="stylesheet" href="{{ asset('datatables/dataTables.bs4-custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('datatables/buttons.bs.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bs-select.css') }}">
@endsection
@section('content')
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="nav-tabs-container">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{ __('requested_item') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">{{ _('edit') }}</a>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="table-responsive">
                            <div class="modal fade" id="customModalTwo" tabindex="-1" role="dialog" aria-labelledby="customModalTwoLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="" method="post">
                                            @csrf

                                            @method('PUT')

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="customModalTwoLabel"></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">{{ __('quantity_requested') }}</label>
                                                            <input type="text" id="editedNumber" class="form-control" name="quantity_requested">
                                                            <input type="text" hidden id="actualNumber" class="form-control" name="quan">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">{{ __('quantity_given') }}</label>
                                                            <input type="text" class="form-control" name="quantity_given">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">{{ __('price') }}</label>
                                                            <input type="text" class="form-control" name="approx_price">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">{{ __('address_ar') }}</label>
                                                            <select class="form-control selectpicker" name="supplier_id" data-live-search="true">
                                                                @foreach ($supplier as $d)
                                                                    <option data-tokens="{{ $d->{'supplier_name' . localePrefix()} }}" value="{{ $d->id }}">{{ $d->{'supplier_name' . localePrefix()} }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>




                                            </div>
                                            <div class="modal-footer custom">

                                                <div class="left-side">
                                                    <button type="button" class="btn btn-link danger" data-dismiss="modal">{{ __('cancel') }}</button>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="right-side">
                                                    <button type="submit" class="btn btn-link success">{{ __('save') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <table id="copy-print-csv" class="table custom-table">
                                <thead>
                                    <tr>
                                        <th>{{ __('product') }}</th>
                                        <th>{{ __('supplier') }}</th>
                                        <th>{{ __('quantity_requested') }}</th>
                                        <th>{{ __('quantity_given') }}</th>
                                        <th>{{ __('price') }}</th>
                                        <th>{{ __('edit') }}</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data->requested_item as $d)
                                        <tr>

                                            <td>{{ $d->product->{'name' . localePrefix()} }}</td>
                                            <td>{{ $d->supplier->{'supplier_name' . localePrefix()} }}</td>

                                            <td>{{ $d->quantity_requested }}</td>
                                            <td>{{ $d->quantity_given }}</td>
                                            <td>{{ $d->approx_price }}</td>
                                            <td><a href="#" class="btn btn-primary btn-sm edit-data" data-toggle="modal" data-target="#customModalTwo" data-id="{{ $d->id }}"><span class="icon-border_color"></span></a>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form action="{{ route('update_request', $data->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('deal') }}</label>

                                        <select class="form-control selectpicker" name="deal_id" data-live-search="true">
                                            @foreach ($deal as $d)
                                                <option data-tokens="{{ $d->{'name' . localePrefix()} }}" @if ($data->brand_id == $d->id) selected @endif value="{{ $d->productdetail[0]->id }}">{{ $d->{'name' . localePrefix()} }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('date') }}</label>

                                        <input type="date" class="form-control" value="{{ $data->date }}" name="date">

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('delay_to') }}</label>
                                        <input type="date" class="form-control" value="{{ $data->delay_to }}" name="delay_to">

                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('payment') }}</label>

                                        <select class="form-control selectpicker" name="payment" data-live-search="true">

                                            <option data-tokens="{{ __('cash') }}" @if ($data->brand_id == 'cash') selected @endif value="cash">{{ __('cash') }}</option>
                                            <option data-tokens="{{ __('transaction') }}" @if ($data->brand_id == 'transaction') selected @endif value="transaction">{{ __('transaction') }}</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('cuurency') }}</label>

                                        <select class="form-control selectpicker" name="currency" data-live-search="true">

                                            <option data-tokens="{{ __('SR') }}" value="SR">{{ __('SR') }}</option>

                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row">

                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('announcement') }}</label>
                                        <input type="text" class="form-control" value="{{ $data->announcement }}" name="announcement">

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('cash_account') }}</label>
                                        <input type="text" class="form-control" value="{{ $data->cash_account }}" name="cash_account">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('refrence') }}</label>
                                        <input type="text" class="form-control" value="{{ $data->refrence }}" name="refrence">

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('refrence_number') }}</label>
                                        <input type="text" class="form-control" value="{{ $data->refrence_number }}" name="refrence_number">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('refrence_date') }}</label>
                                        <input type="date" class="form-control" value="{{ $data->refrence_date }}" name="refrence_date">

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('supply') }}</label>
                                        <input type="date" class="form-control" value="{{ $data->supply }}" name="supply">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('sales_emp') }}</label>
                                        <input type="text" class="form-control" value="{{ $data->sales_emp }}" name="sales_emp">

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">{{ __('side_project') }}</label>
                                        <input type="date" class="form-control" value="{{ $data->side_project }}" name="side_project">

                                    </div>
                                </div>
                            </div>



                            <div class="row">

                                <div class="col"><button type="submit" class="btn btn-success">{{ __('save') }}</button></div>
                            </div>


                        </form>
                    </div>

                </div>
            </div>


        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/bs-select.min.js') }}"></script>
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
    <script>
        $(document).ready(function() {
            // Handle click event on "Edit" button
            $('edit-data').click(function(e) {
                e.preventDefault();

                // Get the garage ID from the data-id attribute
                var id = $(this).data('id');

                // Make an AJAX request to fetch garage details
                $.ajax({
                    url: '/editrequestitem/' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        $('#customModalTwoLabel').html('{{ __('edit_garage') }}');

                        $('form').attr('action', '/update_reques/' + id);
                        $('form').append('<input type="hidden" name="_method" value="PUT">');
                        $('#actualNumber"]').val(data.quantity_requested);
                        $('#editedNumber').val(data.quantity_requested);
                        $('input[name="quantity_given"]').val(data.quantity_given);
                        $('input[name="approx_price"]').val(data.approx_price);

                        $('select[name="supplier_id"]').val(data.supplier_id);
                        $('select[name="supplier_id"]').selectpicker('refresh');

                    },
                    error: function() {
                        // Handle error if necessary
                        alert('Error fetching garage details.');
                    }
                });
            });
        });
        let actual = $("#actualNumber").val();
        $(function() {
            $("#editedNumber").keydown(function() {
                // Save old value.
                if (!$(this).val() || (parseInt($(this).val()) <= actual && parseInt($(this).val()) >= 0))
                    $(this).data("old", $(this).val());
            });
            $("#editedNumber").keyup(function() {
                // Check correct, else revert back to old value.
                if (!$(this).val() || (parseInt($(this).val()) <= actual && parseInt($(this).val()) >= 0))
                ;
                else
                    $(this).val($(this).data("old"));
            });
        });
    </script>
@endsection
