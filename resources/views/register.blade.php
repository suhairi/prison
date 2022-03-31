@extends('layouts.app')

@section('content')

    <div class="row">

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
        <h3>Register a User</h3>

        <div class="row">
            <form method="POST" action="{{ route('admin.register') }}" class="form">
                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control" name="name" placeholder="Fullname" required value="{{ old('name') }}">
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" name="username" placeholder="Username" required value="{{ old('username') }}">
                </div>
                <div class="mb-3">
                    <select id="role" class="form-control" name="role" required />
                        <option value="">Select Role</option>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin"{{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="hq"{{ old('role') == 'hq' ? 'selected' : '' }}>HQ</option>
                    </select>
                </div>
                <div class="mb-3">
                    <input class="form-control" id="password" class="form-control"
                                    type="password"
                                    name="password"
                                    required 
                                    autocomplete="new-password"
                                    placeholder="Password" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">

                    <input class="form-control" id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" 
                                    required
                                    placeholder="Password Confirmation" />
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>        


    

@endsection