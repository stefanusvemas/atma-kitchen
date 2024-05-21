@extends('index')
@section('content')

<main class="col-md">
    <div class="content">
        <div class="container mt-4 bg-light rounded-3 p-4">
            <h4>Your Existing Address</h4>
            @if($addresses->isEmpty())
                <p>Belum menginput alamat.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nama Jalan</th>
                            <th scope="col">Kecamatan</th>
                            <th scope="col">Kelurahan</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($addresses as $address)
                            <tr>
                                <td>{{ $address->nama_jalan }}</td>
                                <td>{{ $address->kecamatan }}</td>
                                <td>{{ $address->kelurahan }}</td>
                                <td>
                                    <a href="{{ url('/user/address/edit/'.$address['id_alamat'])}}" class="btn btn-primary">Edit</a>
                                    <a href="{{url('/user/address/delete/'.$address['id_alamat'])}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
            <a href="{{ url('/user/address/input') }}" class="btn btn-primary">Input Address</a>
        </div>
    </div>
</main>

@endsection
