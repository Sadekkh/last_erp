@extends('layouts.main')
@section('styles')
@endsection

@section('content')
    <div class="t-header">{{ __('setting') }}</div>
    <br>
    <br>
    <br>
    <button type="button" id="addnew" class="btn btn-primary">
        {{ __('add_new') }}
    </button>

    <div style="display: none" id="forms">
        <form action="{{ route('setting.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">{{ __('key') }}</label>
                            <input type="text" class="form-control" disabled name="key">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">{{ __('value') }}</label>
                            <input type="text" class="form-control" name="value">
                        </div>
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
                        <label for="recipient-name" class="col-form-label">{{ __('key') }}</label>
                        <input type="text" class="form-control" disabled name="key">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{ __('value') }}</label>
                        <input type="text" class="form-control" name="value">
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
                    <th>{{ __('key') }}</th>
                    <th>{{ __('value') }}</th>
                    <th>{{ __('edit') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $d)
                    <tr>
                        <td>{{ $d->key }}</td>
                        <td>{{ $d->value }}</td>

                        <td><a href="#" class="btn btn-primary btn-sm edit-garage" data-toggle="modal" data-target="#customModalTwo" data-id="{{ $d->id }}">{{ __('edit') }}</a>

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
                    url: '/setting/' + id + '/edit',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#ups').attr('action', '/setting/' + id);
                        $('#ups').append('<input type="hidden" name="_method" value="PUT">');
                        $('input[name="key"]').val(data.key);
                        $('input[name="value"]').val(data.value);
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
