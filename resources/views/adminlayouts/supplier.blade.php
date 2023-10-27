@extends('layouts.main')
@section('styles')
@endsection

@section('content')
    <div class="t-header">{{ __('supplier_management') }}</div>
    <br>
    <br>
    <br>
    <button type="button" id="addnew" class="btn btn-primary">
        {{ __('add_new') }}
    </button>

    <div style="display: none" id="forms">
        <form action="{{ route('supplier.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('name_ar') }}</label>
                        <input type="text" class="form-control" name="supplier_name_ar">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('name_en') }}</label>
                        <input type="text" class="form-control" name="supplier_name_en">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('address_ar') }}</label>
                        <input type="text" class="form-control" name="address_ar">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('address_en') }}</label>
                        <input type="text" class="form-control" name="address_en">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('phone') }}</label>
                        <input type="text" class="form-control" name="phone">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success">{{ __('save') }}</button>





        </form>
    </div>
    <div style="display: none" id="forms1">
        <form method="post" id="ups">
            @csrf

            @method('PUT')

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('name_ar') }}</label>
                        <input type="text" class="form-control" name="supplier_name_ar">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('name_en') }}</label>
                        <input type="text" class="form-control" name="supplier_name_en">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('address_ar') }}</label>
                        <input type="text" class="form-control" name="address_ar">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('address_en') }}</label>
                        <input type="text" class="form-control" name="address_en">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('phone') }}</label>
                        <input type="text" class="form-control" name="phone">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success">{{ __('save') }}</button>





        </form>
    </div>
    <!-- Modal -->


    <div class="table-responsive">
        <table id="copy-print-csv" class="table custom-table">
            <thead>
                <tr>
                    <th>{{ 'name' }}</th>
                    <th>{{ 'phone' }}</th>
                    <th>{{ 'address' }}</th>

                    <th>{{ 'edit' }}</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($data as $d)
                    <tr>
                        <td>{{ $d->{'supplier_name' . localePrefix()} }}</td>
                        <td>{{ $d->phone }}</td>
                        <td>{{ $d->{'address' . localePrefix()} }}</td>

                        <td><a href="#" class="btn btn-primary btn-sm edit-garage" data-toggle="modal" data-target="#customModalTwo" data-id="{{ $d->id }}">{{ __('edit') }}</a>

                            <form action="{{ route('supplier.destroy', $d->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('Are_you_sure_you_want_to_delete_this_item?') }}')">{{ __('delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    </div>
    </div>
@endsection

@section('script')
    <!-- Add this script to your view -->

    <script>
        $(document).ready(function() {
            $('#addnew').click(function(e) {
                e.preventDefault();

                $('#forms').toggle();
            })
            // Handle click event on "Edit" button
            $('.edit-garage').click(function(e) {
                e.preventDefault();

                // Get the garage ID from the data-id attribute
                var id = $(this).data('id');

                // Make an AJAX request to fetch garage details
                $.ajax({
                    url: '/supplier/' + id + '/edit',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#ups').attr('action', '/supplier/' + id);
                        $('#ups').append('<input type="hidden" name="_method" value="PUT">');
                        $('input[name="supplier_name_ar"]').val(data.supplier_name_ar);
                        $('input[name="supplier_name_en"]').val(data.supplier_name_en);
                        $('input[name="address_ar"]').val(data.address_ar);
                        $('input[name="address_en"]').val(data.address_en);
                        $('input[name="phone"]').val(data.phone);
                        $('#forms1').toggle();


                    },
                    error: function() {
                        // Handle error if necessary
                        alert('Error fetching garage details.');
                    }
                });
            });
        });
    </script>
@endsection
