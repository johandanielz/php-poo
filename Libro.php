<?php

declare(strict_types=1);

class Libro
{
    private bool $disponible = true;

    /**
     * Crea un libro
     *
     * @throws \InvalidArgumentException si el año del libro es mayor al actual
     */
    public function __construct(
        private string $titulo,
        private readonly string $isbn,
        private int $anio
    ) {
        $this->validarAnio($this->anio);
    }

    public function descripcion(): string
    {
        return $this->titulo . " (" . $this->anio . ")";
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function getAnio(): int
    {
        return $this->anio;
    }

    public function isDisponible(): bool
    {
        return $this->disponible;
    }

    /**
     * Presta el libro
     *
     * @throws \LogicException si el libro ya está prestado
     */
    public function prestar(): void
    {
        if (!$this->disponible) {
            throw new \LogicException("El libro '{$this->titulo}' ya se encuentra prestado.");
        }

        $this->disponible = false;
    }

    /**
     * Marca el libro como disponible
     *
     * @throws \LogicException si el libro no se ha prestado
     */
    public function devolver(): void
    {
        if ($this->disponible) {
            throw new \LogicException("El libro '{$this->titulo}' no se ha prestado.");
        }

        $this->disponible = true;
    }

    /**
     * Valida que el año ingresado no sea mayor al año actual
     *
     * @throws \InvalidArgumentException si el año ingresado es mayor al año actual
     */
    private function validarAnio(int $anioIngresado): void
    {
        $anioActual = (int) date('Y');

        if ($anioIngresado > $anioActual) {
            throw new \InvalidArgumentException(
                "El año de publicación de '{$this->titulo}' no puede ser mayor al año actual"
            );
        }
    }
}
