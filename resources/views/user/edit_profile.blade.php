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
            <form action="" class="p-2">
                <div class="mb-2">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" id="nama" value="Nama Userr" required>

                    <label for="tgl_lahir">Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tanggal_lahir" id="tgl_lahir" required>

                    <label for="no_telp">Telp</label>
                    <input type="telp" class="form-control" name="no_telp" id="no_telp" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</main>

@endsection