@extends('index')
@section('content')

<main class="col-md">
    <div class="content">
        <div class="container mt-4 bg-light rounded-3 p-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('user/profile')}}">Profile</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
            <h4>Edit Profile</h4>
            @if(session('error'))
            <div class="alert alert-danger" role="alert">
                {{session('error')->first()}}
            </div>
            @endif
            <form action="{{url('user/profile/edit')}}" method="post" class="p-2">
                @csrf
                <div class="mb-2">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" id="nama" value="{{$user_data['nama']}}" required>

                    <label for="tgl_lahir">Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tanggal_lahir" id="tgl_lahir" value="{{$user_data['tanggal_lahir']}}" required>

                    <label for="no_telp">Telp</label>
                    <input type="telp" class="form-control" name="no_telp" id="no_telp" value="{{$user_data['no_telp']}}" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</main>

@endsection