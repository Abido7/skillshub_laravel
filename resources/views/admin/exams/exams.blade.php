@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <h1 class="m-0 text-dark">Exams</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-4">
                        <div class="msgs">
                            @include('admin.inc.msgs')
                            @include('admin.inc.errors')
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Exams</li>
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Exam</h3>

                                <div class="card-tools">

                                    <a href="{{ url('/dashboard/exams/create') }}" class="btn btn-primary">
                                        Add new
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name(en)</th>
                                            <th>Name(ar)</th>
                                            <th>Image</th>
                                            <th>Skill</th>
                                            <th>Questions No</th>
                                            <th>Status</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($exams as $exam)

                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $exam->name('en') }}</td>
                                                <td>{{ $exam->name('ar') }}</td>
                                                <td>
                                                    <img src="{{ asset("uploads/$exam->img") }}" height="50px"
                                                        aria-hidden="true">
                                                </td>
                                                <td>{{ $exam->skill->name() }}</td>
                                                <td>{{ $exam->questions_no }}</td>

                                                <td>
                                                    @if ($exam->active == 1)
                                                        <a class="btn btn-sm btn-success"
                                                            href="{{ url("/dashboard/exams/toggle/$exam->id") }}">Yes</a>
                                                    @else
                                                        <a class="btn btn-sm btn-danger"
                                                            href="{{ url("/dashboard/exams/toggle/$exam->id") }}">No</a>
                                                    @endif
                                                </td>

                                                <td>

                                                    <a href="{{ url("/dashboard/exams/show/$exam->id") }}"
                                                        class="btn btn-sm btn-secondary">
                                                        <i class="fas fa-eye"></i>
                                                    </a>


                                                    <a href="{{ url("/dashboard/exams/show/$exam->id/questions") }}"
                                                        class="btn btn-sm btn-info">
                                                        <i class="fas fa-question"></i>
                                                    </a>


                                                    <a href="{{ url("/dashboard/exams/edit/$exam->id") }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <a href="{{ url("/dashboard/exams/delete/{$exam->id}") }}"
                                                        class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                                <div class="d-flex justify-content-center py-3">
                                    {{ $exams->links() }}
                                </div>
                            </div>
                            <!-- /.card-body -->
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

@section('modal')
    <!-- modal -->
    {{-- <div class="add-modal">
        <div class="modal fade" id="add-modal" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Category</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">


                        <form id="modal-form" method="POST" action="{{ url('dashboard/skills/store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
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
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Category </label>
                                            <select name="cat_id" class="custom-select form-control">
                                                <option disabled selected>Choose Category</option>
                                                @foreach ($cats as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->name() }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
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
                                </div>
                        </form>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" form="modal-form">Save changes</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div> --}}
    {{-- edite modal --}}
    {{-- <div class="edit-modal">
        <div class="modal fade" id="edit-modal" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Skill</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        @include('admin.inc.errors')

                        <form id="modal-form-edit" method="POST" action="{{ url('dashboard/skills/update') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="edit-id">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> name(en) </label>
                                            <input type="text" id="edit-name-en" name="name_en" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> name(ar) </label>
                                            <input type="text" id="edit-name-ar" name="name_ar" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Category </label>
                                            <select name="cat_id" id="cat-name" class="custom-select form-control">
                                                @foreach ($cats as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->name() }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
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
                                </div>
                        </form>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" form="modal-form-edit">update</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div> --}}
@endsection
