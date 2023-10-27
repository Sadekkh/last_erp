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
    <button class="btn btn-primary" onclick="printInvoices()">{{ __('print') }}</button>
    <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
        <div class="card">
            <div class="card-header p-4">
                <a class="pt-2 d-inline-block" href="" data-abc="true"> <img src="{{ asset('images/' . $settings[1]->value) }}" alt="main_logo"></a>
                <div class="float-right">
                    <h3 class="mb-0"></h3>
                    {{ __('Date') }}: {{ now()->toDateTimeString() }}
                </div>
            </div>
            @yield('content')
          
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
