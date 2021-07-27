@extends('admin.layout')



@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ $message->name }} Message Details</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ url('/dashboard/messages') }}">Messages</a>
                            </li>
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
                                        <th>Name</th>
                                        <td>{{ $message->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $message->email }}</td>
                                    </tr>

                                    <tr>
                                        <th>Subject</th>
                                        <td>{{ $message->subject ?? '...' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Body</th>
                                        <td>{{ $message->body }}</td>
                                    </tr>

                                </tbody>
                            </table>
                            {{-- /table --}}

                        </div>
                    </div>

                </div>
                <!-- /.row -->

                <div class="col-12  pb-2">
                    @include('admin.inc.msgs')
                    <form action="{{ url("/dashboard/messages/response/$message->id") }}" method="POST">
                        @csrf
                        <div class="card  p-2">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label> Title </label>
                                        <input type="text" name="title" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label> Body </label>
                                        <textarea type="text" name="body" rows="5" class="form-control"
                                            style="resize: none;">
                                                            </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="h-100 d-flex justify-content-end align-items-center pt-3">
                                        <button type="submit" class="btn btn-primary mx-1">Send Response</button>
                                        <a href="{{ url()->previous() }}" class="btn btn-danger mx-1">Cancel</a>
                                    </div>
                                </div>

                            </div>




                        </div>
                    </form>

                </div>



            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
