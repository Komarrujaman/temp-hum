@extends('layouts.master', ['title' => 'Dashboard'])
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- Content Row -->
    <div class="row">

        <!-- Show all device-->
        @foreach ($data->data as $item)
        <?php
        $currentTime = new DateTime();
        $lastUpdateTime = DateTime::createFromFormat('H:i:s - d/m/Y', $item->lastUpdate);
        $lastUpdateTime->setTimeZone(new DateTimeZone('Asia/Jakarta'));
        $diff = $currentTime->diff($lastUpdateTime);
        ?>
        <div class="col-xl-3 col-md-6 mb-2">
            <div class="card shadow py-1" id="listDevice">
                <div class="card-body">
                    <a href="{{url ('/info/'.$item->deviceName)}}" class="stretched-link"></a>
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="h5 font-weight-bold text-gray-800 text-uppercase mb-3">{{$item->sensorName}}</div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="h6 col-6 mb-0 font-weight-bold text-gray-800 mb-2"><i class="fas fa-solid fa-temperature-three-quarters fa-2x text-primary"></i> {{$item->temperature}} °C</div>
                                <div class="h6 mb-0 col-6 font-weight-bold text-gray-800 mb-2"><i class="fas fa-solid fa-droplet fa-2x  text-primary"></i> {{$item->humidity}}%</div>
                            </div>
                            <div class="row">
                                <div class="h6 col-7 mb-0 font-weight-bold text-gray-800 mb-2"><i class="fas fa-solid fa-gauge-high fa-1x  text-primary"></i> {{$item->pressure}}hPa</div>
                                <div class="h6 col-5 mb-0 font-weight-bold text-gray-800 mb-2"><i class="fas fa-solid fa-signal text-primary fa-1x"></i> {{$item->rssi}}</div>
                            </div>
                            <div class="mb-0 font-weight-bold text-gray-800 mt-3" style="font-size: 10px;">{{$item->lastUpdate}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @endsection