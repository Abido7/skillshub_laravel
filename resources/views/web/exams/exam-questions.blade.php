@extends('web.layout')


@section('title')
    exam-questions
@endsection

@section('addition-style')
    <link href="{{ asset('css/TimeCircles.css') }}" rel="stylesheet">

@endsection

@section('content')

    <!-- Hero-area -->
    <div class="hero-area section">

        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay"
            style="background-image:url({{ asset('uploads/blog-post-background.jpg') }})"></div>
        <!-- /Backgound Image -->

        <div class=" container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <ul class="hero-area-tree">
                        <li><a href="index.html">{{ __('web.home') }}</a></li>
                        <li><a href="category.html">{{ $exam->skill->cat->name() }}</a></li>
                        <li><a href="category.html">{{ $exam->skill->name() }}</a></li>
                        <li>{{ $exam->name() }}</li>
                    </ul>
                    <h1 class="white-text">{{ $exam->name() }}</h1>
                    <ul class="blog-post-meta">
                        <li>{{ Carbon\Carbon::parse($exam->created_at)->format('d M, Y') }}</li>
                        <li class="blog-meta-comments"><a href="#"><i class="fa fa-users"></i>
                                {{ $exam->users()->count() }}</a></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <!-- /Hero-area -->

    <!-- Blog -->
    <div id="blog" class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <!-- main blog -->
                <div id="main" class="col-md-9">
                    <form action="{{ url("exams/submit/$exam->id") }}" method="POST" id="exam-form">
                        @csrf
                    </form>
                    <!-- blog post -->
                    <div class="blog-post mb-5">
                        <p>
                            @foreach ($exam->questions as $index => $question)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">{{ $index + 1 }} - {{ $question->title }}?</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="answers[{{ $question->id }}]" value="1"
                                                    form="exam-form">
                                                {{ $question->option_1 }}
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="answers[{{ $question->id }}]" value="2"
                                                    form="exam-form">
                                                {{ $question->option_2 }}
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="answers[{{ $question->id }}]" value="3"
                                                    form="exam-form">
                                                {{ $question->option_3 }}
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="answers[{{ $question->id }}]" value="4"
                                                    form="exam-form">
                                                {{ $question->option_4 }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </p>
                    </div>
                    <!-- /blog post -->

                    <div>
                        <button type="submit" form="exam-form" class="main-button icon-button pull-left">Submit</button>
                        <button class="main-button icon-button btn-danger pull-left ml-sm">Cancel</button>
                    </div>
                </div>
                <!-- /main blog -->

                <!-- aside blog -->
                <div id="aside" class="col-md-3">

                    <!-- exam details widget -->
                    <ul class="list-group">
                        <li class="list-group-item">{{ __('web.skill') }}: {{ $exam->skill->name() }}</li>
                        <li class="list-group-item">{{ __('web.questions') }}: {{ $exam->questions_no }}</li>
                        <li class="list-group-item">{{ __('web.duration') }}: {{ $exam->duration_mins }} mins</li>
                        <li class="list-group-item">{{ __('web.difficulty') }}:

                            @for ($i = 0; $i < $exam->difficulty; $i++)

                                <i class="fa fa-star"></i>


                            @endfor
                            @for ($i = 0; $i < 5 - $exam->difficulty; $i++)

                                <i class="fa fa-star-o"></i>


                            @endfor


                        </li>
                    </ul>
                    <!-- /exam details widget -->

                    <div class="counter" data-timer="{{ $exam->duration_mins * 60 }}"></div>

                </div>
                <!-- /aside blog -->

            </div>
            <!-- row -->

        </div>
        <!-- container -->

    </div>
    <!-- /Blog -->
@endsection

@section('addition-scripts')
    <script type="text/javascript" src="{{ asset('js/TimeCircles.js') }}"></script>
    <script>
        $(".counter").TimeCircles({
            time: {
                Days: {
                    show: false
                }
            },
            count_past_zero: false
        }).addListener(function(unit, value, total) {
            if (total <= 0) {
                $('#exam-form').submit();
            };
        });
    </script>
@endsection
