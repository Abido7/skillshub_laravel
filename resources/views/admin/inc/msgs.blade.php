@if ($errors->any())
    <div class="alert alert-danger">
        <ul>

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>
    </div>
@endif

@if (session('msg'))
    <div class="alert alert-success p-1 d-flex justify-content-center align-items-center">
        <p class="m-0">{{ session('msg') }} </p>
    </div>
@endif
