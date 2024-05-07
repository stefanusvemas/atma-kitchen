@extends('owner/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4 bg-light rounded-3 p-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('owner/karyawan')}}">Karyawan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
            <h4>Edit Karyawan</h4>
            @if(session('error'))
            <div class="alert alert-danger" role="alert">
                {{session('error')->first()}}
            </div>
            @endif

            <form action="{{url('owner/karyawan/edit/'.$karyawan['id_karyawan'])}}" method="post" class="p-3">
                @csrf
                <div class="mb-2">
                    <label for="gaji" class="form-label">Gaji</label>
                    <input type="number" class="form-control" name="gaji" id="gaji" value="{{$karyawan['gaji']}}">

                    <label for="bonus" class="form-label">Bonus</label>
                    <input type="number" class="form-control" name="bonus" id="bonus" value="{{$karyawan['bonus']}}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</main>

@endsection