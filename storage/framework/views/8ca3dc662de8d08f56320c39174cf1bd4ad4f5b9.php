<?php if (! $__env->hasRenderedOnce('d6051d3a-4a72-400b-b1aa-5775c4a8f81b')): $__env->markAsRenderedOnce('d6051d3a-4a72-400b-b1aa-5775c4a8f81b');
$__env->startPush('styles'); ?>

<link rel="stylesheet" href="<?php echo e(\App\Helper\Static\Methods::staticAsset("vendor_assets/css/select2.min.css")); ?>" />
<style>
    :root {
        --ink: #405190;
        --primary-light: rgba(91, 71, 251, 0.1);
        --border-color: #eef1f7;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        display: none;
    }

    .select2-container {
        z-index: 9999 !important;
    }

    .select2-dropdown {
        z-index: 999999 !important;
    }

    /* Brand Tabs Styling */
    .nav-tabs-wrapper {
        position: relative;
    }

    .nav-tabs {
        gap: 2px;
    }

    .nav-tabs .nav-item .nav-link {
        background: transparent;
        border: none;
        color: #6c757d;
        font-weight: 500;
        font-size: 0.875rem;
        border-radius: 6px 6px 0 0 !important;
        position: relative;
        transition: all 0.2s ease;
        margin-bottom: -1px;
        border: 1px solid transparent;
        border-bottom: none;
    }

    .nav-tabs .nav-item .nav-link:hover {
        color: var(--ink);
        background-color: var(--primary-light);
        border-color: var(--border-color) var(--border-color) transparent;
    }

    .nav-tabs .nav-item .nav-link.active {
        color: var(--ink);
        background-color: white;
        border-color: var(--border-color) var(--border-color) transparent;
        border-top: 2px solid var(--ink);
        font-weight: 600;
        position: relative;
        z-index: 1;
    }

    /* Active state with top-left-right borders only */
    .nav-tabs .nav-item .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        right: 0;
        height: 1px;
        background: white;
        z-index: 2;
    }

    /* View Tabs Styling */
    .view-tabs {
        border: 1px solid var(--border-color);
        border-radius: 6px;
        overflow: hidden;
        background: white;
    }

    .view-tabs .btn {
        background: transparent;
        border: none;
        color: #6c757d;
        font-weight: 500;
        font-size: 0.875rem;
        padding: 0.5rem 1rem;
        border-radius: 0;
        transition: all 0.2s ease;
        position: relative;
    }

    .view-tabs .btn:first-child {
        border-right: 1px solid var(--border-color);
    }

    .view-tabs .btn:hover {
        color: var(--ink);
        background-color: var(--primary-light);
    }

    .view-tabs .btn-check:checked+.btn {
        color: var(--ink);
        background-color: white;
        font-weight: 600;
        position: relative;
    }

    /* Active state with top-left-right borders for view tabs */
    .view-tabs .btn-check:checked+.btn::before {
        content: '';
        position: absolute;
        top: -1px;
        left: -1px;
        right: -1px;
        height: 2px;
        background: var(--ink);
        border-radius: 6px 6px 0 0;
    }

    .view-tabs .btn-check:checked+.btn {
        border-top: 2px solid var(--ink);
        border-left: 1px solid var(--border-color);
        border-right: 1px solid var(--border-color);
        margin-top: -1px;
    }

    /* Sleek minimal design */
    .nav-tabs .nav-link,
    .view-tabs .btn {
        box-shadow: none !important;
        outline: none !important;
    }

    /* Icons styling */
    .nav-tabs .nav-link i,
    .view-tabs .btn i {
        font-size: 0.875rem;
        width: 16px;
        text-align: center;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .d-flex.justify-content-between {
            flex-direction: column !important;
            align-items: flex-start !important;
        }

        .view-toggle-container {
            margin-top: 1rem;
            width: 100%;
        }

        .nav-tabs {
            flex-wrap: wrap;
        }

        .nav-tabs .nav-item {
            margin-bottom: 0.25rem;
        }
    }

    /* Border radius fix */
    .nav-tabs .nav-link {
        border-top-left-radius: 6px !important;
        border-top-right-radius: 6px !important;
        border-bottom-left-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
    }

    .form-select[multiple]:focus,
    .form-select[multiple]:active {
        border-color: var(--ink);
        box-shadow: 0 0 0 0.25rem rgba(91, 71, 251, 0.25);
    }

    .form-check-input:checked {
        background-color: var(--amber-deep) !important;
        border-color: var(--amber-deep) !important;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--ink);
        box-shadow: 0 0 0 0.25rem rgba(91, 71, 251, 0.25);
    }

    .btn-primary {
        background-color: var(--ink);
        border-color: var(--ink);
    }

    .btn-primary:hover {
        background-color: #4a3bd9;
        border-color: #4a3bd9;
    }

    .btn-outline-secondary:hover {
        color: var(--ink);
        border-color: var(--ink);
    }

    .sticky-lg-top {
        z-index: 1020;
    }

    .border-bottom,
    .border-top {
        border-color: #eef1f7 !important;
    }

    .text-muted {
        color: #6c757d !important;
    }

    .fw-semibold {
        font-weight: 600;
    }

    option:checked {
        background-color: rgba(91, 71, 251, 0.1);
        color: var(--ink);
        font-weight: 500;
    }

    .form-check-label {
        cursor: pointer;
        transition: color 0.2s;
    }

    .form-check-label:hover {
        color: var(--ink);
    }

    .loaded-spin {
        width: 100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

<?php $__env->stopPush(); endif; ?>

<?php $__env->startPush('title'); ?>
    Brands
<?php $__env->stopPush(); ?>

<?php if (! $__env->hasRenderedOnce('fd3918b5-9103-467c-a85b-2dc6d24f799b')): $__env->markAsRenderedOnce('fd3918b5-9103-467c-a85b-2dc6d24f799b');
$__env->startPush('scripts'); ?>
<script src="<?php echo e(\App\Helper\Static\Methods::staticAsset("vendor_assets/js/select2.full.min.js")); ?>"></script>
<script src="<?php echo e(\App\Helper\Static\Methods::staticAsset("vendor_assets/js/drawer.js")); ?>"></script>
<?php $section = request()->section ?? null; ?>
<?php $page = request()->page ?? null; ?>
<script>
    function openDrawer(e) {
        const drawerBasic = document.querySelector(".drawer-basic-wrap");
        const overlay = document.querySelector(".overlay-dark");
        const areaDrawer = document.querySelector(".area-drawer");
        const areaOverlay = document.querySelector(".area-overlay");
        e.preventDefault();
        if (this.dataset.drawer == "basic") {
            drawerBasic.classList.remove("account");
            drawerBasic.classList.remove("profile");
            drawerBasic.classList.add("basic");
            drawerBasic.classList.add("show");
            overlay.classList.add("show");
        } else if (this.dataset.drawer == "area") {
            areaDrawer.classList.add("show");
            areaOverlay.classList.add("show");
        } else if (this.dataset.drawer == "account") {
            drawerBasic.classList.remove("basic");
            drawerBasic.classList.remove("profile");
            drawerBasic.classList.add("account");
            drawerBasic.classList.add("show");
            overlay.classList.add("show");
        } else if (this.dataset.drawer == "profile") {
            drawerBasic.classList.remove("basic");
            drawerBasic.classList.remove("account");
            drawerBasic.classList.add("profile");
            drawerBasic.classList.add("show");
            overlay.classList.add("show");
        }
    }
    function sendAjaxRequest(url, urlParams, dataObj) {
        history.pushState({}, null, url.href);

        url = new URL(document.URL);
        urlParams = url.searchParams;

        dataObj.search_by_country = urlParams.get(`search_by_country`);
        dataObj.search_by_promotional_method = urlParams.get(`search_by_promotional_method`);
        dataObj.search_by_name = urlParams.get(`search_by_name`);
        dataObj.section = urlParams.get(`section`);
        dataObj.type = urlParams.get(`type`);
        // dataObj.source = urlParams.get(`source`);

        let exportXLSXURL = "<?php echo e(route("publisher.export-advertisers", ['type' => 'xlsx'])); ?>";
        let exportCSVURL = "<?php echo e(route("publisher.export-advertisers", ['type' => 'csv'])); ?>";

        exportXLSXURL = `${exportXLSXURL}${url.search}`;
        exportCSVURL = `${exportCSVURL}${url.search}`;

        $("#exportCSV").attr("href", exportCSVURL);
        $("#exportXLSX").attr("href", exportXLSXURL);

        $.ajax({
            url: '<?php echo e(route(request()->route()->getName())); ?>',
            type: 'GET',
            data: dataObj,
            success: function (response) {
                console.log(response.total);
                $("#totalAdvertiser").html(response.total);
                $("#ap-overview").html(response.html);
                changeLimit();
            },
            error: function (response) {

                $("#ap-tabContent").removeClass("spin-active");
                $("#gridLoader3").addClass("d-none");
            }
        }).done(function () {
            $("#ap-tabContent").removeClass("spin-active");
            $("#gridLoader3").addClass("d-none");
        });
    }
    function filterAdvertiser(field, id) {
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
    function clearFilter(key) {
        let url = new URL(document.URL);
        let urlParams = url.searchParams;
        if (key === "clearSearchByName") {
            $("#SearchByName").val("");
            if (urlParams.has(`search_by_name`)) {
                urlParams.delete(`search_by_name`);
                filterAdvertiser("search_by_name", "SearchByName");
            }
        }
        else if (key === "clearSearchByCountry") {
            $("#SearchByCountry").val("").trigger("change");
            if (urlParams.has(`search_by_country`)) {
                urlParams.delete(`search_by_country`);
                filterAdvertiser("search_by_country", "SearchByCountry");
            }
        }
        else if (key === "clearSearchByCategory") {
            $("#SearchByCategory").val("").trigger("change");
            if (urlParams.has(`search_by_category`)) {
                urlParams.delete(`search_by_category`);
                filterAdvertiser("search_by_category", "SearchByCategory");
            }
        }
        else if (key === "clearSearchByPromotionalMethod") {
            $("#SearchByPromotionalMethod").val("").trigger("change");
            if (urlParams.has(`search_by_promotional_method`)) {
                urlParams.delete(`search_by_promotional_method`);
                filterAdvertiser("search_by_promotional_method", "SearchByPromotionalMethod");
            }
        }
        history.pushState({}, null, url.href);
        $(`#${key}`).hide();
    }
    function showClear(key) {
        $(`#clear${key}`).removeClass('d-none', true);
    }
    function pushInfo(id, name) {
        $("#advertiser_id").val(id);
        $("#advertiser_name").val(name);
    }
    function view(view) {
        $.ajax({
            url: '<?php echo e(route("publisher.set-advertiser-view")); ?>',
            type: 'GET',
            data: { view },
            success: function (response) {
                if (response) {
                    window.location.reload();
                }
            },
            error: function (response) {

            }
        });
    }
    function openApplyModal(id, name, commission, type, region) {
        $("#advertiserID").html(`Brand ID: ${id}`)
        $("#advertiserName").html(name)
        $("#advertiserCommission").html(`Commission: ${commission || 'N/A'}${type}`)
        $("#advertiserRegion").html(`Region: ${region}`)
        $("#a_id").val(id)
        $("#a_name").val(name)
    }
    function advertiserType(type) {
        let url = new URL(document.URL);
        let urlParams = url.searchParams;

        // let sourcesStr = urlParams.get("source");
        // let sourceArr = sourcesStr ? sourcesStr.split(',') : [];
        // let source = sourceArr.indexOf(type)
        // if(source > -1)
        //     sourceArr.splice(source, 1);
        // else
        //     sourceArr.push(type)

        $("#ap-overview").html("");

        if (url.search) {
            // if(urlParams.has(`source`)) {
            //     urlParams.delete(`source`);
            // }
            if (urlParams.has('page')) {
                urlParams.delete('page');
                urlParams.append('page', "1");
            }
        }

        // source = sourceArr.toString();

        // let dataObj = {source};
        //
        // if(source)
        //     urlParams.append("source", source);

        sendAjaxRequest(url, urlParams, dataObj);

    }
    function changeLimit() {
        $("#limit").change(() => {
            $("#ap-overview").addClass("spin-active");
            $.ajax({
                url: '<?php echo e(route("publisher.set-limit")); ?>',
                type: 'GET',
                data: { "limit": $("#limit").val(), "type": "advertiser" },
                success: function (response) {
                    if (response) {
                        window.location.reload();
                    }
                },
                error: function (response) {

                }
            });

        });
    }
    function fetchAdvertisers(section, dataObj, clearPage) {
        let url = new URL(document.URL);
        let urlParams = url.searchParams;
        //
        if (url.search) {
            if (urlParams.has(`section`)) {
                urlParams.delete(`section`);
            }
            if (clearPage && urlParams.has('page')) {
                urlParams.delete(`page`);
                urlParams.append('page', "1");
            }
        }
        if (section)
            urlParams.append("section", section);

        sendAjaxRequest(url, urlParams, dataObj);
    }
    document.addEventListener("DOMContentLoaded", function () {

        changeLimit();
        $("#SearchByName").keyup(() => {
            console.log("Keyword");
            filterAdvertiser("search_by_name", "SearchByName");
            if (!$("#SearchByName").val()) {
                $(`#clearSearchByName`).hide();
            }
        });
        $("#SearchByCountry").change(() => {
            console.log('Country')
            filterAdvertiser("search_by_country", "SearchByCountry")
        });
        $("#SearchByCategory").change(() => {
            console.log('Category');
            filterAdvertiser("search_by_category", "SearchByCategory")
        });
        $("input[name='advertiserType']").change(() => {
            let type = $("input[name='advertiserType']:checked").val();
            let dataObj = { type };

            let url = new URL(document.URL);
            let urlParams = url.searchParams;

            if (url.search) {
                if (urlParams.has('type')) {
                    urlParams.delete('type');
                }
                if (urlParams.has('page')) {
                    urlParams.delete('page');
                    urlParams.append('page', "1");
                }
            }

            urlParams.append("type", type);
            sendAjaxRequest(url, urlParams, dataObj);
        });

        $("#SearchByPromotionalMethod").change(() => {
            filterAdvertiser("search_by_promotional_method", "SearchByPromotionalMethod")
        });
        $("#allBrands, #notJoinedBrands, #joinedBrands, #newBrands, #pendingBrands, #rejectedBrands, #holdBrands").click(function (e) {
            $("#ap-tabContent").addClass("spin-active");
            $("#gridLoader3").removeClass("d-none");
            let data = $(e.target);
            let section = data.attr('data-section');
            $("#allBrands, #newBrands, #notJoinedBrands, #joinedBrands, #newBrands, #pendingBrands, #holdBrands, #rejectedBrands").removeClass("active");
            if (section === "all") {
                $("#allBrands").addClass("active");
                section = null;
            }
            else if (section === "new") {
                $("#newBrands").addClass("active");
            }
            else if (section === "joined") {
                $("#joinedBrands").addClass("active");
            }
            else if (section === "not-joined") {
                $("#notJoinedBrands").addClass("active");
            }
            else if (section === "pending") {
                $("#pendingBrands").addClass("active");
            }
            else if (section === "hold") {
                $("#holdBrands").addClass("active");
            }
            else if (section === "rejected") {
                $("#rejectedBrands").addClass("active");
            }

            let dataObj = { section };
            fetchAdvertisers(section, dataObj, true);
        });

        $("#ap-tabContent").addClass("spin-active");
        $("#gridLoader3").removeClass("d-none");
        let section = "<?php echo e($section); ?>";
        let page = "<?php echo e($page); ?>";
        let dataObj = { section, page };
        fetchAdvertisers(section, dataObj);

        $("#applyAdvertiser").submit(function () {
            $("#applyAdvertiserBttn").prop('disabled', true);
        });
    });
</script>
<script>
function viewBrandDetails(url) {

    $('#company-view-detail').html(`
        <div class="card-body text-center py-5">
            <div class="spinner-border text-primary"></div>
            <p class="text-muted mt-2">Loading brand details...</p>
        </div>
    `);

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',

        success: function (response) {

            if (response.success) {

                let brand = response.data;
                let countries = brand.country_full_name ?? [];
                let commissionSuffix = String(brand.commission ?? '').includes('%')
                    ? ''
                    : (brand.commission_type === 'percentage' ? '%' : (brand.commission_type ?? ''));

                if (typeof countries === 'string') {
                    try {
                        countries = JSON.parse(countries);
                    } catch (e) {
                        countries = [countries];
                    }
                }

                let location = Array.isArray(countries)
                    ? (countries.length > 2 ? 'Multi' : countries.join(', '))
                    : countries;

                let status = response.data.advertiser_applies?.status;

                let statusHtml = '';

                if (status === 'joined') {
                    statusHtml = `
                        <li class="list-inline-item avatar-lg" style="height: 2rem;">
                            <a href="javascript:void(0);" class="avatar-title bg-success-subtle text-success fs-11 rounded">
                                <i class="ri-check-line me-2 fs-14"></i> Joined
                            </a>
                        </li>
                    `;
                } else if (status === 'pending') {
                    statusHtml = `
                        <li class="list-inline-item avatar-lg" style="height: 2rem;">
                            <a href="javascript:void(0);" class="avatar-title bg-warning-subtle text-warning fs-11 rounded">
                                <i class="fas fa-circle-exclamation me-2 fs-14"></i> Pending
                            </a>
                        </li>
                    `;
                } else if (status === 'hold') {
                    statusHtml = `
                        <li class="list-inline-item avatar-lg" style="height: 2rem;">
                            <a href="javascript:void(0);" class="avatar-title bg-primary-subtle text-primary fs-11 rounded">
                                <i class="fas fa-stop-circle me-2 fs-14"></i> Hold
                            </a>
                        </li>
                    `;
                } else if (status === 'rejected') {
                    statusHtml = `
                        <li class="list-inline-item avatar-lg" style="height: 2rem;">
                            <a href="javascript:void(0);" class="avatar-title bg-danger-subtle text-danger fs-11 rounded">
                                <i class="fas fa-times me-2 fs-14"></i> Rejected
                            </a>
                        </li>
                    `;
                } else {
                    statusHtml = `
                        <li class="list-inline-item avatar-lg" style="height: 2rem;">
                            <a href="javascript:void(0);" class="avatar-title bg-warning-subtle text-warning fs-11 rounded">
                                <i class="fas fa-stop-circle me-2 fs-14"></i> Not Joined
                            </a>
                        </li>
                        <li class="list-inline-item avatar-lg" style="height: 2rem;">
                            <a href="javascript:void(0);"
                            onclick="openApplyModal(
                                '${ escapeHtml(brand.sid) }',
                                '${ escapeHtml(brand.name) }',
                                '${ escapeHtml(brand.commission) }',
                                '${ escapeHtml(commissionSuffix) }',
                                '${ escapeHtml(location) }'
                            )" data-bs-toggle="modal" data-bs-target="#modal-basic" class="avatar-title bg-success-subtle text-success fs-11 rounded">
                                <i class="ri-user-add-line me-2 fs-14"></i> Apply
                            </a>
                        </li>
                    `;
                }

                let year = brand.created_at
                    ? new Date(brand.created_at).getFullYear()
                    : 'N/A';

                    
                $('#company-view-detail').html(`
                <div class="card-body text-center">
                    <h5 class="mt-3 mb-1">${escapeHtml(brand.name ?? 'N/A')}</h5>
                    <p class="text-muted">(${escapeHtml(brand.sid ?? 'N/A')})</p>

                    <ul class="list-inline mb-0">
                        ${statusHtml}
                    </ul>
                </div>
                <div class="card-body">
                    <h6 class="text-muted text-uppercase fw-semibold mb-3">Information</h6>
                    <p class="text-muted mb-4">${escapeHtml(brand.short_description ?? 'Promote this brand to your audience and earn commissions on successful referrals. Explore the program details and start building a profitable partnership with us.')}</p>
                    <div class="table-responsive table-card">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="fw-medium" scope="row">Location</td>
                                    <td>${escapeHtml(location ?? 'N/A')}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium" scope="row">Commission</td>
                                    <td>${escapeHtml(brand.commission ?? 'N/A')}${ brand.commission_type == "percentage" ? "%" : brand.commission_type }</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium" scope="row">APC</td>
                                    <td>${escapeHtml(brand.average_payment_time ?? 'N/A')} days</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium" scope="row">Website</td>
                                    <td>
                                        <a href="${escapeHtml(brand.click_through_url ?? 'N/A')}" target="_blank" class="link-primary text-decoration-underline">${escapeHtml(brand.url ?? 'N/A')}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-medium" scope="row">Currency</td>
                                    <td>${escapeHtml(brand.currency_code ?? 'N/A')}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium" scope="row">Since</td>
                                    <td>${escapeHtml(year ?? 'N/A')}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                    
                `);
            }
        },

        error: function () {
            $('#company-view-detail').html(`
                <div class="card-body text-center py-5">
                    <i class="ri-error-warning-line fs-1 text-danger"></i>
                    <p class="text-muted mt-2">Unable to load brand details.</p>
                </div>
            `);
        }
    });
}

function escapeHtml(value) {
    return $('<div>').text(value).html();
}
</script>
<?php $__env->stopPush(); endif; ?>

<?php $__env->startSection("content"); ?>

    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Brands</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Menu</a></li>
                            <li class="breadcrumb-item active">Brands</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center flex-wrap gap-2">
                            <div class="flex-grow-1">
                                <ul class="nav tab-pills" id="brandTabs" role="tablist">

                                    <?php if(request()->route()->getName() != "publisher.own-advertisers"): ?>
                                        <li class="nav-item">
                                            <button
                                                class="nav-link <?php echo e(!request()->section || request()->section == 'all' ? 'active' : ''); ?>"
                                                id="allBrands" data-section="all" type="button" role="tab">
                                                All
                                            </button>
                                        </li>

                                        <li class="nav-item">
                                            <button class="nav-link <?php echo e(request()->section == 'new' ? 'active' : ''); ?>"
                                                id="newBrands" data-section="new" type="button" role="tab">
                                                Latest
                                            </button>
                                        </li>

                                        <li class="nav-item">
                                            <button class="nav-link <?php echo e(request()->section == 'not-joined' ? 'active' : ''); ?>"
                                                id="notJoinedBrands" data-section="not-joined" type="button" role="tab">
                                                Not Joined
                                            </button>
                                        </li>

                                        <li class="nav-item">
                                            <button class="nav-link <?php echo e(request()->section == 'pending' ? 'active' : ''); ?>"
                                                id="pendingBrands" data-section="pending" type="button" role="tab">
                                                Pending
                                            </button>
                                        </li>
                                    <?php endif; ?>

                                    <?php if(request()->route()->getName() == "publisher.own-advertisers"): ?>
                                        <li class="nav-item">
                                            <button
                                                class="nav-link <?php echo e(request()->section == 'joined' || empty(request()->section) ? 'active' : ''); ?>"
                                                id="joinedBrands" data-section="joined" type="button" role="tab">
                                                Joined
                                            </button>
                                        </li>

                                        <li class="nav-item">
                                            <button class="nav-link <?php echo e(request()->section == 'hold' ? 'active' : ''); ?>"
                                                id="holdBrands" data-section="hold" type="button" role="tab">
                                                Hold
                                            </button>
                                        </li>

                                        <li class="nav-item">
                                            <button class="nav-link <?php echo e(request()->section == 'rejected' ? 'active' : ''); ?>"
                                                id="rejectedBrands" data-section="rejected" type="button" role="tab">
                                                Rejected
                                            </button>
                                        </li>
                                    <?php endif; ?>

                                </ul>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="hstack text-nowrap gap-2">
                                    <button class="btn btn-soft-danger material-shadow-none" id="remove-actions"
                                        onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                    <button class="btn btn-danger material-shadow-none"><i
                                            class="ri-filter-2-line me-1 align-bottom"></i> Filters</button>
                                    <button class="btn btn-soft-success material-shadow-none" id="dropdownExport" data-bs-toggle="dropdown"
                                    aria-expanded="false">Export</button>
                                    <ul class="dropdown-menu export-menu" aria-labelledby="dropdownExport">
                                        <?php
                                            $queryParams = request()->all();
                                        ?>
                                        <li>
                                            <a class="dropdown-item"
                                                href="<?php echo e(route('publisher.export-advertisers', array_merge(['type' => 'csv'], $queryParams))); ?>">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                                    <path d="M14 2v6h6" />
                                                </svg>
                                                <span><strong>Export as CSV</strong><span class="hint">Plain text, opens
                                                        anywhere</span></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                                href="<?php echo e(route('publisher.export-advertisers', array_merge(['type' => 'xlsx'], $queryParams))); ?>">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                                    <path d="M14 2v6h6" />
                                                    <path d="M8 14h8M8 18h5" />
                                                </svg>
                                                <span><strong>Export as Excel</strong><span class="hint">.xlsx with
                                                        formatting</span></span>
                                            </a>
                                        </li>
                                    </ul>
                                    <button type="button" id="dropdownMenuLink1" data-bs-toggle="dropdown"
                                        aria-expanded="false" class="btn btn-soft-info material-shadow-none"><i
                                            class="ri-more-2-fill"></i></button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                        <li><a class="dropdown-item" href="#">All</a></li>
                                        <li><a class="dropdown-item" href="#">Last Week</a></li>
                                        <li><a class="dropdown-item" href="#">Last Month</a></li>
                                        <li><a class="dropdown-item" href="#">Last Year</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
            <div class="col-xxl-9">
                <div class="card" id="companyList">
                    <div class="card-header">
                        <div class="row g-2">
                            <div class="col-md-3">
                                <div class="search-box">
                                    <input type="text" class="form-control search" placeholder="Search for company..." value="<?php echo e(request()->search_by_name); ?>" id="SearchByName">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                            <div class="col-md-auto ms-auto">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="text-muted">Sort by: </span>
                                    <select class="form-control mb-0" data-choices data-choices-search-false
                                        id="choices-single-default">
                                        <option value="Owner">Owner</option>
                                        <option value="Company">Company</option>
                                        <option value="location">Location</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="ap-tabContent">
                        <div id="ap-overview" role="tabpanel" aria-labelledby="ap-overview-tab">

                        </div>
                    </div>
                </div>
                <!--end card-->
            </div>
            <!--end col-->
            <div class="col-xxl-3">
                <div class="card" id="company-view-detail" style="position: sticky; top: 100px;">
                    <div class="card-body text-center">
                        <h5 class="mt-3 mb-1">Brand Details</h5>
                    </div>

                    <div class="card-body">
                        <div class="text-center py-3">
                            <i class="ri-information-line fs-1 text-muted"></i>
                            <h6 class="text-muted mt-2 mb-1">View Brand Information</h6>
                            <p class="text-muted mb-0">
                                To see complete brand information, click on the
                                <i class="ri-eye-fill align-middle"></i>
                                (eye) icon.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    
    
    <div class="modal fade" id="modal-basic" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <form action="<?php echo e(route('publisher.apply-advertiser')); ?>" method="POST" id="applyAdvertiser">
                <?php echo csrf_field(); ?>

                <input type="hidden" id="a_id" name="a_id">
                <input type="hidden" id="a_name" name="a_name">

                <div class="modal-content border-0 shadow-lg">

                    <!-- Header -->
                    <div class="modal-header border-0 pb-0 px-4 pt-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="apply-icon bg-success-subtle text-success">
                                <i class="ri-shake-hands-line"></i>
                            </div>
                            <div>
                                <h5 class="modal-title fw-bold mb-1">
                                    Apply to Program
                                </h5>
                                <p class="text-muted mb-0 fs-12">
                                    Submit your partnership application
                                </p>
                            </div>
                        </div>

                        <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                        </button>
                    </div>

                    <!-- Body -->
                    <div class="modal-body px-4 py-4">

                        <!-- Advertiser Info -->
                        <div class="apply-brand-card mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="text-muted fs-11 fw-semibold text-uppercase">
                                    You are applying to
                                </span>

                                <span class="badge bg-success-subtle text-success">
                                    <i class="ri-checkbox-circle-fill me-1"></i>
                                    New Application
                                </span>
                            </div>

                            <h5 class="fw-bold mb-1" id="advertiserName">
                                
                            </h5>

                            <p class="text-muted fs-12 mb-3" id="advertiserID"></p>

                            <div class="apply-modal-tags d-flex flex-wrap gap-2">
                                <span class="badge-soft amber" id="advertiserCommission">
                                    
                                </span>

                                <span class="badge-soft slate" id="advertiserRegion">
                                    
                                </span>
                            </div>
                        </div>

                        <!-- Marketing Message -->
                        <div class="mb-2">
                            <label class="form-label fw-semibold mb-1">
                                Marketing Strategy
                                <span class="text-muted fw-normal">(Optional)</span>
                            </label>

                            <p class="text-muted fs-12 mb-3">
                                Tell the advertiser how you plan to promote their brand.
                                This can help speed up your approval.
                            </p>

                            <textarea
                                class="form-control apply-message"
                                rows="5"
                                name="message"
                                placeholder="Describe your promotional methods, websites, traffic sources, PPC keywords, social media channels, etc.">
                            </textarea>

                            <div class="d-flex align-items-center gap-2 mt-2">
                                <i class="ri-information-line text-muted"></i>
                                <span class="text-muted fs-11">
                                    Providing details may improve your application.
                                </span>
                            </div>
                        </div>

                    </div>

                    <!-- Footer -->
                    <div class="modal-footer border-0 px-4 pb-4 pt-0">
                        <button type="button"
                            class="btn btn-light px-4"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit"
                            id="applyAdvertiserBttn"
                            class="btn bg-primary text-white px-4">
                            <i class="ri-send-plane-fill me-1"></i>
                            Submit Application
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.publisher.publisher_panel", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pub.affishare.com\resources\views/template/publisher/advertisers/find.blade.php ENDPATH**/ ?>