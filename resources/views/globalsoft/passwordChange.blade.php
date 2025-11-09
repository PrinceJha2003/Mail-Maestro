<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sign Up</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .pw_change_form {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 80vh;
            margin-top: 5vh;
        }

        .signup-container {
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .login-link {
            text-align: center;
            margin-top: 10px;
        }

        .login-link a {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>

<body>
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
    <div class="pw_change_form">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="signup-container">
            <h2>Update Password</h2>
            <form action="{{ route('pw_change_process') }}" method="POST">
                @csrf
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="prv_password" placeholder="Previous Password" required>
                <input type="password" name="new_password" placeholder="New Password" required>
                <button type="submit">Update</button>
            </form>
        </div>
        
    </div>
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
