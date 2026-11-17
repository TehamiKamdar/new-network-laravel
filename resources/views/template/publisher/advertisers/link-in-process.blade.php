<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Preparing Your Link</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f9fafb;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
            color: #111827;
        }

        .page-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .card {
            max-width: 520px;
            width: 100%;
            background: #ffffff;
            border-radius: 14px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            padding: 40px 30px;
            text-align: center;
        }

        .status-title {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .status-subtitle {
            font-size: 18px;
            color: #4b5563;
            margin-bottom: 30px;
        }

        .status-message {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .primary-button {
            display: inline-block;
            padding: 14px 36px;
            border-radius: 999px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            color: #ffffff;
            background: #111827;
            box-shadow: 0 12px 24px rgba(17,24,39,0.25);
            transition: all 0.2s ease;
        }

        .primary-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 16px 30px rgba(17,24,39,0.3);
        }

        .footer-text {
            margin-top: 35px;
            font-size: 14px;
            color: #6b7280;
        }

        .footer-text a {
            color: #111827;
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .status-title {
                font-size: 28px;
            }
            .status-subtitle {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>

<div class="page-wrapper">
    <div class="card">

        <div class="status-title">
            Please wait
        </div>

        <div class="status-subtitle">
            Your {{ request()->segment(1) == "deeplink" ? "deep" : "tracking" }} link is being prepared
        </div>

        @if(isset($advertiser->name))
            <div class="status-message">
                We’ve successfully received your request.  
                Your link will be ready shortly and you’ll be redirected automatically.
                <br><br>
                If you prefer, you can continue directly to the advertiser below.
            </div>

            <a href="{{ $advertiser->url }}" target="_blank" class="primary-button">
                Visit {{ $advertiser->name }}
            </a>
        @endif

        <div class="footer-text">
            Need help? Contact us at
            <a href="mailto:info@thousandslink.com">info@thousandslink.com</a>
        </div>

    </div>
</div>

</body>
</html>
