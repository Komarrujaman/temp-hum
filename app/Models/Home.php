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
        $response = $client->get('http://iote.my.id/waterlevel/api/v1/device/data/all', [
            'headers' => [
                'token' => session('token'),
            ]
        ]);
        return json_decode($response->getBody());
    }
}
