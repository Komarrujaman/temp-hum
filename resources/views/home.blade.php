@extends('layouts.master', ['title' => 'Dashboard'])
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h1 mb-0 text-gray-800">Dashboard</h1>
    </div>

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

        @if ($item->alert == 1) <audio src="{{asset('assets/audio/1.wav')}}" autoplay></audio>
        @elseif ($item->alert == 2) <audio src="{{asset('assets/audio/2.wav')}}" autoplay></audio>
        @elseif ($item->alert == 3)<audio src="{{asset('assets/audio/3.wav')}}" autoplay></audio>
        @endif
        <div class="col-xl-3 col-md-6 mb-2">
            <div class="card shadow h-80 py-1 @if ($diff->d > 0 || $diff->h > 1) {{ 'border-secondary' }} 
            @elseif ($item->alert == 1) {{ 'border-success'}}
            @elseif ($item->alert == 2) {{ 'border-warning' }}
            @elseif ($item->alert == 3) {{'border-danger' }}
            @elseif ($item->alert == 0) {{'border-primary' }}
            @endif" id="listDevice">
                <div class="card-body">
                    <a href="{{url ('/info/'.$item->deviceName)}}" class="stretched-link"></a>
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="h6 font-weight-bold text-gray-800 text-uppercase">{{$item->sensorName}}</div>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="fas fa-solid fa-bell fa-lg @if ($diff->d > 0 || $diff->h > 1) {{ 'text-secondary' }} 
            @elseif ($item->alert == 1) {{ 'text-success'}}
            @elseif ($item->alert == 2) {{ 'text-warning' }}
            @elseif ($item->alert == 3) {{'text-danger' }}
            @elseif ($item->alert == 0) {{'text-primary' }}
            @endif"></i>
                                </div>
                            </div>
                            <div class="h2 mb-0 font-weight-bold text-gray-800 mb-2">{{$item->level}} cm</div>
                            <div class="table-responsive" style="font-size: 10px;">
                                <table class="table table-borderless table-sm">

                                    <tr>
                                        <th class="font-weight-bold text-black text-uppercase">
                                            RSSI
                                        </th>
                                        <td>
                                            :
                                        </td>
                                        <td>
                                            {{$item->rssi}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="font-weight-bold text-black text-uppercase">
                                            SNR
                                        </th>
                                        <td>
                                            :
                                        </td>
                                        <td>
                                            {{$item->snr}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="font-weight-bold text-black text-uppercase">
                                            Battery
                                        </th>
                                        <td>
                                            :
                                        </td>
                                        <td>
                                            {{$item->battery}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="font-weight-bold text-black text-uppercase">
                                            Last Update
                                        </th>
                                        <td>
                                            :
                                        </td>
                                        <td>
                                            {{$item->lastUpdate}}
                                        </td>
                                    </tr>
                                </table>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endforeach


    </div>
    @endsection