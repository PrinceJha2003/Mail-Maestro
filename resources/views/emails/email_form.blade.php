<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Form</title>

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Google Font for Custom Font Style -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- Custom CSS file -->
    <link rel="stylesheet" href="{{ asset('css/import.css') }}">

    <!-- font awesome cdn -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"></head>

<body>
    <nav class="navbar navbar-expand-lg  navbar-dark">
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
    <div class="container">
        <h2 class="form-header">{{ $title }}</h2>
        <form action="{{ $url }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <!-- Mail From -->
                <div class="col-sm-3 form-group">
                    <label for="mail_from" class="form-label">Mail From</label>
                    <input type="text" class="form-control @error('mail_from') is-invalid @enderror" id="mail_from"
                        name="mail_from" placeholder="Sender Email" value="{{ Auth::user()->email }}" readonly>
                    @error('mail_from')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Mail To -->
                <div class="col-sm-3 form-group">
                    <label for="mail_to" class="form-label">Mail To</label>
                    <input type="text" class="form-control @error('mail_to') is-invalid @enderror" id="mail_to"
                        name="mail_to" placeholder="Recipient's Email" value="{{ $row->mail_to ?? old('mail_to') }}">
                    @error('mail_to')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Execution Time -->
                <div class="col-sm-3 form-group">
                    <label for="execution_time" class="form-label">Execution Time</label>
                    <input type="datetime-local" class="form-control @error('execution_time') is-invalid @enderror"
                        id="execution_time" name="execution_time"
                        value="{{ $row->execution_time ?? old('execution_time') }}">
                    @error('execution_time')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Recurring Days -->
                <div class="col-sm-3 form-group">
                    <label for="recurring_days" class="form-label">Recurring Days</label>
                    <input type="number" class="form-control @error('recurring_days') is-invalid @enderror"
                        id="recurring_days" name="recurring_days" placeholder="Number of Days"
                        value="{{ $row->recurring_days ?? old('recurring_days') }}">
                    @error('recurring_days')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Recurring End -->
                <div class="col-sm-3 form-group">
                    <label for="recurring_end" class="form-label">Recurring End</label>
                    <input type="number" class="form-control @error('recurring_end') is-invalid @enderror"
                        id="recurring_end" name="recurring_end" placeholder="Recurring End"
                        value="{{ $row->recurring_end ?? old('recurring_end') }}">
                    @error('recurring_end')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <!-- Repetition -->
                <div class="col-sm-3 form-group">
                    <label for="repetition" class="form-label">Repetition</label>
                    <select class="form-control @error('repetition') is-invalid @enderror" id="repetition"
                        name="repetition">
                        <option value="" {{ old('repetition') === null ? 'selected' : '' }}>Select Repetition
                        </option> <!-- Default option -->
                        <option value="1" {{ old('repetition') == '1' ? 'selected' : '' }}>Infinite</option>
                    </select>
                    @error('repetition')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- CC -->
                <div class="col-sm-3 form-group">
                    <label for="cc" class="form-label">CC</label>
                    <input type="text" class="form-control @error('cc') is-invalid @enderror" id="cc"
                        name="cc" placeholder="CC Email Address"
                        value="{{ $row->cc ?? old('cc') }}">
                    @error('cc')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- BCC -->
                <div class="col-sm-3 form-group">
                    <label for="bcc" class="form-label">BCC</label>
                    <input type="text" class="form-control @error('bcc') is-invalid @enderror" id="bcc"
                        name="bcc" placeholder="BCC Email Address"
                        value="{{ $row->bcc ?? old('bcc') }}">
                    @error('bcc')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Attachment -->
                <div class="col-sm-3 form-group">
                    <label for="attachment" class="form-label">Attachment</label>
                    <input type="file" class="form-control @error('attachment') is-invalid @enderror"
                        id="attachment" name="attachment"
                        value="{{ $row->attachment ?? old('attachment') }}">
                    @error('attachment')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">

                <!-- Message -->
                <div class="col-sm-3 form-group">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="3"
                        placeholder="Enter your message">{{ $row->message ?? old('message') }}</textarea>
                    @error('message')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="col-12">
                <button type="submit" class="btn btn-primary"
                    style="background-color:#343A40; border:none;">Submit</button>
            </div>
        </form>
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
