@extends('index')
@section('content')

<main class="col-md">
    <div class="content">
        <div class="container mt-4 bg-light rounded-3 p-4">
            <h4>Profile</h4>
            <div class="mt-4">
                <div class="row">
                    <div class="col col-auto">
                        <h5>{{$user_data['nama']}}</h5>
                    </div>
                    <div class="col">
                        <p>{{$user_data['jumlah_poin']}} <i class="fa fa-coins"></i></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p><i class="fa fa-cake-candles"></i> {{$user_data['tanggal_lahir']}}</p>
                        <p><i class="fa fa-phone"></i> {{$user_data['no_telp']}}</p>
                    </div>

                </div>


                <a href="{{url('user/profile/edit')}}" class="text-decoration-none">Edit Profile</a>
                <hr>
                <h5>Change Email & Password</h5>
                @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{session('error')->first()}}
                </div>
                @endif


                @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{session('success')}}
                </div>
                @endif

            </div>
            <form action="{{url('user/profile')}}" method="post" class="p-2">
                @csrf
                <div class="mb-2">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" required value="{{$user_data['user_credential']['email']}}">

                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</main>

@endsection