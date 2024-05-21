@extends('index')
@section('content')

<main class="col-md">
    <div class="content">
        <div class="container mt-4 bg-light rounded-3 p-4">
            <h4>Add Address</h4>
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ url('user/address/input') }}" method="post" class="p-2">
                @csrf
                <div class="mb-2">
                    <label for="nama_jalan" class="form-label">Nama Jalan</label>
                    <input type="text" class="form-control" name="nama_jalan" id="nama_jalan" required>

                    <label for="kecamatan" class="form-label">Kecamatan</label>
                    <input type="text" class="form-control" name="kecamatan" id="kecamatan" required>

                    <label for="kelurahan" class="form-label">Kelurahan</label>
                    <input type="text" class="form-control" name="kelurahan" id="kelurahan" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</main>

@endsection
