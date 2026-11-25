<?php

declare(strict_types=1);
require_once __DIR__ . '/Material.php';

class Libro extends Material
{
    /**
     * Crea un libro
     *
     * @throws \InvalidArgumentException si el año del libro es mayor al actual
     */
    public function __construct(
        string $titulo,
        private readonly string $isbn,
        int $anio
    ) {
        parent::__construct($titulo, $anio);
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function diasPrestamo(): int
    {
        return 7;
    }

}
