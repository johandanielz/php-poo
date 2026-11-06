<?php

    declare(strict_types=1);
    require_once __DIR__ . '/Libro.php';

    $libro_uno = new Libro(
        titulo: "Cien años de soledad",
        isbn: "978-84",
        anio: 1967
    );

    $libro_dos = new Libro(
        titulo: "El quijote",
        isbn: "978-85",
        anio: 1605
    );

    echo $libro_uno->descripcion() . PHP_EOL;
    echo $libro_dos->descripcion() . PHP_EOL;

    $libro_uno->anio = "1967";

?>