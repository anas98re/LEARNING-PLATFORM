<?php

namespace Modules\Admin\Http\Controllers;


use Modules\Admin\Entities\Subscription;
use Modules\Admin\Http\Requests\CreateSubscriptionRequest;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\Admin\Entities\SubjectSubscription;
use Modules\Admin\Http\Requests\AddSubjectSubscriptionRequest;
use Modules\Admin\Http\Requests\EditSubscriptionRequest;
use Modules\Admin\Http\Requests\GetAllSubsciptionsRequest;
use Modules\Admin\Transformers\SubscriptionResource;

class SubscriptionController extends ApiController
{
    public function get_all_subscriptions(GetAllSubsciptionsRequest $request)
    {
        $subscriptions = Subscription::paginate($request->limit);
        if ($subscriptions->first()) {
            return $this->success(SubscriptionResource::collection($subscriptions));
        } else {
            return $this->error(["There'\s no subscriptions"], "There'\s no subscriptions", 204);
        }
    }

    public function create_subscription(CreateSubscriptionRequest $request)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/admin/subscription_images');
        }
        $data = $request->all();
        $data['image'] = $path;
        $subsciption = Subscription::create($data);
        return $this->success($subsciption, 200);
    }

    public function edit_subscription(EditSubscriptionRequest $request)
    {
        $subsciption = Subscription::find($request->subscription_id);
        if ($request->hasFile('image')) {
            if (Storage::exists($subsciption->image)) {
                Storage::delete($subsciption->image);
            }
            $path = $request->file('image')->store('public/admin/subscription_images');
        }
        $data = $request->all();
        $data['image'] = $path;
        $subsciption->update($data);
        return $this->success($subsciption, 200);
    }

    public function add_subject_to_subscription(AddSubjectSubscriptionRequest $request)
    {
        $subscription_subject = SubjectSubscription::create($request->all());
        return $this->success($subscription_subject, 200);
    }

    public function delete_subject_from_subscription(Request $request)
    {
        if(!$request->has('subscription_subject_id')){
            return $this->error(["subscription_subject_id is required"], "subscription_subject_id is required", 204);       
        }
        $subscription_subject = SubjectSubscription::find($request->subscription_subject_id);
        if ($subscription_subject) {
            $subscription_subject->delete();
            $response = [
                'message' => 'Record was deleted successfully',
            ];
            return $this->success($response, 200);
        } else {
            return $this->error(["There's no such subject subscription"], "There's no such subject subscription", 204);
        }
    }

}
