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
                    <div class="col-sm-4">
                        <h1 class="m-0 text-dark">Add New Exam</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-4">
                        <div class="msg">
                            @include('admin.inc.msgs')
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ url()->previous() }}">Exams</a></li>
                            <li class="breadcrumb-item active"><a>Add New</a></li>
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
                        <form action="{{ url("/dashboard/exams/store-questions/$exam_id") }}" method="POST">
                            @csrf
                            <div class="card  p-2">

                                @for ($i = 1; $i <= $questions_no; $i++)
                                    <h5>Question {{ $i }}</h5>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> Title </label>
                                                <input type="text" name="titles[]" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> Right Answer </label>
                                                <input type="number" name="right_answers[]" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> Option 1 </label>
                                                <input type="text" name="option_1s[]" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> Option 2 </label>
                                                <input type="text" name="option_2s[]" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> Option 3 </label>
                                                <input type="text" name="option_3s[]" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> Option 4 </label>
                                                <input type="text" name="option_4s[]" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                @endfor



                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="w-100 h-100 d-flex justify-content-end align-items-center pt-3">

                                            <button type="submit" class="btn btn-primary w-100 mx-1">Add
                                                Exam</button>
                                            <a href="{{ url()->previous() }}" class="btn btn-danger w-100 mx-1"
                                                form="modal-form">Cancel</a>
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
