@extends('web.layout')

@section('title')
    sign in
@endsection

@section('content')

    <!-- Hero-area -->
    <div class="hero-area section">

        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay"
            style="background-image:url({{ asset('uploads/page-background.jpg') }})">
        </div>
        <!-- /Backgound Image -->

        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <ul class="hero-area-tree">
                        <li><a href="index.html">{{ __('web.home') }}</a></li>
                        <li>{{ __('web.signin') }}</li>
                    </ul>
                    <h1 class="white-text">{{ __('web.startExam') }}</h1>

                </div>
            </div>
        </div>

    </div>
    <!-- /Hero-area -->

    <!-- Contact -->
    <div id="contact" class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <!-- profile section -->
                <div class="col-12 ">

                    <table class="table text-center">

                        <thead>
                            <tr>
                                <th class="text-center">{{ __('web.examName') }}</th>
                                <th class="text-center">{{ __('web.score') }}</th>
                                <th class="text-center">{{ __('web.time') }}( mins )</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($exams as $exam)
                                <tr>
                                    <td>{{ $exam->name() }}</td>
                                    <td>{{ $exam->pivot->score }}</td>
                                    <td>{{ $exam->pivot->time_mins }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <!-- /profile section -->

            </div>
            <!-- /row -->

        </div>
        <!-- /container -->

    </div>
    <!-- /Contact -->
@endsection
