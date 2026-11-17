<!-- Profile Acoount -->
@php
    $website = App\Models\Website::find($user->active_website_id);
    $company = $user->companies->first();

    $country = App\Models\Country::find($publisher->location_country);
    $city = App\Models\City::find($publisher->location_city);

@endphp

<div class="profile-summary" style="border-bottom:1px solid var(--line);">
    <div class="avatar">
        <img class="" id="profileImg" 
        src="{{ \App\Helper\Static\Methods::staticAsset(isset($publisher->image) && $publisher->image ? $publisher->image : "img/blank_profile_img.png") }}" alt="profile">
    </div>
    <h3>{{ $user->first_name }} {{ $user->last_name }}</h3>
    <div class="my-3">
        
        <p>ID: {{ $user->sid }} · {{ $company->company_name }}</p>
        <p>{{ $user->email }} · <span><a href="{{ $website->url }}">{{ $website->name }}</a> ({{ $website->wid }})</span></p>
    </div>
    <form action="javascript:void(0)" id="profile-image-form" enctype="multipart/form-data">
        @csrf
        <input type="file" id="file-upload" name="fileUpload" accept="image/*" hidden>

        <label for="file-upload" class="btn btn-outline btn-sm w-100" id="remove_pro_pic">
            Change photo
        </label>
    </form>
</div>
<!-- Profile Acoount End -->