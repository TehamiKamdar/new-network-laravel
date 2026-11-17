<?php

namespace App\Http\Controllers\Admin\AdvertiserManagement;

use App\Enums\WebsiteStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\LockAdvertiser;
use App\Models\User;
use App\Helper\Static\vars;
use App\Models\Website;
use App\Models\AdvertiserApply;
use App\Service\Admin\AdvertiserManagement\Advertiser\IndexService;
use App\Service\Admin\AdvertiserManagement\Advertiser\MiscService;
use App\Service\Admin\AdvertiserManagement\Advertiser\ShowService;
use App\Service\Admin\AdvertiserManagement\Advertiser\DeleteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class AdvertiserController extends Controller
{
    public function index(Request $request, IndexService $service)
    {
        abort_if(Gate::denies('admin_advertisers_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $service->init($request);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
    }

    public function show($id, ShowService $service)
    {
//        abort_if(Gate::denies('crm_advertiser_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $service->init($id);
    }

    public function destroy($advertiser, DeleteService $service)
    {
//        abort_if(Gate::denies('crm_advertiser_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $service->delete($advertiser);
    }

    public function massDestroy(Request $request, DeleteService $service)
    {
        return $service->deleteMultiple($request);
    }

    public function tabs(Request $request, MiscService $service)
    {
        return $service->tabs($request);
    }

    public function statusUpdate(WebsiteStatus $status, Website $website, MiscService $service)
    {
        return $service->statusUpdate($status, $website);
    }
    
      public function lockfeature(){
       $networks = Vars::OPTION_LIST;
    $publishers = User::where('users.type', User::PUBLISHER)
    ->where('users.status', User::ACTIVE)
    ->join('website_user', 'website_user.user_id', '=', 'users.id')
    ->join('websites', 'websites.id', '=', 'website_user.website_id')
    ->select(
        'users.*',
        'websites.id as website_id',
        'websites.name'
    )
    ->orderBy('websites.name', 'asc')
    ->get();
   
 $locks = LockAdvertiser::join('users', 'users.id', '=', 'lock_advertiser.publisher_id')->select('lock_advertiser.*', 'users.active_website_id')->get();

  
        return view('template.admin.advertisers.lockfeature', compact('networks', 'publishers','locks'));
    }

    public function updatelock(Request $request){
       $data = explode('///', $request->publisher);

$publisherId = $data[0] ?? null;
$websiteId = $data[1] ?? null;
if($request->status == 0){
    $advertiserapplies = AdvertiserApply::where('publisher_id',$publisherId)->where('website_id',$websiteId)->where('source',$request->source)->where('status','joined')->get();
    foreach($advertiserapplies as $advertiserapply){
        $advertiserapply->status = 'rejected';
        $advertiserapply->save();
    }
}

        $lock = LockAdvertiser::updateOrCreate([
                    "publisher_id" => $publisherId,
                    "source" => $request->source,
                ], [
                    "status" => $request->status,
                    "website_id" => $websiteId
                ]);

                return redirect()->back()->with('success','Status Updated');
    }
}
