<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="verify-admitad" content="67b8b56253">
    <link rel="icon" type="image/png" href="<?php echo e(\App\Helper\Static\Methods::staticAsset("img/favicon.png")); ?>">

    <?php echo SEOMeta::generate(); ?>

    <?php echo OpenGraph::generate(); ?>

    <?php echo Twitter::generate(); ?>

    <?php echo JsonLd::generate(); ?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo e(asset("publisher_dashboard/lib/fontawesome-free/css/all.min.css")); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset("publisher_dashboard/css/theme.css")); ?>">
</head>

<body>
    <div class="auth-shell">

        <!-- ============ CHOICE SIDE ============ -->
        <div class="auth-form-side">
            <div class="auth-card">
                
                <div class="d-flex justify-content-center mb-4">
                    <img src="<?php echo e(asset('img/logo.png')); ?>" height="40">
                </div>
                

                <div class="choice-grid">

                    <a href="<?php echo e(route('register', ['type' => 'partner'])); ?>" class="choice-card">
                        <span class="cc-icon amber">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="9" cy="8" r="4" />
                                <path d="M2 21c1.4-4.2 5-6.5 7-6.5s5.6 2.3 7 6.5" />
                                <path d="M19 8v6M22 11h-6" />
                            </svg>
                        </span>
                        <h3>New to ThousandsLink?</h3>
                        <p>Create an account, set up your profile, and start matching with brands in your categories.
                        </p>
                        <span class="btn btn-amber">Create new account</span>
                    </a>

                    <a href="<?php echo e(route('login', ['type' => 'partner'])); ?>" class="choice-card">
                        <span class="cc-icon teal">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                                <path d="M10 17l5-5-5-5" />
                                <path d="M15 12H3" />
                            </svg>
                        </span>
                        <h3>Already a partner?</h3>
                        <p>Sign in to check your latest brand performance, payouts, and campaign updates.</p>
                        <span class="btn btn-primary">Log into existing account</span>
                    </a>

                </div>

            </div>
        </div>

    </div>

    <script src="<?php echo e(\App\Helper\Static\Methods::staticAsset("vendor_assets/js/jquery/jquery-3.5.1.min.js")); ?>"></script>
    <script src="<?php echo e(\App\Helper\Static\Methods::staticAsset("vendor_assets/js/jquery/jquery-ui.js")); ?>"></script>
    <script src="<?php echo e(\App\Helper\Static\Methods::staticAsset("vendor_assets/js/bootstrap/popper.js")); ?>"></script>
    <script src="<?php echo e(\App\Helper\Static\Methods::staticAsset("vendor_assets/js/bootstrap/bootstrap.min.js")); ?>"></script>
    <script src="<?php echo e(\App\Helper\Static\Methods::staticAsset("vendor_assets/js/feather.min.js")); ?>"></script>
    <script src="<?php echo e(\App\Helper\Static\Methods::staticAsset("vendor_assets/js/jquery.validate.min.js")); ?>"></script>

    <script>
        // Preloader
        window.addEventListener('load', function () {
            $(".loader-overlay").delay(500).fadeOut("slow");
            $("#overlayer").fadeOut(500, function () {
                $('body').removeClass('overlayScroll');
            });

            document.querySelector('body').classList.add("loaded");

            /* feather icon */
            feather.replace();

            // Add hover effects with mouse tracking
            const cards = document.querySelectorAll('.selection-card');

            cards.forEach(card => {
                card.addEventListener('mousemove', function (e) {
                    const rect = this.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;

                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;

                    const rotateY = (x - centerX) / 25;
                    const rotateX = (centerY - y) / 25;

                    this.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-10px)`;
                });

                card.addEventListener('mouseleave', function () {
                    this.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateY(-10px)';
                });
            });

            // Set active state based on URL
            const currentPath = window.location.pathname;
            if (currentPath.includes('register')) {
                cards[0].style.zIndex = '10';
            } else if (currentPath.includes('login')) {
                cards[1].style.zIndex = '10';
            }
        });
    </script>

    <?php if(env("APP_ENV") == "production" && empty(request()->search)): ?>
        <!-- Hotjar Tracking Code for https://pub.thousandslink.com/ -->
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
    <?php endif; ?>
</body>

</html><?php /**PATH D:\pub.affishare.com\resources\views/auth/login_view.blade.php ENDPATH**/ ?>