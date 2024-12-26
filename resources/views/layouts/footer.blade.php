<footer style="height: 65px"
    class="d-flex flex-wrap justify-content-between bg-primary text-white align-items-center py-3 px-4">
    <div class="col-md-4 d-flex align-items-center">
        <a href="/" class="mb-3 me-2 mb-md-0 text-white text-decoration-none lh-1">
            <i class="fas fa-torii-gate"></i>
        </a>
        <span class="mb-3 mb-md-0 text-white">{{ config('app.name') }} &copy; {{ date('Y') }} . Todos los derechos
            reservados.</span>
    </div>
    <p>
        <a href="{{ url('/politicas') }}" class="text-white">Políticas de privacidad</a> |
        <a href="{{ url('/contacto') }}" class="text-white">Contacto</a>
    </p>
    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex text-white">
        <li class="ms-3"><a class="text-white" href="#"><i class="fab fa-instagram"></i></a></li>
        <li class="ms-3"><a class="text-white" href="#"><i class="fa-brands fa-twitter"></i></a></li>
        <li class="ms-3"><a class="text-white" href="#"><i class="fa-brands fa-facebook"></i></a></li>
    </ul>
</footer>
