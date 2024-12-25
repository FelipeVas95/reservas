<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Reserva de Espacios')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Barra de navegación -->
    @include('layouts.header')
    <!-- Contenido -->
    <main class="flex-grow-1">
        <div class="my-4">
            @yield('content')
        </div>
    </main>
    <!-- Pie de página -->
    @include('layouts.sidebar')
    @include('layouts.breadcrumb')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    @include('layouts.footer')
</body>
</html>
