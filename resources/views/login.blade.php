@extends('index')
@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-3">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Login</h3>
                    @if (Session::has('error'))
                    <div class="alert alert-danger">
                        <b>Oops!</b> {{session('error')}}
                    </div>
                    @endif
                    @if (Session::has('success'))
                    <div class="alert alert-success">
                        <b>Success!</b> {{session('success')}}
                    </div>
                    @endif
                    <form action="{{ route('loginAction') }}" method="post" id="loginForm">
                        @csrf
                        <div class="mb-2">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Email address" required>
                        </div>
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-dark btn-block">Login</button>
                    </form>
                    <div class="mt-4 text-center">
                        <p>Don't have an account? <a href="{{url('/register')}}">Register</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection