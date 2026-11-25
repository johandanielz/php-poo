<?php

declare(strict_types=1);
require_once __DIR__ . '/Material.php';

class DVD extends Material
{
    /**
     * Crea un DVD
     *
     * @throws \InvalidArgumentException si el año del DVD es mayor al actual o si su duración es menor a 5 minutos
     */
    public function __construct(
        string $titulo,
        private readonly int $duracionMinutos,
        int $anio
    ) {
        parent::__construct($titulo, $anio);
        $this->validarDuracion($this->duracionMinutos);
    }

    public function getDuracionMinutos(): int
    {
        return $this->duracionMinutos;
    }

    public function diasPrestamo(): int
    {
        return 3;
    }

    /**
     * Valida que la duración ingresada no sea menor que 5 minutos
     *
     * @throws \InvalidArgumentException si el número ingresado es menor a 5 minutos
     */
    private function validarDuracion(int $duracionIngresada): void
    {
        if ($duracionIngresada < 5) {
            throw new \InvalidArgumentException(
                "La duración de '{$this->getTitulo()}' no puede ser menor a cinco minutos"
            );
        }
    }
}
