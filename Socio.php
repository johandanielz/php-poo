<?php

declare(strict_types=1);

class Socio
{
    private const int MAX_PRESTAMOS = 3;
    private static int $totalSocios = 0;
    /** @var Libro[] */
    private array $librosPrestados = [];

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
     * Presta un libro a un socio
     *
     * @throws \LogicException si alcanzó el límite de préstamos o si el libro ya está prestado
     */
    public function prestarLibro(Libro $libro): void
    {
        if (count($this->librosPrestados) >= self::MAX_PRESTAMOS) {
            throw new \LogicException(
                "El socio '{$this->nombre}' alcanzó el límite de " . self::MAX_PRESTAMOS . " préstamos"
            );
        }

        $libro->prestar();

        $this->librosPrestados[] = $libro;
    }
}
