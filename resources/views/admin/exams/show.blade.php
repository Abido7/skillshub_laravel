@extends('admin.layout')



@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Exam Details</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ url('/dashboard/exams') }}">Exams</a></li>
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
                    <div class="col-md-10 offset-md-1 pb-2">
                        <div class="card">
                            <table class="table table-responsive-sm table-hover ">
                                <tbody>
                                    <tr>
                                        <th>Name(en)</th>
                                        <td>{{ $exam->name('en') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Name(ar)</th>
                                        <td>{{ $exam->name('ar') }}</td>
                                    </tr>
                                    <tr>
                                        <th>img</th>
                                        <td>
                                            <img src="{{ asset("uploads/$exam->img") }}" height="50px" aria-hidden="true">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Description(en)</th>
                                        <td>{{ $exam->desc('en') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Description(ar)</th>
                                        <td>{{ $exam->desc('ar') }}</td>
                                    </tr>
                                    <tr>
                                        <th>skill Name</th>
                                        <td>{{ $exam->desc('en') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Questions no.</th>
                                        <td>{{ $exam->questions_no }}</td>
                                    </tr>
                                    <tr>
                                        <th>Difficulty</th>
                                        <td>{{ $exam->difficulty }}</td>
                                    </tr>
                                    <tr>
                                        <th>Duration (min)</th>
                                        <td>{{ $exam->duration_mins }}</td>
                                    </tr>

                                    <tr>
                                        <th>Active</th>
                                        <td>
                                            @if ($exam->active == 1)
                                                <a class="btn btn-sm btn-success"
                                                    href="{{ url("/dashboard/exams/toggle/$exam->id") }}">Yes</a>
                                            @else
                                                <a class="btn btn-sm btn-danger"
                                                    href="{{ url("/dashboard/exams/toggle/$exam->id") }}">No</a>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            {{-- /table --}}

                        </div>
                        {{-- navigation btns --}}
                        <div class="py-1">
                            <a href="{{ url("/dashboard/exams/show/$exam->id/questions") }}"
                                class="btn btn-secondary">Show
                                Questions</a>
                            <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                        </div>
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
