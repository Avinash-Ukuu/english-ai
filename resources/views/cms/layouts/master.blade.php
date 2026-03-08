<!DOCTYPE html>
<html>

<head>
    <title>English AI Coach</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fb;
        }

        .sidebar {
            height: 100vh;
            background: #1e293b;
            color: white;
        }

        .sidebar a {
            color: white;
            display: block;
            padding: 12px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background: #334155;
        }

        .card {
            border-radius: 12px;
        }

        .chat-box {
            height: 400px;
            overflow-y: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
        }
    </style>

</head>

<body>

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-2 sidebar">

                <h4 class="p-3">English AI</h4>

                <a href="{{ route('cms.dashboard') }}">Dashboard</a>
                <a href="{{ route('cms.chat') }}">AI Chat</a>
                <a href="{{ route('cms.reading') }}">Reading</a>
                <a href="{{ route('cms.listening') }}">Listening</a>
                <a href="{{ route('cms.speaking') }}">Speaking</a>
                <a href="{{ route('cms.progress') }}">Progress</a>
                <form method="POST" action="{{ route('logout') }}" class="mt-3">
                    @csrf
                    <button type="submit" style="background:none;border:none;padding:0;color:#0d6efd;text-align:left;">
                        Logout
                    </button>
                </form>
            </div>

            <div class="col-md-10 p-4">

                @yield('content')

            </div>

        </div>

    </div>

</body>

</html>
