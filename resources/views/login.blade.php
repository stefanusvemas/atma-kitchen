@extends('index')
@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-3">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Login</h3>
                    <form>
                        <div class="mb-2">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Email address">
                        </div>
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password">
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