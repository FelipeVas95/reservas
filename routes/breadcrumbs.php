<?php 

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

//Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('home', route('home'));
});

//Gestion salas
Breadcrumbs::for('workspaces', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Workspaces', route('booking.index'));
});

//crear reservas
Breadcrumbs::for('create_booking', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Create Booking', route('booking.create'));
});

//gestironar reservas
Breadcrumbs::for('booking', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Booking', route('booking.create'));
});


?>