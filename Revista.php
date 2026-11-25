<?php

declare(strict_types=1);
require_once __DIR__ . '/Material.php';

class Revista extends Material
{
    /**
     * Crea una revista
     *
     * @throws \InvalidArgumentException si el año de la revista es mayor al actual o si el número de edición es menor a 1
     */
    public function __construct(
        string $titulo,
        private readonly int $numeroEdicion,
        int $anio
    ) {
        parent::__construct($titulo, $anio);
        $this->validarNumeroEdicion($this->numeroEdicion);
    }

    public function getNumeroEdicion(): int
    {
        return $this->numeroEdicion;
    }

    public function diasPrestamo(): int
    {
        return 5;
    }

    /**
     * Valida que el número de edición ingresado no sea menor que 1
     *
     * @throws \InvalidArgumentException si el número ingresado es menor a 1
     */
    private function validarNumeroEdicion(int $numeroEdicionIngresado): void
    {
        if ($numeroEdicionIngresado < 1) {
            throw new \InvalidArgumentException(
                "El número de edición de '{$this->getTitulo()}' no puede ser menor a uno"
            );
        }
    }
}
