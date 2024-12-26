<?php
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('home', function ($trail) {
$trail->push('Inicio', route('home'));
});

Breadcrumbs::for('products.index', function ($trail) {
$trail->parent('home');
$trail->push('Productos', route('products.index'));
});

Breadcrumbs::for('product.show', function ($trail, $product) {
$trail->parent('products.index');
$trail->push($product->name, route('product.show', $product));
});



?>