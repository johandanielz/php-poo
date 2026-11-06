<?php

declare(strict_types=1);
require_once __DIR__ . '/Libro.php';

$libroUno = new Libro(
    titulo: "Cien años de soledad",
    isbn: "978-84",
    anio: 1967
);

$libroDos = new Libro(
    titulo: "El quijote",
    isbn: "978-85",
    anio: 1605
);

echo $libroUno->descripcion() . PHP_EOL;
echo $libroDos->descripcion() . PHP_EOL;
