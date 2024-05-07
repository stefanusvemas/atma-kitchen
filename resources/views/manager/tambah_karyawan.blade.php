@extends('manager/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4 bg-light rounded-3 p-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('manager/karyawan')}}">Karyawan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                </ol>
            </nav>
            <h4>Tambah Karyawan</h4>
            @if(session('error'))
            <div class="alert alert-danger" role="alert">
                {{session('error')->first()}}
            </div>
            @endif

            <form action="{{url('manager/karyawan/add')}}" method="post" class="p-3">
                @csrf
                <div class="mb-2">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" id="nama" required>

                    <label for="jabatan" class="form-label">Jabatan</label>
                    <select class="form-select" name="id_jabatan" id="jabatan" required>
                        <option selected disabled>Pilih jabatan</option>
                        @foreach($jabatan as $jabatan)
                        <option value="{{$jabatan['id_jabatan']}}">{{$jabatan['nama']}}</option>
                        @endforeach
                    </select>

                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" required>

                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</main>

@endsection