<?php $__env->startPush('title'); ?>
    Affiliate Links
<?php $__env->stopPush(); ?>

<?php if (! $__env->hasRenderedOnce('5e2a207a-d257-46ff-a40b-766d2c15ae68')): $__env->markAsRenderedOnce('5e2a207a-d257-46ff-a40b-766d2c15ae68');
$__env->startPush('styles'); ?>
<style>
    .copy-btn {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        padding: 0;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        background: #fff;
        color: #64748b;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .copy-btn:hover {
        background: #f1f5f9;
        border-color: #cbd5e1;
        color: #334155;
    }

    .copy-btn svg {
        width: 17px;
        height: 17px;
        transition: all 0.2s ease;
    }

    .copy-btn .icon-check {
        display: none;
    }

    .copy-btn .tip {
        position: absolute;
        bottom: calc(100% + 9px);
        left: 50%;
        transform: translate(-50%, 4px);
        padding: 5px 9px;
        border-radius: 5px;
        background: #0f172a;
        color: #fff;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: all 0.2s ease;
        pointer-events: none;
    }

    .copy-btn .tip::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translateX(-50%);
        border: 5px solid transparent;
        border-top-color: #0f172a;
    }

    .copy-btn.copied {
        background: #ecfdf5;
        border-color: #a7f3d0;
        color: #059669;
    }

    .copy-btn.copied .icon-copy {
        display: none;
    }

    .copy-btn.copied .icon-check {
        display: block;
    }

    .copy-btn.copied .tip {
        opacity: 1;
        visibility: visible;
        transform: translate(-50%, 0);
    }

    .copy-btn:focus-visible {
        outline: 3px solid rgba(59, 130, 246, 0.2);
        outline-offset: 2px;
    }
</style>
<script>
    function changeLimit() {
        $.ajax({
            url: '<?php echo e(route("publisher.set-limit")); ?>',
            type: 'GET',
            data: { "limit": $("#limit").val(), "type": "text_link" },
            success: function (response) {
                if (response) {
                    window.location.reload();
                }
            },
            error: function (response) {

            }
        });
    }
    function copyText(button, text) {
        if (!text) return;

        navigator.clipboard.writeText(text).then(() => {
            const originalText = button.innerText;

            button.innerText = 'Copied!';
            button.disabled = true;
            button.classList.add("text-success");

            setTimeout(() => {
                button.innerText = originalText;
                button.disabled = false;
                button.classList.remove("text-success");
            }, 1500);
        });
    }
    function sendAjaxRequest(url, urlParams, dataObj) {
        history.pushState({}, null, url.href);

        url = new URL(document.URL);
        urlParams = url.searchParams;

        dataObj.search_by_name = urlParams.get(`search_by_name`);

        let exportXLSXURL = "<?php echo e(route("publisher.creatives.text-links.export", ['type' => 'xlsx'])); ?>";
        let exportCSVURL = "<?php echo e(route("publisher.creatives.text-links.export", ['type' => 'csv'])); ?>";

        exportXLSXURL = `${exportXLSXURL}${url.search}`;
        exportCSVURL = `${exportCSVURL}${url.search}`;

        $("#exportCSV").attr("href", exportCSVURL);
        $("#exportXLSX").attr("href", exportXLSXURL);

        $.ajax({
            url: '<?php echo e(route("publisher.creatives.text-links.list")); ?>',
            type: 'GET',
            data: dataObj,
            beforeSend: function () {
                $("#gridLoader3").removeClass("d-none");
            },
            success: function (response) {
                $("#totalResults").html(response.total);
                $("#ap-overview").html(response.html);
            },
            error: function (response) {

            }
        });
    }
    function filterTextLinks(field, id) {
        showClear(id);
        let data = $(`#${id}`).val();
        let dataObj = { [`${field}`]: data.toString() };

        $("#ap-overview").html("");

        let url = new URL(document.URL);
        let urlParams = url.searchParams;

        if (url.search) {
            if (urlParams.has(`${field}`)) {
                urlParams.delete(`${field}`);
            }
            if (urlParams.has('page')) {
                urlParams.delete('page');
                urlParams.append('page', "1");
            }
        }
        urlParams.append(field, data);
        sendAjaxRequest(url, urlParams, dataObj);
    }
    function showClear(key) {
        $(`#clear${key}`).show();
    }
    function clearFilter(key) {
        let url = new URL(document.URL);
        let urlParams = url.searchParams;
        if (key === "clearSearchByName") {
            $("#SearchByName").val("");
            if (urlParams.has(`search_by_name`)) {
                urlParams.delete(`search_by_name`);
                filterTextLinks("search_by_name", "SearchByName");
            }
        }
        history.pushState({}, null, url.href);
        $(`#${key}`).hide();
    }
    document.addEventListener("DOMContentLoaded", function () {
        $("#limit").change(() => {
            changeLimit();
        });
        $("#SearchByName").keyup(() => {
            filterTextLinks("search_by_name", "SearchByName");
            if (!$("#SearchByName").val()) {
                $(`#clearSearchByName`).hide();
            }
        });
        $("#gridLoader3").addClass('d-none');



        /* ---------- copy-to-clipboard buttons (Affiliate Links table) ---------- */
        document.querySelectorAll('.copy-btn[data-copy]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var text = btn.getAttribute('data-copy');
                var mark = function () {
                    btn.classList.add('copied');
                    setTimeout(function () { btn.classList.remove('copied'); }, 1400);
                };
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(text).then(mark).catch(mark);
                } else {
                    mark();
                }
            });
        });
    });
</script>

<?php $__env->stopPush(); endif; ?>

<?php if (! $__env->hasRenderedOnce('bfb32504-6908-4023-962d-50f27d84f846')): $__env->markAsRenderedOnce('bfb32504-6908-4023-962d-50f27d84f846');
$__env->startPush('scripts'); ?>
<script>
    $(document).on('click', '.copy-btn', async function () {
        const button = $(this);
        const text = button.attr('data-copy');

        if (!text) return;

        try {
            await navigator.clipboard.writeText(text);

            button.addClass('copied');
            button.find('.tip').text('Copied!');

            clearTimeout(button.data('copyTimer'));

            const timer = setTimeout(function () {
                button.removeClass('copied');
                button.find('.tip').text('Copied!');
            }, 2000);

            button.data('copyTimer', timer);

        } catch (error) {
            button.find('.tip').text('Copy failed');
            button.addClass('copied');

            setTimeout(function () {
                button.removeClass('copied');
                button.find('.tip').text('Copied!');
            }, 2000);
        }
    });
</script>

<?php $__env->stopPush(); endif; ?>

<?php $__env->startSection("content"); ?>

    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Affiliate Links</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Offers</a></li>
                            <li class="breadcrumb-item active">Affiliate Links</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card" id="apiKeyList">
                    <div class="card-header">
                        <div class="d-flex align-items-center flex-wrap gap-2">
                            <div class="flex-grow-1">
                                <div class="search-box">
                                    <input type="text" class="form-control search" placeholder="Search for links..."
                                        value="<?php echo e(request()->search_by_name); ?>" id="SearchByName">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>

                            <div class="flex-shrink-0">
                                <div class="hstack text-nowrap gap-2">
                                    <button class="btn btn-soft-success material-shadow-none">Export</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div id="ap-overview">
                        <?php echo $__env->make("template.publisher.creatives.text-links.list_view", compact('links'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.publisher.publisher_panel", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pub.affishare.com\resources\views/template/publisher/creatives/text-links/list.blade.php ENDPATH**/ ?>