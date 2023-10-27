@extends('layouts.main')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/bs-select.css') }}">
    <link rel="stylesheet" href="{{ asset('gallery/gallery.css') }}">
    <style>
        .together {
            display: flex
        }

        .accordion.toggle-icons a[aria-expanded="false"]::before {
            position: fixed !important;
        }
    </style>
@endsection
@section('content')
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <div class="nav-tabs-container">
                <ul class="nav nav-tabs" id="myTab3" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab" aria-controls="home3" aria-selected="true">{{ __('entry_exit') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile3" aria-selected="false">{{ __('details') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="media" data-toggle="tab" href="#print2" role="tab" aria-controls="profile3" aria-selected="false">{{ __('photo') }}</a>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent3">
                    <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">
                        @include('components.entryorexit')
                    </div>
                    <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                        @include('components.main')
                    </div>
                    <div class="tab-pane fade" id="print2" role="tabpanel" aria-labelledby="print">
                        @include('components.photo')

                    </div>

                </div>
            </div>

        </div>


        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="footerCenterIconsModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="footerCenterIconsModalLabel">Modal Title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="">

                            <input type="text" hidden id="ids">
                            <div class="row">
                                <div class="col">
                                    <label for="recipient-name" class="col-form-label">{{ __('starting_time') }}</label>
                                    <input type="datetime-local" id="starting_time4" name="starting_time" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="recipient-name" class="col-form-label">{{ __('leaving_time') }}</label>
                                    <input type="datetime-local" id="ending_time4" name="end_time" class="form-control">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="icon-close"></i></button>
                        <button type="button" class="btn btn-primary"><i class="icon-check2"></i></button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script src="{{ asset('js/bs-select.min.js') }}"></script>
    <script src="{{ asset('gallery/baguetteBox.js') }}" async></script>
    <script src="{{ asset('gallery/plugins.js') }}" async></script>
    <script src="{{ asset('gallery/custom-gallery.js') }}" async></script>
    <script>
        var locale = '{{ app()->getLocale() }}';
        const inside = document.getElementById("inside");
        const outside = document.getElementById("outside");
        var assetUrl = '{{ asset('') }}';


        // Function to make input fields required
        function makeRequired(div) {
            const inputs = div.querySelectorAll("input");
            inputs.forEach(input => {
                input.required = true;
            });
        }

        // Function to make input fields not required
        function makeNotRequired(div) {
            const inputs = div.querySelectorAll("input");
            inputs.forEach(input => {
                input.required = false;
            });
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        window.addEventListener('load', () => {
            var now = new Date();
            now.setMinutes(now.getMinutes() - now.getTimezoneOffset());

            /* remove second/millisecond if needed - credit ref. https://stackoverflow.com/questions/24468518/html5-input-datetime-local-default-value-of-today-and-current-time#comment112871765_60884408 */
            now.setMilliseconds(null)
            now.setSeconds(null)

            document.getElementById('cal').value = now.toISOString().slice(0, -1);
        });
        $(document).ready(function() {
            $('#add-truck').on('click', function(e) {
                event.preventDefault()
                // Hide all divs
                $('#add-truck-field').toggle();
                const $addTruckField = $('#add-truck-field');
                if ($addTruckField.is(':hidden')) {
                    $addTruckField.find('input[type="text"]').val('');
                }
            });
            $('#add-trailer').on('click', function(e) {
                event.preventDefault()

                // Hide all divs
                $('#add-trailer-field').toggle();
                const $addTruckField = $('#add-trailer-field');
                if ($addTruckField.is(':hidden')) {
                    $addTruckField.find('input[type="text"]').val('');
                }

            });
            $('#add-driver').on('click', function(e) {
                event.preventDefault()
                $('#add-driver-field').toggle();
                const $addTruckField = $('#add-driver-field');
                if ($addTruckField.is(':hidden')) {
                    $addTruckField.find('input[type="text"]').val('');
                }

            });
        });
        $(document).ready(function() {
            $('#profile-tab3').on('click', function() {
                $.ajax({
                    type: 'GET',
                    url: '/get-maintenance-order-code',
                    success: function(data) {
                        console.log(data);
                        $('#code').empty();
                        $('#code1').empty();
                        $('#service').empty();

                        $.each(data[0], function(key, value) {
                            $('#code').append('<option value="' + value + '">' + value + '</option>');
                        });

                        $.each(data[1], function(key, value) {
                            $('#service').append('<option value="' + value.id + '">' + (locale === 'ar' ? value.name_ar : value.name_en) + '</option>');
                        });
                        $.each(data[2], function(key, value) {
                            $('#diag_emp').append('<option value="' + value.id + '">' + (locale === 'ar' ? value.name_ar : value.name_en) + '</option>');
                        });

                        // Refresh the Bootstrap Select plugin to reflect the changes
                        $('#code').selectpicker('refresh');
                        $('#service').selectpicker('refresh');
                        $('#diag_emp').selectpicker('refresh');
                    }
                });
            });
        });
        $(document).ready(function() {
            $('#media').on('click', function() {
                $.ajax({
                    type: 'GET',
                    url: '/get-maintenance-order-code',
                    success: function(data) {
                        console.log(data);

                        $('#code1').empty();

                        $.each(data[0], function(key, value) {
                            $('#code1').append('<option value="' + value + '">' + value + '</option>');
                        });


                        // Refresh the Bootstrap Select plugin to reflect the changes
                        $('#code1').selectpicker('refresh');

                    }
                });
            });
        });

        $(document).ready(function() {
            $('#service').on('change', function() {

                var id = $(this).val();

                $.ajax({
                    type: 'GET',
                    url: '/get_worker/' + id,
                    success: function(data) {
                        console.log(data);
                        $('#worker').empty();

                        $.each(data, function(key, value) {
                            $('#worker').append('<option value="' + value.id + '">' + (locale === 'ar' ? value.name_ar : value.name_en) + '</option>');
                        });
                        $('#worker').selectpicker('refresh');
                    }
                });
            });
        });
        $(document).ready(function() {
            $('#print_this').on('click', function() {

                var id = $('#maintenance_value').val();

                window.location.href = 'printIT/' + id;
            });
        });
        $(document).ready(function() {
            // Listen for changes in the "code" select
            $('#code').on('change', function() {
                var selectedCode = $(this).val();

                // Make an AJAX request to fetch data based on the selected code
                $.ajax({
                    type: 'GET',
                    url: '/fetch-data', // Replace with your actual server route
                    data: {
                        code: selectedCode
                    },
                    success: function(dat) {
                        console.log(dat)
                        const data = dat[0][0];
                        let driver
                        if (locale == 'ar') {
                            driver = data.driver.name_ar
                        }
                        if (locale == 'en') {
                            driver = data.driver.name_en
                        }
                        $('#maintenance_id').val(data.maintenance_id);
                        $('#source').val(data.source);
                        $('#entry_time').val(data.entry_time);
                        $('#driver_id').val(driver);
                        $('#reason').val(data.reason);
                        $('#diag_emp').val(data.diag_emp);
                        $('#approximate_leaving_time').val(data.approximate_leaving_time);
                        $('#leaving_time').val(data.leaving_time);
                        $('#complain').val(data.complain);
                        $('#entry_state').val(data.entry_state);
                        $('#truck_model').val(data.truck.model);
                        $('#truck_year').val(data.truck.year);
                        $('#truck_mileage').val(data.truck.mileage);
                        $('#mileage2').val(data.truck.mileage);
                        $('#truck_last_check').val(data.truck.last_check);
                        $('#trailer_model').val(data.trailer.model);
                        $('#trailer_year').val(data.trailer.year);
                        $('#trailer_last_check').val(data.trailer.last_check);
                        $('#maintenance_value').val(data.id);
                        $('#next_check').val(data.next_check);
                        $('#diag_emp').selectpicker('refresh');

                        var tableBody = $('#serviceTable tbody');
                        // Clear any existing rows
                        tableBody.empty();

                        // Iterate through dat1 and populate the table
                        $.each(dat[1], function(index, service) {
                            console.log(service);
                            var row = '<tr>' +
                                '<td>' + (locale == 'ar' ? service.worker.name_ar : service.worker.name_en) + '</td>' +
                                '<td>' + (locale == 'ar' ? service.product.name_ar : service.product.name_en) + '</td>' +
                                '<td>' + service.entry_time + '</td>' +
                                '<td>' + service.leaving_time + '</td>' +
                                '<td>' + service.status + '</td>' +
                                '<td>' + service.description + '</td>' +
                                '<td><a href="/edit-service-task/' + service.id + '" target="_blank">{{ __('edit') }}</td>' +
                                '</tr>';



                            // Append the row to the table
                            tableBody.append(row);
                        });
                        var tableBody1 = $('#materialtable tbody');
                        // Clear any existing rows
                        tableBody1.empty();

                        // Iterate through dat1 and populate the table
                        $.each(dat[1], function(ind, rep) {
                            $.each(rep.replaceditem, function(index, service) {
                                console.log(service);
                                var row = '<tr>' +
                                    '<td>' + (locale == 'ar' ? rep.product.name_ar : rep.product.name_en) + '</td>' +
                                    '<td>' + (service.olditem != null ? service.olditem.serial_num : "--") + '</td>' +
                                    '<td>' + (service.newitem != null ? service.newitem.serial_num : "--") + '</td>' +
                                    '<td>' + (service.old_prod_desc != null ? service.old_prod_desc : "--") + '</td>' +
                                    '<td>' + (service.oil_amount != null ? service.oil_amount : "--") + '</td>' +
                                    '</tr>';



                                // Append the row to the table
                                tableBody1.append(row);
                            });
                        });



                    },
                    error: function() {
                        // Handle any errors
                    }
                });
            });


        });
        $(document).ready(function() {
            // Listen for changes in the "code" select

            $('#code1').on('change', function() {
                var selectedCode = $(this).val();
                var galleryContainer = $('.galler');
                galleryContainer.empty();
                // Make an AJAX request to fetch data based on the selected code
                $.ajax({
                    type: 'GET',
                    url: '/fetch-photo', // Replace with your actual server route
                    data: {
                        code: selectedCode
                    },
                    success: function(dat) {
                        console.log(dat)

                        dat.forEach(function(file_name) {
                            console.log(file_name)
                            var imageElement = $('<div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-6">' +
                                '<a href="' + assetUrl + 'images/products/' + file_name.file_name + '" class="effects">' +
                                '<img src="' + assetUrl + 'images/products/' + file_name.file_name + '" class="img-fluid" alt="Wafi Admin">' +
                                '<div class="overlay">' +
                                '<span class="expand">+</span>' +
                                '</div>' +
                                '</a>' +
                                '</div>');

                            galleryContainer.append(imageElement);
                        });
                    },
                    error: function() {

                    }
                });
            });


        });
        $(document).ready(function() {
            $('open-modal-button').click(function(e) {
                e.preventDefault();
                let d = $(this).data('start_time');
                $('#starting_time4').val($(this).data('start_time'));
                $('#ending_time4').val($(this).data('end_time'));
            });
        });

        $(document).ready(function() {
            $('#serializeButton').on('click', function() {
                event.preventDefault();
                var formData = new FormData($('#maintenanceForm')[0]);

                console.log(formData);

                $.ajax({
                    url: '{{ route('update_maintenance') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#maintenanceForm').find(':input').val('');

                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                    }
                });
            });
            $('#add_service_btn').on('click', function() {
                event.preventDefault();
                var formData = new FormData($('#add_service')[0]);

                console.log(formData);

                $.ajax({
                    url: '{{ route('savejob') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#maintenanceForm').find(':input').val('');

                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                    }
                });
            });
        });
    </script>
@endsection
