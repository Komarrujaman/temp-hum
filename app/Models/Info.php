<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use App\Models\Home;
use GuzzleHttp\Psr7\Request;

class Info extends Model
{
    public static function getInfo($deviceName)
    {
        $client = new Client();
        //get Info device pada API 
        $response = $client->get(env('APP_HOST_API') . '/device/info', [
            'headers' => [
                'token' => session('token'),
                'deviceName' => $deviceName
            ]
        ]);
        return json_decode($response->getBody());
    }

    public static function getAllInfo()
    {
        $getdat = new Home();
        $get = $getdat->getData();
        $infos = [];
        foreach ($get->data as $data) {
            $info = Info::getInfo($data->deviceName);
            array_push($infos, $info);
        }
        return $infos;
    }

    public static function getCalibration($deviceName)
    {
        $client = new Client();
        $response = $client->get(env('APP_HOST_API') . '/device/info/calibration/', [
            'headers' => [
                'token' => session('token'),
                'deviceName' => $deviceName
            ]
        ]);

        return json_decode($response->getBody());
    }

    public static function getChart($deviceName, $filter)
    {
        $client = new Client();

        $response = $client->get(
            env('APP_HOST_API') . '/device/data/chart/',
            [
                'headers' => [
                    'token' => session('token'),
                    'filter' => $filter,
                    'deviceName' => $deviceName,
                ]
            ]
        );

        return json_decode($response->getBody());
    }
}
