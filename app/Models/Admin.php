<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;

class Admin extends Model
{
    public static function getAllUser()
    {
        $client = new Client();
        $response = $client->get(env('APP_HOST_API') . '/user/list', [
            'headers' => [
                'token' => session('token'),
            ]
        ]);
        return json_decode($response->getBody());
    }


    public static function createUser($username, $roles, $password, $email, $phone, $name)
    {
        $client = new Client();
        $response = $client->post(env('APP_HOST_API') . '/user/create/', [
            'headers' => [
                'token' => session('token')
            ],
            'form_params' => [
                'roles' => $roles,
                'name' => $name,
                'username' => $username,
                'email' => $email,
                'phone' => $phone,
                'password' => $password
            ]
        ]);
        return json_decode($response->getBody());
    }
}
