@extends('layouts.master', ['title' => ' Info Device '])
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h1 mb-0 text-gray-800">{{$info->deviceInfo->sensorName}}</h1>
        <div class="row">
            <div class="d-sm-inline-block">
                <a href="#" class="d-none d-sm-inline-block align-content-end btn btn-sm font-weight-bold text-white btn-info shadow-sm" data-toggle="modal" data-target="#kalibrasi"><i class="fas fa-regular fa-magnet"></i> Kalibrasi Sensor</a>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm font-weight-bold text-white btn-primary shadow-sm" data-toggle="modal" data-target="#edit"><i class="fas fa-solid fa-edit"></i> Edit Info Sensor</a>
            </div>
        </div>

    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%">
                    <tr>
                        <th width="12%">Nama Sensor</th>
                        <td>:</td>
                        <td>{{$info->deviceInfo->sensorName}}</td>
                        <th>Serial Number</th>
                        <td>:</td>
                        <td>{{$info->deviceInfo->serialNumber}}</td>
                        <th>RSSI</th>
                        <td>:</td>
                        <td>{{$info->deviceInfo->rssi}}</td>
                    </tr>

                    <tr>
                        <th width="10%">Device Name</th>
                        <td>:</td>
                        <td>{{$info->deviceInfo->deviceName}}</td>

                        <th width="11%">Tipe Sensor</th>
                        <td>:</td>
                        <td>{{$info->deviceInfo->typeSensor}}</td>

                        <th>Tanggal Instalasi</th>
                        <td>:</td>
                        <td>{{$info->deviceInfo->instalationDate}}</td>
                    </tr>

                    <tr>
                        <th width="10%">Temperature</th>
                        <td>:</td>
                        <td>{{$info->deviceInfo->temperature}}</td>

                        <th width="11%">Humidity</th>
                        <td>:</td>
                        <td>{{$info->deviceInfo->humidity}}</td>

                        <th>Pressure</th>
                        <td>:</td>
                        <td>{{$info->deviceInfo->pressure}}</td>
                    </tr>

                    <tr>
                        <th width="5%">Koordinat</th>
                        <td>:</td>
                        <td>{{$info->deviceInfo->latitude}}<br>{{$info->deviceInfo->longitude}}</td>

                        <th width="15%">Alamat Sensor</th>
                        <td>:</td>
                        <td colspan="4">{{$info->deviceInfo->sensorAddress}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div id="grafik" class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Riwayat Sensor</h6>
                    <div class="dropdown no-arrow">
                        <form id="chart" class="form-group" data-url="{{route('chart', ['deviceName' => $info->deviceInfo->deviceName])}}" method="get">
                            <select class="form-select form-control" id="filter" name="filter" onchange="this.form.submit()">
                                <option value="1" {{ $api->filter == 1 ? 'selected' : '' }}>1 Jam Terakhir</option>
                                <option value="2" {{ $api->filter == 2 ? 'selected' : '' }}>24 Jam Terakhir</option>
                                <option value="3" {{ $api->filter == 3 ? 'selected' : '' }}>Seminggu Terakhir</option>
                                <option value="3" {{ $api->filter == 4 ? 'selected' : '' }}>Sebulan Terakhir</option>
                            </select>
                        </form>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myChart">
                        </canvas>
                    </div>
                </div>
            </div>
        </div>


        @section('js-custom')
        <script>
            $(document).ready(function() {
                $("#chart").submit(function(e) {
                    e.preventDefault(); // prevent the form from submitting normally
                    $.ajax({
                        type: "GET",
                        url: $(this).data("url"), // the URL of the route that processes the form
                        data: $("#chart").serialize(), // serialize the form data
                        success: function(response) {
                            $("#grafik").html(response); // update the grafik div with the response
                        }
                    });
                });
            });
        </script>

        <script>
            // Set new default font family and font color to mimic Bootstrap's default styling
            (Chart.defaults.global.defaultFontFamily = "Nunito"),
            '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = "#858796";

            // Area Chart Example
            var ctx = document.getElementById("myChart");
            var myLineChart = new Chart(ctx, {
                type: "line",
                data: {
                    labels: [
                        <?php
                        $data = array_reverse($data);
                        foreach ($data as $datum) {
                            echo "'" . $datum->time . "', ";
                        }
                        ?>
                    ],
                    datasets: [{
                            label: "Temperature",
                            lineTension: 0.3,
                            backgroundColor: "rgba(78, 115, 223, 0.05)",
                            borderColor: "rgba(78, 115, 223, 1)",
                            pointRadius: 2,
                            pointBackgroundColor: "rgba(78, 115, 223, 1)",
                            pointBorderColor: "rgba(78, 115, 223, 1)",
                            pointHoverRadius: 3,
                            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                            pointHitRadius: 10,
                            pointBorderWidth: 2,
                            data: [<?php
                                    // $data = array_reverse($data);
                                    foreach ($data as $datum) {
                                        if (is_object($datum) && property_exists($datum, 'temperature')) {
                                            echo $datum->temperature . ',';
                                        }
                                    }
                                    ?>],
                        },
                        {
                            label: "Humidity",
                            lineTension: 0.3,
                            backgroundColor: "rgba(0, 255, 0, 0.05)",
                            borderColor: "rgba(0, 255, 0, 1)",
                            pointRadius: 2,
                            pointBackgroundColor: "rgba(0, 255, 0, 1)",
                            pointBorderColor: "rgba(0, 255, 0, 1)",
                            pointHoverRadius: 3,
                            pointHoverBackgroundColor: "rgba(0, 255, 0, 1)",
                            pointHoverBorderColor: "rgba(0, 255, 0, 1)",
                            pointHitRadius: 10,
                            pointBorderWidth: 2,
                            data: [<?php
                                    // $data = array_reverse($data);
                                    foreach ($data as $datum) {
                                        if (is_object($datum) && property_exists($datum, 'humidity')) {
                                            echo $datum->humidity . ',';
                                        }
                                    }
                                    ?>],
                        },

                        {
                            label: "Pressure",
                            lineTension: 0.3,
                            backgroundColor: "rgba(000, 000, 000, 0.05)",
                            borderColor: "rgba(255, 51, 51, 1)",
                            pointRadius: 2,
                            pointBackgroundColor: "rgba(255, 51, 51, 1)",
                            pointBorderColor: "rgba(255, 51, 51, 1)",
                            pointHoverRadius: 3,
                            pointHoverBackgroundColor: "rgba(255, 51, 51, 1)",
                            pointHoverBorderColor: "rgba(255, 51, 51,, 1)",
                            pointHitRadius: 10,
                            pointBorderWidth: 2,
                            data: [<?php
                                    // $data = array_reverse($data);
                                    foreach ($data as $datum) {
                                        if (is_object($datum) && property_exists($datum, 'pressure')) {
                                            echo $datum->pressure . ',';
                                        }
                                    }
                                    ?>],
                        },
                    ],
                },
                options: {
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            left: 10,
                            right: 25,
                            top: 25,
                            bottom: 0,
                        },
                    },
                    scales: {
                        xAxes: [{
                            time: {
                                unit: "hour",
                            },
                            gridLines: {
                                display: false,
                                drawBorder: true,
                            },
                            ticks: {
                                maxTicksLimit: 10,
                            },
                        }, ],
                        yAxes: [{
                            ticks: {
                                maxTicksLimit: 10,
                                padding: 40,
                            },
                            gridLines: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2],
                            },
                        }, ],
                    },
                    legend: {
                        display: false,
                    },
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        titleMarginBottom: 10,
                        titleFontColor: "#6e707e",
                        titleFontSize: 14,
                        borderColor: "#dddfeb",
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        intersect: false,
                        mode: "index",
                        caretPadding: 10,
                    },
                },
            });
        </script>


        @endsection


        <!-- Koordinat-->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Koordinat</h6>
                </div>
                <!-- Card Body -->
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe src="https://maps.google.com/maps?q={{$info->deviceInfo->latitude}},{{$info->deviceInfo->longitude}}&z=13&output=embed" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal-->
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Info Sensor</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form form-horizontal" action="{{route('edit', ['deviceName' => $deviceName])}}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="total" class="col-sm-4 col-form-label">Tanggal Instalasi</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" name="instalationDate" value="{{$info->deviceInfo->instalationDate}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total" class="col-sm-4 col-form-label">Nama Sensor</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" required name="sensorName" value="{{$info->deviceInfo->sensorName}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total" class="col-sm-4 col-form-label">Serial Number</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" disabled readonly value="{{$info->deviceInfo->serialNumber}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total" class="col-sm-4 col-form-label">Device Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" disabled readonly value="{{$info->deviceInfo->deviceName}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total" class="col-sm-4 col-form-label">Tipe Sensor</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" disabled readonly value="{{$info->deviceInfo->typeSensor}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total" class="col-sm-4 col-form-label">Koordinat</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control mb-1" name="longitude" value="{{$info->deviceInfo->longitude}}">
                                <input type="text" class="form-control" name="latitude" value="{{$info->deviceInfo->latitude}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total" class="col-sm-4 col-form-label">Alamat Sensor</label>
                            <div class="col-sm-8">
                                <textarea type="text" class="form-control" name="addressSensor">{{$info->deviceInfo->sensorAddress}}</textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary ml-1">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Simpan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Kalibrasi -->
    <div class="modal fade" id="kalibrasi" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kalibrasi {{$cal->deviceCalibration->deviceName}}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form form-horizontal" action="{{route('kalibrasi', ['deviceName' => $deviceName])}}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="total" class="col-sm-4 col-form-label">Original Temperature </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" disabled value="{{$cal->deviceCalibration->temperatureOri}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="total" class="col-sm-4 col-form-label">Original Humidity</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" disabled value="{{$cal->deviceCalibration->humidityOri}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="total" class="col-sm-4 col-form-label">Original Pressure</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" disabled value="{{$cal->deviceCalibration->pressureOri}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total" class="col-sm-4 col-form-label">Temperature</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" disabled value="{{$cal->deviceCalibration->temperature}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total" class="col-sm-4 col-form-label">Humidity</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{$cal->deviceCalibration->humidity}}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total" class="col-sm-4 col-form-label">Pressure</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{$cal->deviceCalibration->pressure}}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total" class="col-sm-4 col-form-label">Offset Temp</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" required value="{{$cal->deviceCalibration->offsetTemp}}" name="offsetTemp">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total" class="col-sm-4 col-form-label">Offset Hum</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" required value="{{$cal->deviceCalibration->offsetHum}}" name="offsetHum">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total" class="col-sm-4 col-form-label">Offset Press</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" required value="{{$cal->deviceCalibration->offsetPress}}" name="offsetPress">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total" class="col-sm-4 col-form-label">Trigger Up Temp</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" required value="{{$cal->deviceCalibration->triggerUpTemp}}" name="triggerUpTemp">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total" class="col-sm-4 col-form-label">Trigger Down Temp</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" required value="{{$cal->deviceCalibration->triggerDownTemp}}" name="triggerDownTemp">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total" class="col-sm-4 col-form-label">Trigger Up Hum</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" required value="{{$cal->deviceCalibration->triggerUpHum}}" name="triggerUpHum">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total" class="col-sm-4 col-form-label">Trigger Down Hum</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" required value="{{$cal->deviceCalibration->triggerDownHum}}" name="triggerDownHum">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total" class="col-sm-4 col-form-label">Trigger Up Press</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" required value="{{$cal->deviceCalibration->triggerUpPress}}" name="triggerUpPress">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total" class="col-sm-4 col-form-label">Trigger Down Press</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" required value="{{$cal->deviceCalibration->triggerDownPress}}" name="triggerDownPress">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary ml-1">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Simpan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection