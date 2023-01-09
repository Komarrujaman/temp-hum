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
        $response = $client->post(env('APP_HOST_API') . '/auth/login/', [
            'form_params' => [
                'username' => $username,
                'password' => $password,
            ]
        ]);

        return json_decode($response->getBody());
    }
}
