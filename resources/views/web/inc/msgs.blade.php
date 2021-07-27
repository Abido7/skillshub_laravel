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
    <div class="alert alert-success">
        <p>{{ session('msg') }}</p>
    </div>
@endif

@if (session('status'))
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('status') }}
    </div>
@endif
