@extends('layouts.master', ['title' => ' User Management '])
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h1 mb-0 text-gray-800">User Management</h1>
        <div class="d-sm-inline-block">
            <a href="#" class="d-none d-sm-inline-block btn btn-md font-weight-bold text-white btn-primary shadow-sm" data-toggle="modal" data-target="#add"><i class="fas fa-solid fa-user-plus"></i> Buat User Baru</a>
        </div>

    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive table-responsive-lg">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    {{-- <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </tfoot> --}}
                    <tbody>
                        @foreach ($user->userList as $user)
                        <tr>
                            <!-- <td>{{$loop -> iteration}} </td> -->
                            <td>{{{$loop -> iteration}}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            @if ($user->roles == 1)
                            <td>Administrator</td>
                            @elseif ($user->roles == 2)
                            <td>Engineer</td>
                            @elseif ($user->roles == 3)
                            <td>Operator</td>
                            @endif
                            <td>
                                <a type="button" data-toggle="modal" data-placement="bottom" title="Delete User" data-target="#edit-{{$user->id}}" class=" btn btn-primary"><i class="fas fa-solid fa-edit "></i></a>
                                <a type="button" data-toggle="modal" data-placement="bottom" title="Change Password" data-target="#pass-{{$user->id}}" class=" btn btn-warning"><i class="fas fa-solid fa-key"></i></a>
                                <a type="button" data-toggle="modal" data-placement="bottom" title="Delete User" data-target="#delete-{{$user->id}}" class=" btn btn-danger"><i class="fas fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                        @include('pages.admin.delete')
                        @include('pages.admin.edit')
                        @include('pages.admin.password')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('pages.admin.create')

    @endsection