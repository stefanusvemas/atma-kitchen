@extends('manager/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4 bg-light rounded-3 p-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('manager/pengeluaran_lain')}}">Pengeluaran Lain</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
            <h4>Edit Pengeluaran Lain</h4>

            <form action="{{url('manager/pengeluaran_lain/edit/'.$pengeluaran_lain['id_pengeluaran'])}}" method="post" class="p-3">
                @csrf
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" id="deskripsi">{{$pengeluaran_lain['deskripsi']}}</textarea>
                </div>

                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah Pengeluaran</label>
                    <input type="number" class="form-control" name="jumlah" id="jumlah" value="{{$pengeluaran_lain['jumlah_pengeluaran']}}">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</main>

@endsection