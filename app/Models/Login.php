<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use GuzzleHttp\Client;

class Login
{
    public static function authenticate($username, $password)
    {
        $client = new Client();
        $response = $client->post('http://iote.my.id/waterlevel/api/v1/auth/login/', [
            'form_params' => [
                'username' => $username,
                'password' => $password,
            ]
        ]);

        return json_decode($response->getBody());
    }
}
