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
                        <form action="{{ url('/dashboard/exams/store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card  p-2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> name(en) </label>
                                            <input type="text" name="name_en" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> name(ar) </label>
                                            <input type="text" name="name_ar" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Description(en) </label>
                                            <textarea type="text" name="desc_en" rows="5" class="form-control"
                                                style="resize: none;">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Description(ar) </label>
                                            <textarea type="text" name="desc_ar" rows="5" class="form-control"
                                                style="resize: none;">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Questions no</label>
                                            <input type="number" name="questions_no" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Difficulty</label>
                                            <input type="number" name="difficulty" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Duration (mins.)</label>
                                            <input type="number" name="duration_mins" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label> Skills </label>
                                            <select name="skill_id" class="custom-select form-control">
                                                <option disabled selected>Choose skill</option>
                                                @foreach ($skills as $skill)
                                                    <option value="{{ $skill->id }}">{{ $skill->name('en') }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Image </label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="img" class="custom-file-input">
                                                    <label class="custom-file-label">Choose Image </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
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
