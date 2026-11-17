<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <link rel="icon" type="image/png" href="<?php echo e(\App\Helper\Static\Methods::staticAsset("img/favicon.png")); ?>">

    <?php echo SEOMeta::generate(); ?>

    <?php echo OpenGraph::generate(); ?>

    <?php echo Twitter::generate(); ?>

    <?php echo JsonLd::generate(); ?>


    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <?php echo $__env->yieldPushContent('styles'); ?>
    <?php echo $__env->yieldPushContent('extended_styles'); ?>
    <link
        href="<?php echo e(\App\Helper\Static\Methods::staticAsset("publisher_dashboard/lib/fontawesome-free/css/all.min.css")); ?>"
        rel="stylesheet">
    <link href="<?php echo e(\App\Helper\Static\Methods::staticAsset("publisher_dashboard/lib/ionicons/css/ionicons.min.css")); ?>"
        rel="stylesheet">
    <link href="<?php echo e(\App\Helper\Static\Methods::staticAsset("publisher_dashboard/lib/typicons.font/typicons.css")); ?>"
        rel="stylesheet">
    <link
        href="<?php echo e(\App\Helper\Static\Methods::staticAsset("publisher_dashboard/lib/flag-icon-css/css/flag-icon.min.css")); ?>"
        rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- azia CSS -->
    <link rel="stylesheet" href="<?php echo e(\App\Helper\Static\Methods::staticAsset("publisher_dashboard/css/theme.css")); ?>">
    <link rel="stylesheet" href="<?php echo e(\App\Helper\Static\Methods::staticAsset("libs/toastr/build/toastr.min.js")); ?>">
    <link rel="stylesheet" href="<?php echo e(\App\Helper\Static\Methods::staticAsset("libs/toastr/build/toastr.min.css")); ?>">
    <style>
        /* Pagination Wrapper */
        .atbd-page {
            display: flex;
            justify-content: flex-end;
        }

        /* Pagination List */
        .atbd-pagination {
            list-style: none;
            padding: 0;
            margin: 0;
            gap: 6px;
        }

        /* Pagination Item */
        .atbd-pagination__item {
            display: inline-flex;
        }

        /* Pagination Links */
        .atbd-pagination__link {
            min-width: 36px;
            height: 36px;
            padding: 0 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            border-radius: 6px;
            border: 1px solid #e5e9f2;
            color: var(--ink);
            text-decoration: none;
            background: #ffffff;
            transition: all 0.2s ease;
        }

        /* Hover */
        .atbd-pagination__link:hover {
            background: #ff3838;
            color: #ffffff;
            border-color: #ff3838;
        }

        /* Active Page */
        .atbd-pagination__link.active {
            background: #ff3838;
            color: #ffffff;
            border-color: #ff3838;
            cursor: default;
        }

        /* Disabled */
        .atbd-pagination__item.disabled .atbd-pagination__link {
            color: #c6d0dc;
            border-color: #e5e9f2;
            background: #f8f9fb;
            cursor: not-allowed;
        }

        /* Prev / Next */
        .pagination-control {
            font-size: 18px;
            line-height: 1;
        }

        /* Pagination Select Wrapper */
        .paging-option {
            display: flex;
            align-items: center;
        }

        /* Page Selection Dropdown */
        .page-selection {
            height: 36px;
            padding: 0 12px;
            font-size: 14px;
            border-radius: 6px;
            border: 1px solid #e5e9f2;
            background-color: #ffffff;
            color: var(--ink);
            cursor: pointer;
            outline: none;
            transition: all 0.2s ease;
        }

        /* Hover */
        .page-selection:hover {
            border-color: var(--ink);
        }

        /* Focus */
        .page-selection:focus {
            border-color: var(--ink);
            box-shadow: 0 0 0 2px rgba(95, 99, 242, 0.15);
        }

        /* Disabled */
        .page-selection:disabled {
            background: #f8f9fb;
            color: #c6d0dc;
            cursor: not-allowed;
        }

        /* Align nicely inside pagination */
        .atbd-pagination__item .page-selection {
            margin-left: 8px;
        }

        @media (max-width: 576px) {
            .atbd-pagination__link {
                min-width: 32px;
                height: 32px;
                font-size: 13px;
            }

            .page-selection {
                height: 32px;
                font-size: 13px;
            }
        }

        .notification-wrapper {
            position: fixed;
            z-index: 9999;
        }

        .notification-wrapper.top-right {
            top: 20px;
            right: 20px;
        }

        .atbd-notification-box {
            background: #fff;
            border-left: 4px solid #28a745;
            padding: 15px 20px;
            min-width: 300px;
            border-radius: 6px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .notification-success {
            border-color: #28a745;
        }

        .atbd-notification-box__icon {
            margin-right: 12px;
            color: #28a745;
        }

        .atbd-notification-box__text h6 {
            margin: 0;
            font-size: 14px;
            font-weight: 600;
        }

        .atbd-notification-box__text p {
            margin: 0;
            font-size: 13px;
            color: #666;
        }

        .atbd-notification-box__close {
            margin-left: auto;
            color: #999;
            cursor: pointer;
        }
    </style>
</head>

<body class="layout-light top-menu overlayScroll">

    <div class="notification-wrapper top-right"></div>
    <?php echo $__env->make("partial.publisher.aside", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="app-main">

        <?php echo $__env->make("partial.publisher.header", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <main class="app-content">
            <?php echo $__env->yieldContent("content"); ?>
        </main>
    </div>




    <script
        src="<?php echo e(\App\Helper\Static\Methods::staticAsset("publisher_dashboard/lib/jquery/jquery.min.js")); ?>"></script>
    <script
        src="<?php echo e(\App\Helper\Static\Methods::staticAsset("publisher_dashboard/lib/bootstrap/js/bootstrap.bundle.min.js")); ?>"></script>
    <script
        src="<?php echo e(\App\Helper\Static\Methods::staticAsset("publisher_dashboard/lib/ionicons/ionicons.js")); ?>"></script>
    <script
        src="<?php echo e(\App\Helper\Static\Methods::staticAsset("publisher_dashboard/lib/jquery.flot/jquery.flot.js")); ?>"></script>
    <script
        src="<?php echo e(\App\Helper\Static\Methods::staticAsset("publisher_dashboard/lib/jquery.flot/jquery.flot.resize.js")); ?>"></script>
    <script
        src="<?php echo e(\App\Helper\Static\Methods::staticAsset("publisher_dashboard/lib/chart.js/Chart.bundle.min.js")); ?>"></script>
    <script
        src="<?php echo e(\App\Helper\Static\Methods::staticAsset("publisher_dashboard/lib/peity/jquery.peity.min.js")); ?>"></script>

    <script src="<?php echo e(\App\Helper\Static\Methods::staticAsset("publisher_dashboard/js/azia.js")); ?>"></script>
    <script
        src="<?php echo e(\App\Helper\Static\Methods::staticAsset("publisher_dashboard/js/chart.flot.sampledata.js")); ?>"></script>
    <script
        src="<?php echo e(\App\Helper\Static\Methods::staticAsset("publisher_dashboard/js/dashboard.sampledata.js")); ?>"></script>

    <script src="<?php echo e(\App\Helper\Static\Methods::staticAsset("libs/toastr/build/toastr.min.js")); ?>"></script>

    <script src="https://unpkg.com/feather-icons"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
    <?php echo $__env->yieldPushContent('extended_scripts'); ?>

    <script>
        

        let toastCount = 0;

        function createToast(type, content) {
            let icon = '', toast = '';
            const notificationShocase = $('.notification-wrapper');

            if (type)
                icon = 'check-circle';
            else
                icon = 'x-circle';

            toast = `
                    <div class="atbd-notification-box notification-${type} notification-${toastCount}">
                        <div class="atbd-notification-box__content media">
                            <div class="atbd-notification-box__icon">
                                <span data-feather="${icon}"></span>
                            </div>
                            <div class="atbd-notification-box__text media-body">
                                <h6>Notification</h6>
                                ${content}
                            </div>
                        </div>
                        <a href="#" class="atbd-notification-box__close" data-toast="close">
                            <span data-feather="x"></span>
                        </a>
                    </div>
                    `;

            notificationShocase.append(toast);
            toastCount++;
        }

        function normalMsg(response) {
            let content = `<p>${response.message}</p>`;

            let duration = (optionValue, defaultValue) =>
                typeof optionValue === "undefined" ? defaultValue : optionValue;

            let type = "danger";
            if (response.success)
                type = "success";

            createToast(type, content);
            feather.replace();
            let thisToast = toastCount - 1;

            $('*[data-toast]').on('click', function () {
                $(this).parent('.atbd-notification-box').remove();
            })

            setTimeout(function () {
                $(document).find(".notification-" + thisToast).remove();
            }, duration(6000));
        }

        function copyToClipboard(elem) {
            // create hidden text element, if it doesn't already exist

            var targetId = "_hiddenCopyText_";
            var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
            var origSelectionStart, origSelectionEnd;
            if (isInput) {
                // can just use the original source element for the selection and copy
                target = elem;
                origSelectionStart = elem.selectionStart;
                origSelectionEnd = elem.selectionEnd;
            } else {
                // must use a temporary form element for the selection and copy
                target = document.getElementById(targetId);
                if (!target) {
                    var target = document.createElement("textarea");
                    target.style.position = "absolute";
                    target.style.left = "-9999px";
                    target.style.top = "0";
                    target.id = targetId;
                    document.body.appendChild(target);
                }
                target.value = elem.textContent.trim();
            }
            // select the content
            var currentFocus = document.activeElement;
            target.focus();
            target.setSelectionRange(0, target.value.length);

            // copy the selection
            var succeed;
            try {
                succeed = document.execCommand("copy");
            } catch (e) {
                succeed = false;
            }
            // restore original focus
            if (currentFocus && typeof currentFocus.focus === "function") {
                currentFocus.focus();
            }

            if (isInput) {
                // restore prior selection
                elem.setSelectionRange(origSelectionStart, origSelectionEnd);
            } else {
                // clear temporary content
                target.textContent = "";
            }
            return succeed;
        }

        function showErrors(response) {
            let duration = (optionValue, defaultValue) =>
                typeof optionValue === "undefined" ? defaultValue : optionValue;

            let errorContent = "";

            if (response.responseJSON.hasOwnProperty("errors")) {
                Object.values(response.responseJSON.errors).forEach(errors => {
                    errors.forEach(error => {
                        errorContent += `<p>${error}</p>`
                    });
                });
            } else if (response.responseJSON.hasOwnProperty("message")) {
                errorContent += `<p>${response.responseJSON.message}</p>`
            }

            createToast("danger", errorContent);
            feather.replace();
            let thisToast = toastCount - 1;

            $('*[data-toast]').on('click', function () {
                $(this).parent('.atbd-notification-box').remove();
            })

            setTimeout(function () {
                $(document).find(".notification-" + thisToast).remove();
            }, duration(6000));
        }

        document.addEventListener("DOMContentLoaded", function () {
            const now = new Date();

            $('.current-date').text(
                `${now.toLocaleDateString("en-US", { weekday: "long" })}, ${now.getDate()} ${now.toLocaleDateString("en-US", { month: "short" })}`
            );
            $(".btn-author-action").on("click", function () {
                $(".mobile-author-actions").toggleClass("show");
                $(".mobile-search").removeClass("show");
                $(".btn-search").removeClass("search-active");
            });
            $(".sales-target__progress-bar").each(function () {
                var bar = $(this).find(".bar");
                var val = $(this).find("span");
                var per = parseInt(val.text(), 10);
                var $right = $('.right');
                var $back = $('.back');

                $({
                    p: 0
                }).animate({
                    p: per
                }, {
                    duration: 3000,
                    step: function (p) {
                        bar.css({
                            transform: "rotate(" + (45 + (p * 1.8)) + "deg)"
                        });
                        val.text(p | 0);
                    }
                }).delay(200);

                if (per == 100) {
                    $back.delay(2600).animate({
                        'top': '18px'
                    }, 200);
                }
                if (per == 0) {
                    $('.left').css('background', 'gray');
                }
            });
        });

        // Preloader
        window.addEventListener('load', function () {

            $(".loader-overlay").delay(500).fadeOut("slow");
            $("#overlayer").fadeOut(500, function () {
                $('body').removeClass('overlayScroll');
            });

            document.querySelector('body').classList.add("loaded")

            /* feather icon */
            feather.replace();

            /* sidebar collapse  */
            const sidebarToggle = document.querySelector(".sidebar-toggle");

            function sidebarCollapse() {
                $('.overlay-dark-sidebar').toggleClass('show');
                document.querySelector(".sidebar").classList.toggle("sidebar-collapse");
                document.querySelector(".sidebar").classList.toggle("collapsed");
                document.querySelector(".contents").classList.toggle("expanded");
            }

            if (sidebarToggle) {
                sidebarToggle.addEventListener("click", function (e) {
                    e.preventDefault();
                    sidebarCollapse();
                });
            }

            /* sidebar nav events */
            $(".sidebar_nav .has-child ul").hide();
            $(".sidebar_nav .has-child.open ul").show();
            $(".sidebar_nav .has-child >a").on("click", function (e) {
                e.preventDefault();
                $(this).parent().next("has-child").slideUp();
                $(this).parent().parent().children(".has-child").children("ul").slideUp();
                $(this).parent().parent().children(".has-child").removeClass("open");
                if ($(this).next().is(":visible")) {
                    $(this).parent().removeClass("open");
                } else {
                    $(this).parent().addClass("open");
                    $(this).next().slideDown();
                }
            });

            /* Header mobile view */
            $(window).on('resize', function () {
                var screenSize = window.innerWidth;
                if ($(this).width() <= 767.98) {
                    $(".navbar-right__menu").appendTo(".mobile-author-actions");
                    // $(".search-form").appendTo(".mobile-search");
                    $(".contents").addClass("expanded");
                    $(".sidebar ").removeClass("sidebar-collapse");
                    $(".sidebar ").addClass("collapsed");
                } else {
                    $(".navbar-right__menu").appendTo(".navbar-right");
                }
            })
                .trigger("resize");

            $(window)
                .bind("resize", function () {
                    var screenSize = window.innerWidth;
                    if ($(this).width() > 767.98) {
                        $(".atbd-mail-sidebar").addClass("show");
                    }
                })
                .trigger("resize");

            $(window)
                .bind("resize", function () {
                    var screenSize = window.innerWidth;
                    if ($(this).width() <= 991) {
                        $(".sidebar").removeClass("sidebar-collapse");
                        $(".sidebar").addClass("collapsed");
                        $(".sidebar-toggle").on("click", function () {
                            $(".overlay-dark-sidebar").toggleClass("show");
                        });
                        $(".overlay-dark-sidebar").on("click", function () {
                            $(this).removeClass("show");
                            $(".sidebar").removeClass("sidebar-collapse");
                            $(".sidebar").addClass("collapsed");
                        });
                    }
                })
                .trigger("resize");

            /* Mobile Menu */
            $(window)
                .bind("resize", function () {
                    var screenSize = window.innerWidth;
                    if ($(this).width() <= 991.98) {
                        $(".menu-horizontal").appendTo(".mobile-nav-wrapper");
                    }
                })
                .trigger("resize");
        });
    </script>



    <?php if(env("APP_ENV") == "production" && empty(request()->search)): ?>
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
    <?php endif; ?>

</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Optional: Add some interactivity
    document.addEventListener('DOMContentLoaded', function () {
        const accordionButtons = document.querySelectorAll('.accordion-button');

        accordionButtons.forEach(button => {
            button.addEventListener('click', function () {
                // You can add custom logic here
                console.log('Accordion toggled:', this.querySelector('.advertiser-name').textContent.trim());
            });
        });
    });
</script><?php /**PATH D:\pub.thousandslink.com\resources\views/layouts/publisher/publisher_panel.blade.php ENDPATH**/ ?>