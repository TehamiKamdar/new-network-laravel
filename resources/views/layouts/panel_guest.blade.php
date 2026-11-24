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
    <link href="{{ asset("assets/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset("assets/css/icons.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset("assets/css/app.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset("assets/css/custom.min.css")}}" rel="stylesheet" type="text/css" />

    @stack('top_scripts')
</head>

<style>
    .notification-wrapper {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 99999;

        display: flex;
        flex-direction: column;
        gap: 10px;

        width: 350px;
        max-width: calc(100% - 40px);

        pointer-events: none;
    }

    .notification-wrapper .notification {
        pointer-events: auto;
        width: 100%;
    }
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
    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <div class="auth-page-content">
            
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="index.html" class="d-inline-block auth-logo">
                                    <img src="assets/images/logo-light.png" alt="" height="20">
                                </a>
                            </div>
                            <p class="mt-3 fs-15 fw-medium">Premium Admin & Dashboard Template</p>
                        </div>
                    </div>
                </div>

                @yield("content")

            </div>
        </div>

    </div>

    <script src="{{asset('assets/js/libs/bootstrap/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('assets/js/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('assets/js/libs/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
    <script src="{{asset('assets/js/plugins.js')}}"></script>

    <!-- particles js -->
    <script src="{{asset('assets/js/libs/particles.js/particles.js')}}"></script>
    <!-- particles app js -->
    <script src="{{asset('assets/js/pages/particles.app.js')}}"></script>

    <script src="{{ asset("vendor_assets/js/jquery/jquery-3.5.1.min.js") }}"></script>
    <script src="{{ asset("vendor_assets/js/jquery.validate.min.js") }}"></script>

    @stack('scripts')

    <script>
        function showPassword(id) {
            let password = "password", text = "text";

            if ($(`#${id}`).attr("type") == password) {
                $(`#${id}`).attr('type', text);
                $(`#${id}-icon`).removeClass('ri-eye-off-fill');
                $(`#${id}-icon`).addClass('ri-eye-fill');
            }
            else if ($(`#${id}`).attr("type") == text) {
                $(`#${id}`).attr('type', password);
                $(`#${id}-icon`).removeClass('ri-eye-fill');
                $(`#${id}-icon`).addClass('ri-eye-off-fill');
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