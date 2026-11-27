<?php

declare(strict_types=1);

class Socio
{
    private const int MAX_PRESTAMOS = 3;
    private static int $totalSocios = 0;
    /** @var Material[] */
    private array $materialesPrestados = [];

    public function __construct(
        private string $nombre,
        private readonly string $documento
    ) {
        self::$totalSocios++;
    }

    public static function getTotalSocios(): int
    {
        return self::$totalSocios;
    }

    /**
     * Presta un material a un socio
     *
     * @throws \LogicException si alcanzó el límite de préstamos o si el material ya está prestado
     */
    public function prestarMaterial(Material $material): void
    {
        if (count($this->materialesPrestados) >= self::MAX_PRESTAMOS) {
            throw new \LogicException(
                "El socio '{$this->nombre}' alcanzó el límite de " . self::MAX_PRESTAMOS . " préstamos"
            );
        }

        $material->prestar();

        $this->materialesPrestados[] = $material;
    }
}
