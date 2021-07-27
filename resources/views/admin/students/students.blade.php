@extends('admin.layout')



@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Students Information</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a>Students</a></li>
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
                                            <th>Email</th>
                                            <th>Verified</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                <tbody>

                                    @foreach ($students as $student)

                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td>
                                                @if ($student->email_verified_at !== null)
                                                    <a class="btn btn-sm btn-success" href="">Yes</a>
                                                @else
                                                    <a class="btn btn-sm btn-danger" href="">No</a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url("/dashboard/students/show-scores/$student->id") }}"
                                                    class="btn btn-sm btn-secondary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
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
