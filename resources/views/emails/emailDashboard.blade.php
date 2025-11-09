<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Email Dashboard</title>

    <!-- Bootstrap & FontAwesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #f8fafc;
            font-family: 'Segoe UI', sans-serif;
        }

        .navbar {
            background-color: #333a40;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.4rem;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            margin-top: 2rem;
        }

        .card-header {
            background: linear-gradient(135deg, #1f2937, #4b5563);
            color: white;
            border-radius: 12px 12px 0 0;
            padding: 1rem 1.5rem;
        }

        table {
            background-color: white;
        }

        th, td {
            vertical-align: middle !important;
            white-space: nowrap;
        }

        .table thead {
            background-color: #f1f5f9;
        }

        .truncate {
            max-width: 180px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .badge-status {
            padding: 0.4em 0.7em;
            font-size: 0.75rem;
            border-radius: 0.5rem;
        }

        .badge-active {
            background-color: #10b981;
            color: white;
        }

        .badge-inactive {
            background-color: #ef4444;
            color: white;
        }

        .btn-action {
            font-size: 0.85rem;
            padding: 5px 10px;
            margin: 2px;
            border-radius: 5px;
        }

        .pagination a {
            margin: 0 4px;
        }

        .alert {
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="{{ route('profile') }}">Mail Maestro</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-toggle="dropdown">
                        Mail
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('email') }}">Email Form</a>
                        <a class="dropdown-item" href="{{ route('email_dashboard') }}">Email Dashboard</a>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" title="Log out">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Email Dashboard</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th>S No.</th>
                            <th>Mail To</th>
                            <th>Exe Time</th>
                            <th>Recc Days</th>
                            <th>Recc End</th>
                            <th>Repetition</th>
                            <th>CC</th>
                            <th>BCC</th>
                            <th>Status</th>
                            <th>Message</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $currentPage = $emails->currentPage();
                            $perPage = $emails->perPage();
                            $startIndex = ($currentPage - 1) * $perPage;
                        @endphp
                        @foreach ($emails as $index => $email)
                            <tr>
                                <td>{{ $startIndex + $index + 1 }}</td>
                                <td title="{{ $email->mail_to }}">
                                    {{ \Illuminate\Support\Str::limit($email->mail_to, 20, '...') }}
                                </td>
                                <td>{{ $email->execution_time }}</td>
                                <td>{{ $email->recurring_days }}</td>
                                <td>{{ $email->recurring_end }}</td>
                                <td>{{ $email->repetition }}</td>
                                <td>{{ $email->cc }}</td>
                                <td>{{ $email->bcc }}</td>
                                <td>
                                    <span class="badge badge-status {{ $email->status == 'active' ? 'badge-active' : 'badge-inactive' }}">
                                        {{ ucfirst($email->status) }}
                                    </span>
                                </td>
                                <td class="truncate" title="{{ $email->message }}">
                                    {{ \Illuminate\Support\Str::limit($email->message, 20) }}
                                </td>
                                <td>
                                    <a href="{{ route('email_edit', $email->id) }}"
                                        class="btn btn-sm btn-outline-primary btn-action">Edit</a>
                                    <a href="{{ route('email_delete', $email->id) }}"
                                        onclick="return confirm('Are you sure?')"
                                        class="btn btn-sm btn-outline-danger btn-action">Delete</a>
                                    <a href="{{ route('email_stop', $email->id) }}"
                                        class="btn btn-sm btn-outline-warning btn-action">Stop</a>
                                    <a href="{{ route('email_start', $email->id) }}"
                                        class="btn btn-sm btn-outline-success btn-action">Start</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $emails->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
