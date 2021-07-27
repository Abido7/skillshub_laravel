@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <h1 class="m-0 text-dark">Categories</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-4">
                        <div class="msgs">
                            @include('admin.inc.msgs')
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Categories</li>
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
                                <h3 class="card-title">Categories</h3>

                                <div class="card-tools">

                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#add-modal">
                                        Add new
                                    </button>
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
                                            <th>Status</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cats as $cat)

                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $cat->name('en') }}</td>
                                                <td>{{ $cat->name('ar') }}</td>
                                                <td>
                                                    @if ($cat->active == 1)
                                                        <a class="btn btn-sm btn-success"
                                                            href="{{ url("/dashboard/categories/toggle/$cat->id") }}">Yes</a>
                                                    @else
                                                        <a class="btn btn-sm btn-danger"
                                                            href="{{ url("/dashboard/categories/toggle/$cat->id") }}">No</a>
                                                    @endif
                                                </td>

                                                <td>

                                                    <button type="button" class="btn btn-sm btn-primary edit-btn"
                                                        data-toggle="modal" data-target="#edit-modal" id="edit-btn"
                                                        data-id="{{ $cat->id }}"
                                                        data-name-en="{{ $cat->name('en') }}"
                                                        data-name-ar="{{ $cat->name('ar') }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>

                                                    <a href="{{ url("/dashboard/categories/delete/{$cat->id}") }}"
                                                        class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                                <div class="d-flex justify-content-center py-3">
                                    {{ $cats->links() }}
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
    <div class="add-modal">
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

                        @include('admin.inc.errors')

                        <form id="modal-form" method="POST" action="{{ url('dashboard/categories/store') }}">
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
    </div>
    {{-- edite modal --}}
    <div class="edit-modal">
        <div class="modal fade" id="edit-modal" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Category</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        @include('admin.inc.errors')

                        <form id="modal-form-edit" method="POST" action="{{ url('dashboard/categories/update') }}">
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
    </div>
@endsection

@section('scripts')

    <script>
        $(".edit-btn").click(function() {
            //get elements
            let id = $(this).attr('data-id');
            let name_en = $(this).attr('data-name-en');
            let name_ar = $(this).attr('data-name-ar');
            //assign values
            $("#edit-id").val(id)
            $("#edit-name-en").val(name_en)
            $("#edit-name-ar").val(name_ar)

        });
    </script>
@endsection
