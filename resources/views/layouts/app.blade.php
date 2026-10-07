<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'SIM Mahasiswa')
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background: #f5f7fb;
        }

        .sidebar {
            min-height: 100vh;
            background: #0d47a1;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 5px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: rgba(255, 255, 255, .15);
        }

        .stat-card {
            border: none;
            border-radius: 15px;
        }

        .card {
            border: none;
            border-radius: 15px;
        }
    </style>

    @stack('styles')
</head>

<body>

<div class="container-fluid">

    <div class="row">

        {{-- SIDEBAR --}}
        <aside class="col-md-3 col-lg-2 sidebar p-3">

            <h4 class="text-white fw-bold mb-4">
                <i class="bi bi-mortarboard"></i>
                SIM Mahasiswa
            </h4>

            <a href="{{ route('dashboard') }}">
                <i class="bi bi-speedometer2 me-2"></i>
                Dashboard
            </a>

            <a href="{{ route('mahasiswa.index') }}">
                <i class="bi bi-people me-2"></i>
                Data Mahasiswa
            </a>

            <a href="{{ route('prodi.index') }}">
                <i class="bi bi-building me-2"></i>
                Program Studi
            </a>

            <hr class="text-white">

            <form
                action="{{ route('logout') }}"
                method="POST"
            >
                @csrf

                <button
                    class="btn btn-link text-white text-decoration-none"
                    type="submit"
                >
                    <i class="bi bi-box-arrow-right me-2"></i>
                    Logout
                </button>
            </form>

        </aside>

        {{-- CONTENT --}}
        <main class="col-md-9 col-lg-10 p-4">

            {{-- ALERT SUCCESS --}}
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            {{-- ALERT ERROR --}}
            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')

        </main>

    </div>

</div>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

@stack('scripts')

</body>

</html>