@extends('admin.layout')



@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Add New Admin</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ url('/dashboard/admins') }}">Admins</a></li>
                            <li class="breadcrumb-item active"><a>Add New Admin</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12  pb-2">
                        @include('admin.inc.msgs')
                        <form action="{{ url('/dashboard/admins/store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card  p-2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Name </label>
                                            <input type="text" name="name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Email </label>
                                            <input type="email" name="email" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>password Confirm</label>
                                            <input type="password" name="password_confirmation" class="form-control">
                                        </div>
                                    </div>

                                </div>
                                <div class="row d-flex justify-content-end align-items-center">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Role </label>
                                            <select name="role_id" class="custom-select form-control">
                                                <option disabled selected>Choose Role</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="w-100 h-100 d-flex justify-content-end align-items-center pt-3">

                                            <button type="submit" class="btn btn-primary w-100 mx-1">Add
                                                Admin</button>
                                            <a href="{{ url()->previous() }}" class="btn btn-danger w-100 mx-1"
                                                form="modal-form">Cancel</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                    </div>

                </div>
                </form>

            </div>

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
    <!-- /.content -->
    <!-- /.content-wrapper -->
@endsection
