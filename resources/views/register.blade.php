@extends('layouts.app')

@section('content')

<div class="row">

    @include('layouts.messages')
    <div class="row">
        <h4><a href="{{ url()->previous() }}"><i class="bx bx-arrow-back bx-fade-left-hover"> </i></a> Register a User</h4>            
    </div>    
    <hr />

    <div class="row">
        <form method="POST" action="{{ route('admin.register') }}" class="form">
            @csrf
            <div class="mb-3">
                <input type="text" class="form-control form-control-sm" name="name" placeholder="Fullname" required value="{{ old('name') }}">
            </div>
            <div class="mb-3">
                <input type="text" class="form-control form-control-sm" name="username" placeholder="Username" required value="{{ old('username') }}">
            </div>
            <div class="mb-3">
                <select id="role" class="form-control form-control-sm" name="role" required />
                    <option value="">Select Role</option>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin"{{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="hq"{{ old('role') == 'hq' ? 'selected' : '' }}>HQ</option>
                </select>
            </div>
            <div class="mb-3">
                <input class="form-control form-control-sm" id="password"
                                type="password"
                                name="password"
                                required 
                                autocomplete="new-password"
                                placeholder="Password" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">

                <input class="form-control form-control-sm" id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" 
                                required
                                placeholder="Password Confirmation" />
            </div>

            <button type="submit" class="btn btn-primary btn-sm">
                <i class="bx bx-user-plus"></i> 
                Add a User
            </button>
        </form>
    </div>
</div>        


    

@endsection