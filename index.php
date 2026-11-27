<?php

declare(strict_types=1);
require_once __DIR__ . '/Libro.php';
require_once __DIR__ . '/Socio.php';
require_once __DIR__ . '/Revista.php';
require_once __DIR__ . '/DVD.php';

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

try {
    $libroUno->prestar();
} catch (LogicException $e) {
    echo $e->getMessage() . PHP_EOL;
}

echo ($libroUno->isDisponible() ? "Disponible" : "Prestado") . PHP_EOL;

try {
    $libroUno->prestar();
} catch (LogicException $e) {
    echo $e->getMessage() . PHP_EOL;
}

echo ($libroUno->isDisponible() ? "Disponible" : "Prestado") . PHP_EOL;

try {
    $libroUno->devolver();
} catch (LogicException $e) {
    echo $e->getMessage() . PHP_EOL;
}

echo ($libroUno->isDisponible() ? "Disponible" : "Prestado") . PHP_EOL;

try {
    $libroDos->devolver();
} catch (LogicException $e) {
    echo $e->getMessage() . PHP_EOL;
}

echo ($libroDos->isDisponible() ? "Disponible" : "Prestado") . PHP_EOL;

try {
    $libroTres = new Libro(
        titulo: "La María",
        isbn: "978-86",
        anio: 2027
    );
} catch (InvalidArgumentException $e) {
    echo $e->getMessage() . PHP_EOL;
}

$ana = new Socio("Ana", "1001");

$libros = [
    new Libro("Rayuela", "978-90", 1963),
    new Libro("Ficciones", "978-91", 1944),
    new Libro("El Aleph", "978-92", 1949),
    new Libro("Pedro Páramo", "978-93", 1955),
];

try {
    foreach ($libros as $libro) {
        $ana->prestarMaterial($libro);
        echo "Prestado: " . $libro->getTitulo() . PHP_EOL;
    }
} catch (LogicException $e) {
    echo $e->getMessage() . PHP_EOL;
}

$luis = new Socio("Luis", "1002");
try {
    $luis->prestarMaterial($libros[0]);
} catch (LogicException $e) {
    echo $e->getMessage() . PHP_EOL;
}

echo ($libros[3]->isDisponible() ? "Disponible" : "Prestado") . PHP_EOL;

echo "Socios registrados: " . Socio::getTotalSocios() . PHP_EOL;

try {
    $revistaUno = new Revista("Enter.com", 0, 2025);
} catch (InvalidArgumentException $e) {
    echo $e->getMessage() . PHP_EOL;
}

try {
    $revistaDos = new Revista("Vea", 1, 2025);
    echo $revistaDos->descripcion() . " - edición " . $revistaDos->getNumeroEdicion() . PHP_EOL;
} catch (InvalidArgumentException $e) {
    echo $e->getMessage() . PHP_EOL;
}

try {
    $dvdUno = new DVD("Un verano sin ti", 4, 2023);
} catch (InvalidArgumentException $e) {
    echo $e->getMessage() . PHP_EOL;
}

try {
    $dvdDos = new DVD("X 100 Pre", 65, 2019);
    echo $dvdDos->descripcion() . " - " . $dvdDos->getDuracionMinutos() . " min" . PHP_EOL;
} catch (InvalidArgumentException $e) {
    echo $e->getMessage() . PHP_EOL;
}

$alexa = new Socio("Alexa", "1003");
$revista = new Revista("Vea", 2, 2026);
$dvd = new DVD("NSLQVAPM", 80, 2023);
try {
    $alexa->prestarMaterial($revista);
    echo $revista->descripcion() . " - edición    " . $revista->getNumeroEdicion() . PHP_EOL;
    $alexa->prestarMaterial($dvd);
    echo $dvd->descripcion() . " - " . $dvd->getDuracionMinutos() . " min" . PHP_EOL;
} catch (LogicException $e) {
    echo $e->getMessage() . PHP_EOL;
}

$libroCuatro = new Libro("Hábitos atómicos", "978-94", 2018);

$materiales = [$libroCuatro, $revista, $dvd];
foreach ($materiales as $material) {
    echo $material->descripcion() . " - " . $material->diasPrestamo() . " días " . PHP_EOL;
}