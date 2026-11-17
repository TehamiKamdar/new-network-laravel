@if($errors->any())

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <div class="alert-content">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close text-capitalize" data-bs-dismiss="alert" aria-label="Close">
                
            </button>
        </div>
    </div>

@elseif(Session::has('success'))

    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <div class="alert-content">
            <p style="margin-top:0rem; margin-bottom: 0rem;">{{ Session::get('success') }}</p>
            <button type="button" class="btn-close text-capitalize" data-bs-dismiss="alert" aria-label="Close">
                
            </button>
        </div>
    </div>

    @php
        Session::forget('success');
    @endphp

@elseif(Session::has('status'))

    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <div class="alert-content">
            <p style="margin-top:0rem; margin-bottom: 0rem;">{{ Session::get('status') }}</p>
            <button type="button" class="btn-close text-capitalize" data-bs-dismiss="alert" aria-label="Close">
                
            </button>
        </div>
    </div>

    @php
        Session::forget('success');
    @endphp

@elseif(Session::has('high_priority_error'))

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <div class="alert-content">
            <p style="margin-top:0rem; margin-bottom: 0rem;">{{ Session::get('high_priority_error') }}</p>
            <button type="button" class="btn-close text-capitalize" data-bs-dismiss="alert" aria-label="Close">
                
            </button>
        </div>
    </div>

    @php
        Session::forget('high_priority_error');
    @endphp

@elseif(Session::has('error'))

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <div class="alert-content">
            <p style="margin-top:0rem; margin-bottom: 0rem;">{!! Session::get('error') !!}</p>
            <button type="button" class="btn-close text-capitalize" data-bs-dismiss="alert" aria-label="Close">
                
            </button>
        </div>
    </div>

    @php
        Session::forget('error');
    @endphp

@endif
