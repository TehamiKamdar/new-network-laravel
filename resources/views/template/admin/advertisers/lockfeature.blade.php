@extends("layouts.admin.panel_table")

@pushonce('styles')
@endpushonce



@section("content")

    <div class="contents">

        <div class="container-fluid">
            <div class="social-dash-wrap">
                 <div class="row">
                    <div class="col-lg-12">

                        <div class="breadcrumb-main mt-4">
                            <h4 class="text-capitalize breadcrumb-title mt-3">Lock Networks</h4>
                        </div>

                    </div>
                </div>
                <div class="row">
                    
                    <div class="col-lg-12">
                        <div class="breadcrumb-main">
                            <div class="container">
                                 <form method="post" action="{{ route("admin.advertiser-management.updatelock") }}">
                                    @csrf
                                <div class="row">
                                  
                                    
                                    <div class="col-lg-3">
                                        <select class="js-example-basic-single js-states form-control" id="source" name="source">
                                            <option value="" disabled selected>Select Source</option>
                                            @foreach($networks as $network)
                                                <option value="{{ $network }}">{{ ucwords($network) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-3">
                                        <select class="js-example-basic-single js-states form-control" id="publisher" name="publisher">
                                            <option value="" disabled selected>Select Publisher</option>
                                            
                                              @foreach($publishers as $publisher)
                                             
                                                        <option value="{{ $publisher->id }}///{{ $publisher->website_id }}">{{ $publisher->name }}</option>
                                                    @endforeach
                                        </select>
                                    </div>


                                    <div class="col-lg-3">
                                        <select class="js-example-basic-single js-states form-control" id="status" name="status">
                                            <option value="" disabled selected>Select Status</option>
                                             <option value="0">Lock</option>
                                             <option value="1">Unlock</option>
                                        </select>
                                    </div>


                                    <div class="col-lg-3">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                   
                                </div>
                                 </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">

                                @include("partial.admin.alert")

                                <table class="table table-bordered table-striped table-hover datatable">
                                    <thead>
                                    <tr class="userDatatable-header footable-header">
                                        <th></th>
                                        <th>
                                            Publisher
                                        </th>
                                        <th>
                                            Source
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                       
                                    </tr>
                                    </thead>
                                    <thead>
                                        @foreach ($locks as $lock)
                                        @php
                                        if($lock->website_id != null){
                                            $website = \App\Models\Website::find($lock->website_id);
                                        }else{
                                            $website = \App\Models\Website::find($lock->active_website_id);
                                        }
                                        
                                        @endphp
                                        <tr>
                                            <td></td>
                                            <td>{{ $website->name }}</td>
                                            <td>{{ $lock->source }}</td>
                                            
                                            <td>
                                                @if($lock->status == '0')
                                                Locked
                                                @else
                                                UnLocked
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
