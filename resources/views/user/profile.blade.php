@extends('index')
@section('content')

<main class="col-md">
    <div class="content">
        <div class="container mt-4 bg-light rounded-3 p-4">
            <h4>Profile</h4>
            <div class="mt-4">
                <div class="row">
                    <div class="col col-auto">
                        <h5>Nama User</h5>
                    </div>
                    <div class="col">
                        <p>80 <i class="fa fa-coins"></i></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p><i class="fa fa-cake-candles"></i> 2003/08/12</p>
                        <p><i class="fa fa-phone"></i> 08121213242</p>
                    </div>

                </div>


                <a href="{{url('user/profile/edit')}}" class="text-decoration-none">Edit Profile</a>
                <hr>
                <h5>Change Email & Password</h5>
            </div>
            <form action="" class="p-2">
                <div class="mb-2">
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