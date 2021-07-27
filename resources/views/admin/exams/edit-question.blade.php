@extends('admin.layout')

@section('styles')
    {{-- /* disable arrow in number input */ --}}
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

    </style>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit Question</h1>
                    </div><!-- /.col -->

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ url()->previous() }}">Question</a></li>
                            <li class="breadcrumb-item active"><a>Edit</a></li>
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

                        <form action="{{ url("/dashboard/exams/update-question/$exam->id/$ques->id}") }}" method="POST">
                            @csrf
                            <div class="card  p-2">
                                <h5>Question {{ $ques->name }}</h5>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Title </label>
                                            <input type="text" name="title" class="form-control"
                                                value="{{ $ques->title }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Right Answer </label>
                                            <input type="number" name="right_answer" class="form-control"
                                                value="{{ $ques->right_answer }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Option 1 </label>
                                            <input type="text" name="option_1" class="form-control"
                                                value="{{ $ques->option_1 }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Option 2 </label>
                                            <input type="text" name="option_2" class="form-control"
                                                value="{{ $ques->option_2 }}">
                                        </div>
                                    </div>
                                    <div class=" col-md-6">
                                        <div class="form-group">
                                            <label> Option 3 </label>
                                            <input type="text" name="option_3" class="form-control"
                                                value="{{ $ques->option_3 }}">
                                        </div>
                                    </div>
                                    <div class=" col-md-6">
                                        <div class="form-group">
                                            <label> Option 4 </label>
                                            <input type="text" name="option_4" class="form-control"
                                                value="{{ $ques->option_4 }}">
                                        </div>
                                    </div>
                                </div>

                                <div class=" row">
                                    <div class="col-md-12">
                                        <div class="w-50 h-100 d-flex justify-content-end align-items-center pt-3">

                                            <button type="submit" class="btn btn-primary w-50 mx-1">Save
                                                Changes</button>
                                            <a href="{{ url()->previous() }}" class="btn btn-danger w-50 mx-1">Cancel</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>

                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
