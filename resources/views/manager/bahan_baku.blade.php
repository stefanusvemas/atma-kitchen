@extends('manager/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4">
            <h3>Bahan Baku</h3>

            <div class="row justify-content-between">
                <div class="col">

                </div>
                <div class="col col-lg-3 mt-md-0 mt-3 col-auto">
                    <form action="{{url('manager/bahan_baku/search')}}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Cari bahan baku...">
                            <button class="btn btn-outline-primary" type="submit">Cari</button>
                        </div>
                    </form>

                </div>
            </div>


            <table class="table table-responsive mt-3">
                <thead>
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bahan_baku as $bahan_baku)
                    <tr>
                        <td scope="row">{{$bahan_baku['nama']}}</td>
                        <td>{{$bahan_baku['stok']}}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="text-center">No data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

@endsection