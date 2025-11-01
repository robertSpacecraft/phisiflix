<?php
    declare(strict_types=1);
    const LETRAS_DNI = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E'];
    function calcularLetraDNI(int $dni):string {
        return LETRAS_DNI[$dni%23];
    }
