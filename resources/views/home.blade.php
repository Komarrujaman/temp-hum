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
        <div class="col-lg-8 col-xl-4 col-md-7 mb-2">
            <div class="card shadow py-1">
                <div class="card-body">
                    <a href="{{url ('/info/'.$item->deviceName)}}" class="stretched-link"></a>
                    <div class="row no-gutters align-items-center" id="data-device">
                        <div class="mr-2 col-lg-12">
                            <div class="row">
                                <div class="col ml-1">
                                    <div class="h5 font-weight-bold text-gray-800 text-uppercase mb-3">{{$item->sensorName}}</div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="h6 col-6 mb-0 font-weight-bold text-gray-800 mb-2"><i class="fas fa-solid fa-temperature-three-quarters fa-2x text-primary"></i> {{$item->temperature}}°C
                                    <i class="fa-solid @if ($item->alertTemp == 0) {{'fa-arrow-down text-warning'}} 
                                    @elseif ($item->alertTemp == 1) {{''}}
                                    @elseif ($item->alertTemp == 2) {{'fa-arrow-up text-danger'}} @endif"></i>
                                </div>
                                <div class="h6 mb-0 col-6 font-weight-bold text-gray-800 mb-2"><i class="fas fa-solid fa-droplet fa-2x  text-primary"></i> {{$item->humidity}}%
                                    <i class="fa-solid @if ($item->alertHum == 0) {{'fa-arrow-down text-warning'}} 
                                    @elseif ($item->alertHum == 1) {{''}}
                                    @elseif ($item->alertHum == 2) {{'fa-arrow-up text-danger'}} @endif"></i>
                                </div>

                            </div>
                            <div class="row">
                                <div class="h6 col-6 mb-0 font-weight-bold text-gray-800 mb-2"><i class="fas fa-solid fa-gauge-high fa-1x  text-primary"></i> {{$item->pressure}}hPa
                                    <i class="fa-solid @if ($item->alertPress == 0) {{'fa-arrow-down text-warning'}} 
                                    @elseif ($item->alertPress == 1) {{''}}
                                    @elseif ($item->alertPress == 2) {{'fa-arrow-up text-danger'}} @endif"></i>
                                </div>
                                <div class="h6 col-6 font-weight-bold text-gray-800 mb-2"><i class="fas fa-solid fa-signal text-primary fa-1x"></i> {{$item->rssi}}</div>
                            </div>
                            <div class="mb-0 font-weight-bold text-gray-800 mt-3" style="font-size: 10px;">{{$item->lastUpdate}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('js-custom')
    <script>
        setInterval(function() {
            $('#data-device').html('Loading...');
            $('#data-device').load(location.href + ' #data-device');
        }, 30000);
    </script>
    @endsection
    @endforeach

    @endsection