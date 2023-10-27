<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <style>
        body {

            background-color: #000;
        }

        .padding {

            padding: 2rem !important;
        }

        .card {
            margin-bottom: 30px;


            border: none;
            -webkit-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
            -moz-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
            box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #e6e6f2;
        }

        h3 {
            font-size: 20px;
        }

        h5 {
            font-size: 15px;
            line-height: 26px;
            color: #3d405c;
            margin: 0px 0px 15px 0px;
            font-family: 'Circular Std Medium';
        }

        .text-dark {
            color: #3d405c !important;
        }
    </style>
</head>

<body>
    <button class="btn btn-primary" onclick="printInvoices()">Print All Invoices</button>
    <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
        <div class="card">
            <div class="card-header p-4">
                <a class="pt-2 d-inline-block" href="" data-abc="true"> <img src="{{ asset('images/' . $settings[1]->value) }}" alt="main_logo"></a>
                <div class="float-right">
                    <h3 class="mb-0">{{ __('maintenance') }}{{ $data->code }}</h3>
                    {{ __('Date') }}: {{ now()->toDateTimeString() }}
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <div class="col-sm-6">
                            <p class="card-text">{{ __('truck_model') }}: {{ $data->truck->model }}</p>
                            <p class="card-text">{{ __('truck_vin') }}: {{ $data->truck->vin }}</p>
                            <p class="card-text">{{ __('trailer_model') }}: {{ $data->trailer->model }}</p>
                            <p class="card-text">{{ __('trailer_vin') }}: {{ $data->trailer->vin }}</p>
                            <p class="card-text">{{ __('driver_name') }}: {{ $data->driver->{'name' . localePrefix()} }}</p>
                        </div>
                    </div>
                    <div class="col-sm-6 ">
                        <img src="data:image/svg+xml;base64,{{ base64_encode($qr) }}" alt="QR Code">
                    </div>
                </div>


            </div>
            
            <div class="table-responsive-sm">
                <table class="table table-striped">
                    <thead>

                        <tr>
                            <td>{{ __('service') }}</td>
                            <td>{{ __('worker') }}</td>
                            <td>{{ __('entry_time') }}:</td>
                            <td>{{ __('leaving_time') }}</td>
                            <td colspan="2">{{ __('description') }}</td>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data->mainteancetask as $d)
                            <tr>
                                <td>{{ $d->product->{'name' . localePrefix()} }}</td>
                                <td>{{ $d->worker->{'name' . localePrefix()} }}</td>
                                <td>{{ $d->entry_time }}</td>
                                <td>{{ $d->leaving_time }}</td>
                                <td colspan="2">{{ $d->description }}</td>
                            </tr>
                        @endforeach

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script>
        function printInvoices() {
            var cards = document.getElementsByClassName('card'); // Select all elements with class 'card'
            var originalContents = document.body.innerHTML;

            // Create a new div to hold the content of all the cards
            var printDiv = document.createElement('div');

            // Loop through each card and append its content to the printDiv
            for (var i = 0; i < cards.length; i++) {
                var card = cards[i];
                var clone = card.cloneNode(true); // Clone the card to preserve its structure
                printDiv.appendChild(clone);
            }

            // Replace the content of the page with the content of printDiv
            document.body.innerHTML = printDiv.innerHTML;

            // Print the page
            window.print();

            // Restore the original content of the page
            document.body.innerHTML = originalContents;
        }
    </script>
</body>

</html>
