<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;

class Home extends Model
{
    public function getData()
    {
        $client = new Client();
        $response = $client->get(env('APP_HOST_API') . '/device/data/all', [
            'headers' => [
                'token' => session('token'),
            ]
        ]);
        return json_decode($response->getBody());
    }
}
