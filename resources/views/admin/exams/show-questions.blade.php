@extends('admin.layout')



@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ $exam->name('en') }} Questions</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ url('/dashboard/exams') }}">Exams</a></li>
                            <li class="breadcrumb-item active"><a
                                    href="{{ url("/dashboard/exams/show/$exam->id") }}">{{ $exam->name('en') }}</a></li>
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
                    <div class="col-12 pb-2">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>options</th>
                                        <th>Right Ans</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($exam->questions as $ques)

                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $ques->title }}</td>
                                            <td>
                                                1-{{ $ques->option_1 }} <br>
                                                2-{{ $ques->option_2 }} <br>
                                                3-{{ $ques->option_3 }} <br>
                                                4-{{ $ques->option_4 }}
                                            </td>
                                            <td>
                                                {{ $ques->right_answer }}
                                            </td>
                                            <td>

                                                <a href="{{ url("/dashboard/exams/edit-question/$exam->id/$ques->id") }}"
                                                    class="btn btn-sm btn-primary edit-btn">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                {{-- <a href="{{ url("/dashboard/skills/delete/{$skill->id}") }}"
                                                    class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a> --}}
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                        {{-- navigation btns --}}
                        <div class="py-1">
                            <a href="{{ url('/dashboard/exams') }}" class="btn btn-outline-primary">Exams</a>
                            <a href="{{ url()->previous() }}" class="btn btn-outline-primary">Back</a>
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
