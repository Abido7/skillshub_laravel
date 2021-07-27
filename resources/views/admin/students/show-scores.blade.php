@extends('admin.layout')



@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ $student->name }} Scores</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a>{{ $student->name }}</a></li>
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
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Score</th>
                                            <th>Time (mins)</th>
                                            <th>Entered At</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                <tbody>

                                    @foreach ($exams as $exam)

                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $exam->name('en') }}</td>
                                            <td>{{ $exam->pivot->score }}</td>
                                            <td>{{ $exam->pivot->time_mins }}</td>
                                            <td>{{ Carbon\Carbon::parse($exam->pivot->created_at)->format('d M, Y h:m:s') }}
                                            </td>
                                            <td>{{ $exam->pivot->status }}</td>
                                            <td>
                                                @if ($exam->pivot->status == 'open')

                                                    <a href="{{ url("dashboard/students/toggle-status/$student->id/$exam->id") }}"
                                                        class="btn btn-sm btn-danger" title="Click to close">
                                                        <i class="fas fa-lock"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ url("dashboard/students/toggle-status/$student->id/$exam->id") }}"
                                                        class="btn btn-sm btn-primary" title="Click to open">
                                                        <i class="fas fa-lock-open"></i>
                                                    </a>
                                                @endif
                                            </td>


                                        </tr>
                                    @endforeach

                                </tbody>
                                </tbody>
                            </table>
                            {{-- /table --}}

                        </div>
                        {{-- navigation btns --}}
                        {{-- <div class="py-1">
                            <a href="{{ url("/dashboard/exams/show/$exam->id/questions") }}"
                                class="btn btn-secondary">Show
                                Questions</a>
                            <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                        </div> --}}
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
