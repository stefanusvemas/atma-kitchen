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

            <form action="" class="p-3">
                <div class="mb-2">
                    <label for="gaji" class="form-label">Gaji</label>
                    <input type="number" class="form-control" name="gaji" id="gaji" value="100000">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</main>

@endsection