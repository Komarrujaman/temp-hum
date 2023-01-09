<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use RealRashid\SweetAlert\Facades\Alert;

class InfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('authToken');
    }
    public function info(Request $request, $deviceName)
    {
        if (session()->has('token')) {
            // The user is authenticated, so you can display the home page
            $username = session('username');
            $token = session('token');
            $info = Info::getInfo($deviceName);
            $calibration = Info::getCalibration($deviceName);
            if ($request->input('filter') === null) {
                $filter = '1';
            } else {
                $filter = $request->input('filter');
            }

            $api = Info::getChart($deviceName, $filter);
            $data = $api->data;
            return view('pages.info', ['info' => $info, 'cal' => $calibration, 'deviceName' => $deviceName, 'data' => $data, 'api' => $api]);
        } else {
            // The user is not authenticated, so redirect to the login page
            return redirect()->route('login');
        }
    }

    public function edit(Request $request, $deviceName)
    {
        $client = new Client();
        $response = $client->post(env('APP_HOST_API') . '/waterlevel/api/v1/device/info/edit/', [
            'headers' => [
                'token' => session('token'),
                'deviceName' => $deviceName
            ],
            'form_params' => [
                'addressSensor' => $request->input('addressSensor'),
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
                'instalationDate' => $request->input('instalationDate'),
                'sensorName' => $request->input('sensorName')
            ]
        ]);
        Alert::success('Berhasil', 'Info Sensor Berhasil Di Ubah')->autoClose(1000);
        return redirect()->route('info', ['deviceName' => $deviceName]);
    }

    public function kalibrasi(Request $request, $deviceName)
    {
        $client = new Client();
        $response = $client->post(env('APP_HOST_API') . '/waterlevel/api/v1/device/info/calibration/edit/', [
            'headers' => [
                'token' => session('token'),
                'deviceName' => $deviceName
            ],
            'form_params' => [
                'offsetLevel' => $request->input('offsetLevel'),
                'baseLevel' => $request->input('baseLevel'),
                'levelSafe' => $request->input('levelSafe'),
                'levelStanby' => $request->input('levelStanby'),
                'levelDanger' => $request->input('levelDanger')
            ]
        ]);

        Alert::success('Berhasil', 'Sensor Berhasil Di Kalibrasi')->autoClose(1000);
        return redirect()->route('info', ['deviceName' => $deviceName]);
    }

    public function chart(Request $request, $deviceName)
    {
        $filter = $request->input('filter');

        $api = Info::getChart($deviceName, $filter);
        return redirect()->route('info', ['deviceName' => $deviceName]);
    }
}
