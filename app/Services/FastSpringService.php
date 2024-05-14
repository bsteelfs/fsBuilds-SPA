<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class FastSpringService
{
    public $client;
    public $baseUrl;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.fastspring.com/')
            ->withHeaders([
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ])
            ->withBasicAuth(config('fsportal.fastspring.username'), config('fsportal.fastspring.password'));
    }

    public function getAccount($account_id)
    {
        $response = $this->client->get("accounts/$account_id", []);

        return $response->json();
    }

    public function getManagementUrl($account_id)
    {
        $response = $this->client->get("accounts/$account_id/authenticate");

        return Arr::get($response->json()['accounts'][0], 'url');
    }

    public function getSubscription($subscription_id)
    {
        $response = $this->client->get("subscriptions/$subscription_id");

        return $response->json();
    }

    public function updateAccount(string $account_id, array $data)
    {
        $response = $this->client->post("accounts/$account_id", $data);

        return Arr::get($response->json(), 'result');
    }

    public function pauseSubscription(string $subscription_id)
    {
        $response = $this->client->post("subscriptions/$subscription_id/pause", [
            'pausePeriodCount' => 1
        ]);

        return Arr::get($response->json(), 'result');
    }

    public function resumeSubscription(string $subscription_id)
    {
        $response = $this->client->post("subscriptions/$subscription_id/resume", []);

        return Arr::get($response->json(), 'result');
    }
}
