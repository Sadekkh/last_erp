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
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{ __('request') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">{{ __('restriction') }}</a>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="table-responsive">

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
                                            <td>
                                                @if ($d->state == 'pending')
                                                    <a href="{{ route('create_stock', $d->id) }}" class="btn btn-primary btn-sm edit-data">{{ __('restriction') }}</a>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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
                                    @foreach ($req as $d)
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
