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

require_once __DIR__ . '/Socio.php';

$ana = new Socio("Ana", "1001");

$libros = [
    new Libro("Rayuela", "978-90", 1963),
    new Libro("Ficciones", "978-91", 1944),
    new Libro("El Aleph", "978-92", 1949),
    new Libro("Pedro Páramo", "978-93", 1955),
];

try {
    foreach ($libros as $libro) {
        $ana->prestarLibro($libro);
        echo "Prestado: " . $libro->getTitulo() . PHP_EOL;
    }
} catch (LogicException $e) {
    echo $e->getMessage() . PHP_EOL;
}

$luis = new Socio("Luis", "1002");
try {
    $luis->prestarLibro($libros[0]);
} catch (LogicException $e) {
    echo $e->getMessage() . PHP_EOL;
}

echo $libros[3]->isDisponible() ? "Disponible" . PHP_EOL : "Prestado" . PHP_EOL;

echo "Socios registrados: " . Socio::getTotalSocios() . PHP_EOL;