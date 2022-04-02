@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::has('success'))
    <div class="alert alert-success">
        <strong>Success!</strong> Indicates a successful or positive action.
    </div>
@endif

@if(Session::has('fail'))
    <div class="alert alert-error">
        <strong>Error!</strong> Indicates a failure or negative action.
    </div>
@endif

