<?php $__env->startPush('title'); ?>
    Offers
<?php $__env->stopPush(); ?>

<?php if (! $__env->hasRenderedOnce('c4213005-fb4a-40f5-9f66-eda28f10908a')): $__env->markAsRenderedOnce('c4213005-fb4a-40f5-9f66-eda28f10908a');
$__env->startPush('styles'); ?>
<style>
    .user-member__form .form-control {
        padding: 10px 33px 10px 13px !important;
    }
</style>
<?php $__env->stopPush(); endif; ?>

<?php if (! $__env->hasRenderedOnce('13a89622-c1fa-49a1-a57d-972657e81c9a')): $__env->markAsRenderedOnce('13a89622-c1fa-49a1-a57d-972657e81c9a');
$__env->startPush('scripts'); ?>
<script>
    function changeLimit() {
        $.ajax({
            url: '<?php echo e(route("publisher.set-limit")); ?>',
            type: 'GET',
            data: { "limit": $("#limit").val(), "type": "coupon" },
            success: function (response) {
                if (response) {
                    window.location.reload();
                }
            },
            error: function (response) {

            }
        });
    }
    function clickToCopy(id, msg) {
        copyToClipboard(document.getElementById(id))
        normalMsg({ "message": msg, "success": true });
    }
    function prepareVoucherFormContent(id) {
        $.ajax({
            url: `/publisher/creatives/coupons/${id}`,
            type: 'GET',
            success: function (response) {
                $("#voucherModalContent").html(response)
            },
            error: function (response) {

            }
        });
    }
    function sendAjaxRequest(url, urlParams, dataObj) {
        history.pushState({}, null, url.href);

        url = new URL(document.URL);
        urlParams = url.searchParams;

        dataObj.search_by_name = urlParams.get(`search_by_name`);

        let exportXLSXURL = "<?php echo e(route("publisher.creatives.coupons.export", ['type' => 'xlsx'])); ?>";
        let exportCSVURL = "<?php echo e(route("publisher.creatives.coupons.export", ['type' => 'csv'])); ?>";

        exportXLSXURL = `${exportXLSXURL}${url.search}`;
        exportCSVURL = `${exportCSVURL}${url.search}`;

        $("#exportCSV").attr("href", exportCSVURL);
        $("#exportXLSX").attr("href", exportXLSXURL);

        $.ajax({
            url: '<?php echo e(route("publisher.creatives.coupons.list")); ?>',
            type: 'GET',
            data: dataObj,
            beforeSend: function () {
            },
            success: function (response) {
                $("#totalResults").html(response.total);
                $("#ap-overview").html(response.html);
                // changeLimit();
            },
            error: function (response) {

            }
        });
    }
    function filterCoupons(field, id) {
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
                filterCoupons("search_by_name", "SearchByName");
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
            filterCoupons("search_by_name", "SearchByName");
            if (!$("#SearchByName").val()) {
                $(`#clearSearchByName`).hide();
            }
        });
        $("#gridLoader3").addClass('d-none');
    });
</script>
<?php $__env->stopPush(); endif; ?>

<?php $__env->startSection("content"); ?>


    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Coupons</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Offers</a></li>
                            <li class="breadcrumb-item active">Coupons</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card" id="apiKeyList">
                    <div class="card-header d-flex align-items-center">
                        <div class="col-md-3">
                            <div class="search-box">
                                <input type="text" class="form-control search" placeholder="Search for coupons..." value="<?php echo e(request()->search_by_name); ?>" id="SearchByName">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                    </div>
                    <?php echo $__env->make("template.publisher.creatives.coupons.list_view", compact('coupons'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.publisher.publisher_panel", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pub.affishare.com\resources\views/template/publisher/creatives/coupons/list.blade.php ENDPATH**/ ?>