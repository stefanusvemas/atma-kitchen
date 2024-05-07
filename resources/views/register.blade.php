@extends('index')
@section('content')

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-3">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Register</h3>
                    @if (Session::has('error'))
                    <div class="alert alert-danger">
                        <b>Oops!</b> {{session('error')->first()}}
                    </div>
                    @endif
                    <form action="{{ route('registerAction') }}" method="post">
                        @csrf
                        <div class="mb-2">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="nama" id="name" placeholder="Enter your full name">
                        </div>
                        <div class="mb-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email address">
                        </div>
                        <div class="mb-2">
                            <label for="telephone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" name="no_telp" id="telephone" placeholder="Enter your telephone number">
                        </div>
                        <div class="mb-2">
                            <label for="birthDate" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" name="tanggal_lahir" id="birthDate">
                        </div>
                        <div class="mb-2">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
                        </div>

                        <button type="submit" class="btn btn-dark btn-block">Register</button>
                    </form>
                    <div class="text-center mt-3">
                        <p>Already have an account? <a href="{{url('/login')}}">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection