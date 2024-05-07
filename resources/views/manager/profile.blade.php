@extends('manager/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4 bg-light rounded-3 p-4">
            <h4>Profile</h4>
            <div class="mt-3">
                <h5>Stefanus Vemas</h5>
                <p>Manager</p>
                <hr>
                <h5>Change Email & Password</h5>
            </div>
            <form action="" class="p-2">
                <div class="mb-2">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email">

                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</main>

@endsection