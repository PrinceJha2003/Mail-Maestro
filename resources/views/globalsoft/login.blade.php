<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>


    <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ route('profile') }}">
            Mail Maestro
        </a>
        </div>
    </nav>
    <div class="main">
        <div class="login-container">
            <h2>Sign in</h2>
            <center>Start Your Session</center><br>
            <form action="{{ route('AccountAuthenticate') }}" method="POST">
                @csrf
                <input class="loginInput {{ $errors->first('username') ? 'invalid' : '' }}" type="text"
                    id="username" name="username" placeholder="Username">
                @error('username')
                    <p class="invalid-feedback-msg">{{ $message }}</p>
                @enderror
                <input class="loginInput {{ $errors->first('password') ? 'invalid' : '' }}" type="password"
                    id="password" name="password" placeholder="Password">
                @error('password')
                    <p class="invalid-feedback-msg">{{ $message }}</p>
                @enderror
                <!-- <div class="role">
                <div>
                    <input type="radio" id="admin" name="role" value="admin" checked>
                    <label for="admin">Admin</label>
                </div>
                <div style="margin-left: 10px;">
                    <input type="radio" id="users" name="role" value="users">
                    <label for="users">Users</label>
                </div>
            </div> -->

                <!-- <div class="remember-me">
                <input type="checkbox" id="remember" name="remember" checked>
                <label for="remember">Remember Me</label>
            </div> -->

                <div class="buttons">
                    <button type="submit">Login</button>
                    <!-- <button type="reset">Reset</button> -->
                </div>
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
