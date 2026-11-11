<?php

declare(strict_types=1);

class Socio
{
    private const int MAX_PRESTAMOS = 3;
    private static int $totalSocios = 0;
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
}
