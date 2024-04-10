<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atma Kitchen</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Playfair+Display:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="d-flex flex-column min-vh-100" style="background-color: #F0F0F0;">
    <header>
        <nav class="navbar mx-auto navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <h3>Atma Kitchen</h3>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" aria-current="page" href="{{url('/')}}">Home</a>
                        <div class="d-flex d-none">
                            <a class="nav-link" href="{{url('/cart')}}"><i class="fa fa-cart-shopping"></i>
                                <span class="position-absolute top-10 start-10 translate-middle badge rounded-pill bg-danger">
                                    2
                                    <span class="visually-hidden">unread items</span>
                                </span>
                            </a>
                        </div>
                        <div class="d-flex">
                            <div class="d-lg-none d-block">
                                <a class="nav-link me-2 {{ Request::is('login') ? 'active' : '' }}" href="{{url('/login')}}">Log In</a>
                                <a class="nav-link {{ Request::is('register') ? 'active' : '' }}" href="{{url('/register')}}">Sign Up</a>
                            </div>
                            <div class="btn-group d-none d-lg-flex">
                                <a href="{{url('/login')}}" class="btn btn-secondary dropdown-toggle" id="dropdownMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Login</a>
                                <ul class="dropdown-menu dropdown-menu-end" style="width: 400px;" aria-labelledby="dropdownMenu">
                                    <form class="px-4 py-3">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" placeholder="email@example.com">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" placeholder="Password">
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-2">Sign in</button>
                                    </form>
                                    <div class="dropdown-divider"></div>
                                    <li><a class="dropdown-item" href="{{url('/register')}}">Don't have an account? Sign up</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </nav>
    </header>

    @yield('content')

    <footer class="mt-auto">
        <nav class="navbar justify-content-between mt-4 bg-dark">
            <div class="container" style="height: 40px;">
                <p class="text-light">© Atma Kitchen</p>
            </div>
        </nav>
    </footer>
    <script src="https://kit.fontawesome.com/098cbe1db3.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>