<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlobalSoft</title>

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Google Font for Custom Font Style -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- Custom CSS file -->
    <link rel="stylesheet" href="{{ asset('css/import.css') }}">

    <!-- font awesome cdn -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>

<body style="background-color:white">
    <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ route('profile') }}">
            Mail Maestro
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Mail
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('email') }}">Email Form</a>
                        <a class="dropdown-item" href="{{ route('email_dashboard') }}">Email Dashboard</a>
                    </div>
                </li>
                @auth
                    @if (auth()->user()->name === 'ADM')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('sign_up') }}" title="Sign Up">
                                Sign Up
                            </a>
                        </li>
                    @endif
                @endauth

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pw_change') }}" title="Pw change">
                        Password Change
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" title="Log out">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="card" style=" margin:5vh 0 0 5vw; width:90vw">
        <h5 class="card-header">{{ Auth::user()->username }}</h5>
        <div class="card-body">
            <h5 class="card-title">Username</h5>
            <p class="card-text">{{ Auth::user()->name }}</p>
            <h5 class="card-title">Email</h5>
            <p class="card-text">{{ Auth::user()->email }}</p>
            <h5 class="card-title">Phone</h5>
            <p class="card-text">{{ Auth::user()->cellno }}</p>
            <h5 class="card-title">Updated At</h5>
            <p class="card-text">{{ Auth::user()->updated_at }}</p>
            <h5 class="card-title">Created At</h5>
            <p class="card-text">{{ Auth::user()->created_at }}</p>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>
