<div class="row g-3">
    @include("template.publisher.settings.login_info.username", compact('user'))
    @include("template.publisher.settings.login_info.change_email", compact('user'))
    @include("template.publisher.settings.login_info.change_password", compact('user'))
</div>


<div class="loader-overlay display-hidden" id="showLoader">
    <div class="atbd-spin-dots spin-lg">
        <span class="spin-dot badge-dot dot-primary"></span>
        <span class="spin-dot badge-dot dot-primary"></span>
        <span class="spin-dot badge-dot dot-primary"></span>
        <span class="spin-dot badge-dot dot-primary"></span>
    </div>
</div>


