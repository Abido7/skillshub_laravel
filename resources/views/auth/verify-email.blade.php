@extends('web.layout')

@section('title')
    verify email
@endsection

@section('content')

    <div class="alert alert-success text-center">

        {{ __('web.verifyMsg') }}
    </div>

    <div id="contact" class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <!-- login form -->
                <div class="contact-form">
                    @include('web.inc.msgs')
                    <form method="POST" action="{{ url('/email/verification-notification') }}">
                        @csrf
                        <button type="submit" class="main-button icon-button pull-right">{{ __('web.resend') }}
                        </button>
                </div>
                </form>
            </div>
            <!-- /login form -->

        </div>
        <!-- /row -->

    </div>
    <!-- /container -->

    </div>
@endsection
