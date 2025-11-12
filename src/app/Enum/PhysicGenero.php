<?php

namespace App\Enum;

enum PhysicGenero
{
    case MASCULINO;
    case FEMENINO;
    case NO_APLICA;
    case NOT_DEFINED;

    public static function createFromString(string $type): PhysicGenero{
        return match(strtolower($type)){
            'masculino'=>PhysicGenero::MASCULINO,
            'femenino'=>PhysicGenero::FEMENINO,
            'no-aplica'=>PhysicGenero::NOT_DEFINED,
            'not-defined'=>PhysicGenero::NO_APLICA,
        };
    }
}
