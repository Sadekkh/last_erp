@extends('layouts.main')
@section('styles')
@endsection

@section('content')
    <div class="t-header">{{ __('driver_management') }}</div>
    <br>
    <br>
    <br>
    <button type="button" id="addnew" class="btn btn-primary">
        {{ __('add_new') }}
    </button>

    <div style="display: none" id="forms">
        <form action="{{ route('driver.store') }}" method="post">
            @csrf
            <div class="row">

                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('name_ar') }}</label>
                        <input type="text" class="form-control" name="name_ar">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('name_en') }}</label>
                        <input type="text" class="form-control" name="name_en">
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
                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('cin') }}</label>
                        <input type="number" class="form-control" name="cin">
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
                        <input type="text" class="form-control" name="name_ar">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('name_en') }}</label>
                        <input type="text" class="form-control" name="name_en">
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
                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('cin') }}</label>
                        <input type="number" class="form-control" name="cin">
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
                    <th>{{ __('name') }}</th>
                    <th>{{ __('phone') }}</th>
                    <th>{{ __('cin') }}</th>

                    <th>{{ __('edit') }}</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($data as $d)
                    <tr>
                        <td>{{ $d->{'name' . localePrefix()} }}</td>
                        <td>{{ $d->phone }}</td>
                        <td>{{ $d->cin }}</td>




                        <td><a href="#" class="btn btn-primary btn-sm edit-garage" data-toggle="modal" data-target="#customModalTwo" data-id="{{ $d->id }}">{{ __('edit') }}</a>

                            <form action="{{ route('driver.destroy', $d->id) }}" method="POST" style="display: inline;">
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
                    url: '/driver/' + id + '/edit',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#ups').attr('action', '/driver/' + id);
                        $('#ups').append('<input type="hidden" name="_method" value="PUT">');

                        $('input[name="name_ar"]').val(data.name_ar);
                        $('input[name="name_en"]').val(data.name_en);
                        $('input[name="cin"]').val(data.cin);
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
