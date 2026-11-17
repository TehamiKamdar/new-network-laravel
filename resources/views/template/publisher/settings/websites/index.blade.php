<div class="table-responsive">
    <table class="table mb-0">
        <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Category</th>
                <th>Last Updated</th>
                <th>Action</th>
            </tr>
        </thead>
        @foreach($websites as $website)
            <tbody id="websiteContent">
                <tr id="website-row-{{ $website->id }}">
                    <td>
                        <div class="site-cell">
                            <a class="site-name" href="{{ url($website->url) }}" target="_blank">{{ $website->name }}</a>
                        </div>
                    </td>
                    <td>
                        {{ implode(', ', \App\Helper\PublisherData::getMixNames($website->partner_types)) }}
                    </td>
                    <td>
                        {{ implode(', ', \App\Helper\PublisherData::getMixNames($website->categories)) }}
                    </td>
                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($website->updated_at)->format("M d Y") }}
                    </td>

                    <td class="text-center">
                        @if($website->status == \App\Models\Website::PENDING)
                            <a href="javascript:void(0)" class="link-more" style="color:var(--amber-deep);" data-toggle="modal" data-target="#verify-modal" onclick="openVerifyModal('{{ $website->id }}', '{{ $website->url }}')">Verify</a>
                        @endif
                        <a href="javascript:void(0)" class="link-more" data-toggle="modal" data-target="#website-modal"
                            onclick="openWebsiteModal(1, '{{ $website->id }}')">Edit</a>
                    </td>
                </tr>
            </tbody>
        @endforeach
    </table>
</div>


<!-- ============ WEBSITE MODAL (Add / Edit) ============ -->
<div class="website-modal modal fade" id="website-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <form action="javascript:void(0)" id="websiteForm">
      <input type="hidden" id="website_id" name="website_id">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="modelTitle">Add Website</h6>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="website_name" class="form-label">Name<span class="text-danger">*</span></label>
                <input type="text" class="form-control w-100" id="website_name" name="website_name" placeholder="e.g. My Travel Blog">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="website_url" class="form-label">URL<span class="text-danger">*</span></label>
                <input type="text" class="form-control w-100" id="website_url" name="website_url" placeholder="https://example.com">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="partner_types" class="form-label">Partner Type (Max. 3)<span class="text-danger">*</span></label>
                <div class="atbd-select">
                  <select name="partner_types[]" id="partner_types" class="form-control w-100" multiple="multiple">
                    @foreach($methods as $method)
                        <option value="{{ $method['id'] }}">{{ $method['name'] }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="categories" class="form-label">Category (Max. 4)<span class="text-danger">*</span></label>
                <div class="atbd-select">
                  <select name="categories[]" id="categories" class="form-control w-100" multiple="multiple">
                    @foreach($categories as $category)
                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="monthly_traffic" class="form-label">Monthly Traffic<span class="text-danger">*</span></label>
                <input type="text" class="form-control w-100" id="monthly_traffic" name="monthly_traffic" placeholder="e.g. 42,000">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="monthly_page_views" class="form-label">Monthly Page Views<span class="text-danger">*</span></label>
                <input type="text" class="form-control w-100" id="monthly_page_views" name="monthly_page_views" placeholder="e.g. 96,000">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-amber btn-sm">Save changes</button>
          <button type="button" class="btn btn-outline btn-sm" data-dismiss="modal" id="closeModal">Cancel</button>
        </div>
      </div>
    </form>

    <div class="loader-overlay display-hidden" id="showLoader">
      <div class="atbd-spin-dots spin-lg">
        <span class="spin-dot badge-dot dot-primary"></span>
        <span class="spin-dot badge-dot dot-primary"></span>
        <span class="spin-dot badge-dot dot-primary"></span>
        <span class="spin-dot badge-dot dot-primary"></span>
      </div>
    </div>
  </div>
</div>

<!-- ============ VERIFY OWNERSHIP MODAL ============ -->
<div class="verify-modal modal fade" id="verify-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content modal-bg-white">
      <div class="modal-header">
        <h6 class="modal-title">Verify Ownership</h6>
        <button type="button" class="btn-close" data-dismiss="modal" id="closeVerifyModal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="verifyForm">
        <div class="row">
          <div class="col-lg-12">
            <label class="form-label">HTML Tag</label>
            <textarea class="form-control w-100" rows="3" id="htmlTag" readonly>&lt;meta name="parcel-site-verification" content="pcl-8f2c1e9a4b7d" /&gt;</textarea>
            <a href="javascript:void(0)" id="copyHTMLTag" class="btn btn-outline btn-sm mt-2 float-end">Copy</a>
          </div>
        </div>

        <div class="row" style="clear:both;">
          <div class="col-lg-12">
            <div class="version-list mb-2 mt-3">
              <div class="version-list__single">
                <ul class="version-info" style="padding-left:18px; font-size:12.5px; color:var(--slate); line-height:2;">
                  <li>Step 1: Add the meta tag to the &lt;head&gt; section</li>
                  <li>Step 2: Click Verify</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        <a href="javascript:void(0)" id="websiteVerify" class="btn btn-primary btn-sm">Verify</a>
      </div>
    </div>
  </div>
</div>