<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use App\Models\Home;
use Illuminate\Support\Facades\Storage;

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

    public static function getCsv($deviceName, $date)
    {
        if (Storage::exists('file.csv')) {
            return Storage::url('file.csv');
        }

        $client = new Client();

        $response = $client->post(
            env('APP_HOST_API') . '/device/data/export/csv/',
            [
                'headers' => [
                    'token' => session('token'),
                    'deviceName' => $deviceName,
                    'date' => $date
                ]
            ]
        );

        if ($response->getStatusCode() !== 200) {
            // Handle error scenario here
            return null;
        }

        $csv = $response->getBody()->getContents();
        Storage::put('file.csv', $csv);
        return Storage::url('file.csv');
    }
}
