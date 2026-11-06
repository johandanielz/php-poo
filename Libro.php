<?php

    declare(strict_types=1);

    class Libro 
    {
        public function __construct(
            public string $titulo,
            public string $isbn,
            public int $anio,
            public bool $disponible = true
        ){}

        public function descripcion(): string
        {
            return $this->titulo . " (" . $this->anio . ")";
        }
    }
