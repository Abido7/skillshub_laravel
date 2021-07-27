@extends('web.layout')



@section('title')
    skillshub
@endsection



@section('content')



    <!-- Home -->
    <div id="home" class="hero-area">

        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay" style="background-image:url({{ asset('uploads/home-background.jpg') }}"
            )"></div>
        <!-- /Backgound Image -->

        <div class="home-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h1 class="white-text">{{ __('web.hero_title') }}</h1>
                        <p class="lead white-text">{{ __('web.hero_text') }}</p>
                        <a class="main-button icon-button" href="#">{{ __('web.hero_btn') }}</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /Home -->



    <!-- Courses -->
    <div id="courses" class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">
                <div class="section-header text-center">
                    <h2>{{ __('web.exams_title') }}</h2>
                    <p class="lead">{{ __('web.hero_text') }}</p>
                </div>
            </div>
            <!-- /row -->

            <!-- courses -->
            <div id="courses-wrapper">

                <!-- row -->
                <div class="row">

                    @foreach ($exams as $exam)

                        <!-- single course -->
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="course">
                                <a href="{{ url("exams/show/$exam->id") }}" class="course-img">
                                    <img src="{{ asset("uploads/$exam->img") }}" alt="">
                                    <i class=" course-link-icon fa fa-link"></i>
                                </a>
                                <a class="course-title" href="{{ url("exams/show/$exam->id") }}">{{ $exam->name() }}</a>
                                <div class="course-details">
                                    <span class="course-category">{{ $exam->skill->cat->name() }}</span>
                                </div>
                            </div>
                        </div>
                        <!-- /single course -->
                    @endforeach




                </div>
                <!-- /row -->

                <div class="row">

                    <!-- pagination -->
                    {{ $exams->links('web.inc.paginator') }}
                    <!-- pagination -->

                </div>
            </div>
            <!-- /courses -->

        </div>
        <!-- container -->

    </div>
    <!-- /Courses -->



    <!-- Contact CTA -->
    <div id="contact-cta" class="section">

        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay" style="background-image:url({{ asset('uploads/cta.jpg') }})"></div>
        <!-- Backgound Image -->

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <div class="col-md-8 col-md-offset-2 text-center">
                    <h2 class="white-text">{{ __('web.contact_title') }}</h2>
                    <p class="lead white-text">{{ __('web.contact_text') }}</p>
                    <a class="main-button icon-button" href="contact.html">{{ __('web.contact_btn') }}</a>
                </div>

            </div>
            <!-- /row -->

        </div>
        <!-- /container -->

    </div>
    <!-- /Contact CTA -->
@endsection
