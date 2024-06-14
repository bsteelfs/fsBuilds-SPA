<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\FastSpringService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    public function me()
    {
        $user = User::find(1);

        if (!$user) return response()->json(['message' => 'User not found'], 404);
        $fs_service = new FastSpringService();

        $fastspring_account = null;
        $management_url = null;
        $main_subscription = null;
        $secondary_subscription = null;
        $last_subscription_id = null;


        if ($user->fs_account_id) {
            $fastspring_account = $fs_service->getAccount($user->fs_account_id);
            $management_url = $fs_service->getManagementUrl($user->fs_account_id);

            foreach (Arr::get($fastspring_account, 'subscriptions') as $sub_id) {
                $sub = $fs_service->getSubscription($sub_id);
                if (!Arr::get($sub, 'active')) continue;

                if (Arr::get($sub, 'price') > 50) $main_subscription = $sub;
                else $secondary_subscription = $sub;
                $last_subscription_id = $sub_id;
            }
        }


        return response()->json([
            'user' => $user,
            'fastspring_account' => $fastspring_account,
            'management_url' => $management_url,
            'subscriptions' => [
                'main' => $main_subscription,
                'secondary' => $secondary_subscription,
                'last_subscription_id' => $last_subscription_id
            ]
        ]);
    }
}
