<!DOCTYPE html>
<html>

<head>
    <title>Crypto Ticker</title>
    <style>
    ul {
        list-style-type: none;
        padding-left: 0;
    }

    .ticker-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f5f5f5;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .ticker-container h1 {
        text-align: center;
        /* Centrar el texto */
    }

    .ticker-item {
        margin-bottom: 10px;
        padding: 10px;
        background-color: #fff;
        border-radius: 5px;
    }



    @media (max-width: 768px) {
        .ticker-container {
            max-width: 100%;
        }
    }
    </style>
</head>

<body>
    <div class="ticker-container">
        <h1>Crypto Ticker</h1>
        <div id="ticker-content">
            <ul>
                @foreach($cryptos as $crypto)
                <li class="ticker-item">
                    <strong>Name:</strong> {{ $crypto['name'] }} <br>
                    <strong>Symbol:</strong> {{ $crypto['symbol'] }} <br>
                    <strong>Price USD:</strong> ${{ number_format($crypto['priceUsd'], 2) }} <br>
                    <strong>Market Cap:</strong> ${{ number_format($crypto['marketCapUsd'], 2) }} <br>
                    <strong>Volume (24h):</strong> ${{ number_format($crypto['volumeUsd24Hr'], 2) }} <br>
                    <strong>Change (24h):</strong> {{ number_format($crypto['changePercent24Hr'], 2) }}% <br>
                </li>
                <br>
                @endforeach
            </ul>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        var tickerContent = $('#ticker-content');

        setInterval(function() {
            $.ajax({
                url: '{{ route("crypto-ticker") }}',
                method: 'GET',
                success: function(response) {
                    tickerContent.find('ul').html($(response).find('ul').html());
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }, 15000);
    });
    </script>
</body>

</html>