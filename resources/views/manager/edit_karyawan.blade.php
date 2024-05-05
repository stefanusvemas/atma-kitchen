@extends('manager/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4 bg-light rounded-3 p-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('manager/karyawan')}}">Karyawan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
            <h4>Edit Karyawan</h4>
            @if(session('error'))
            <div class="alert alert-danger" role="alert">
                {{session('error')->first()}}
            </div>
            @endif

            <form action="{{url('manager/karyawan/edit/'.$karyawan['id_karyawan'])}}" method="post" class="p-3">
                @csrf
                <div class="mb-2">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" id="nama" value="{{$karyawan['nama']}}">

                    <label for="jabatan" class="form-label">Jabatan</label>
                    <select class="form-select" name="id_jabatan" id="jabatan">
                        <option selected value="{{$karyawan['jabatan']['id_jabatan']}}" hidden>{{$karyawan['jabatan']['nama']}}</option>
                        @foreach($jabatan as $jabatan)
                        <option value="{{$jabatan['id_jabatan']}}">{{$jabatan['nama']}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</main>

@endsection