@extends('layouts.master', ['title' => 'Device'])
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Device</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-solid fa-plus fa-sm text-white-50"></i> Tambah Device</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Device Lists -->
        @for($x=0;$x<$device->totalDevice;$x++)
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2">
                    <a href="{{url ('/infolist/'.$device->deviceNameList[$x])}}" class="stretched-link"></a>
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h5 mb-0 font-weight-bold text-gray-800 text-uppercase">
                                    <div class="mb-2">{{$device->sensorNameList[$x]}}</div>
                                    <div class="h6 mb-0 fon text-uppercase fz-10">{{$device->deviceNameList[$x]}}</div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endfor

    </div>
    @endsection