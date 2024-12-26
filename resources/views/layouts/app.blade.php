<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Reserva de Espacios')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/night_mode.css') }}">
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Barra de navegación -->
    @include('layouts.header')
    <!-- Contenido -->
    <main class="flex-grow-1">
        @include('layouts.sidebar')
        
    </main>
    <!-- Pie de página -->
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    @include('layouts.footer')
</body>
<script>
    const toggleDarkMode = document.getElementById('toggle-dark-mode');
const body = document.body;
const card = document.card;

// Comprobar si el modo nocturno está activado
if (localStorage.getItem('darkMode') === 'enabled') {
    body.classList.add('dark-mode');
}

toggleDarkMode.addEventListener('click', () => {
    body.classList.toggle('dark-mode');
    card.classList.toggle('dark-mode');
    if (body.classList.contains('dark-mode')) {
        localStorage.setItem('darkMode', 'enabled');
    } else {
        localStorage.setItem('darkMode', 'disabled');
    }
});</script>
</html>
