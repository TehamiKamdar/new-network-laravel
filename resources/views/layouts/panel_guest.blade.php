<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" type="image/png" href="{{ asset("img/favicon.png") }}">

    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    {!! JsonLd::generate() !!}

    @stack('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset("publisher_dashboard/lib/fontawesome-free/css/all.min.css") }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("publisher_dashboard/css/theme.css") }}">

    @stack('top_scripts')
</head>

<style>
    /* Password Eye */
    .field-icon {
        position: absolute;
        z-index: 2;
        top: 50%;
        right: 10px;
        transform: translate(-50%, -50%);
        cursor: pointer;
    }
    .field-icon:hover {
        color: var(--teal) !important;
    }
</style>

<body>
    <main class="main-content">
        @yield("content")
    </main>

    <script src="{{ asset("vendor_assets/js/jquery/jquery-3.5.1.min.js") }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset("vendor_assets/js/jquery.validate.min.js") }}"></script>

    @stack('scripts')

    <script>
        function showPassword(id) {
            let password = "password", text = "text";

            if ($(`#${id}`).attr("type") == password) {
                $(`#${id}`).attr('type', text);
                $(`#${id}-icon`).removeClass('fa-eye-slash');
                $(`#${id}-icon`).addClass('fa-eye');
            }
            else if ($(`#${id}`).attr("type") == text) {
                $(`#${id}`).attr('type', password);
                $(`#${id}-icon`).removeClass('fa-eye');
                $(`#${id}-icon`).addClass('fa-eye-slash');
            }
        }

        // Preloader
        window.addEventListener('load', function () {

            $(".loader-overlay").delay(500).fadeOut("slow");
            $("#overlayer").fadeOut(500, function () {
                $('body').removeClass('overlayScroll');
            });

            document.querySelector('body').classList.add("loaded")

            /* feather icon */
            feather.replace();

        });
    </script>

    @if(env("APP_ENV") == "production" && empty(request()->search))
        <!-- Hotjar Tracking Code for https://pub.affentro.com/ -->
        <script>
            (function (h, o, t, j, a, r) {
                h.hj = h.hj || function () { (h.hj.q = h.hj.q || []).push(arguments) };
                h._hjSettings = { hjid: 3451709, hjsv: 6 };
                a = o.getElementsByTagName('head')[0];
                r = o.createElement('script'); r.async = 1;
                r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
                a.appendChild(r);
            })(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv=');
        </script>
    @endif

</body>

</html>