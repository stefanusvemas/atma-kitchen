@extends('manager/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4">
            <h3>Catatan Pemakaian Bahan Baku</h3>

            @if(session('success'))
            <div class="alert alert-success mt-3" role="alert">
                {{session('success')}}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger mt-3" role="alert">
                {{session('error')}}
            </div>
            @endif

            <table class="table table-responsive mt-3">
                <thead>
                    <tr>
                        <th scope="col" class="w-50">Tanggal</th>
                        <th scope="col">Nama Bahan</th>
                        <th scope="col">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $d)
                    <tr>
                        <td>{{$d['tgl_pemakaian']}}</td>
                        <td scope="row">{{$d['bahan_baku']['nama']}}</td>
                        <td>{{$d['jumlah']}}</td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="5" class="text-center">No data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

@endsection