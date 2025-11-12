<?php

namespace App\Enum;

enum PhysicType
{
    case PERSONA; //Descubierto por una persona
    case INSTITUCION; //Descubierto por una universidad, academia o laboratorio
    case INSTRUMENTO; //Instalaciones clave como el LHC o el Hubble
    case EXPERIMENTO; //Para experimentos clave como Michelson-Morley, doble rendija, Bose-Einstein
    case PUBLICACION; //Para obras que marcaron hitos como los Principia de Newton

    public static function createFromString(string $type): PhysicType{
        return match(strtolower($type)){
            "persona"=>PhysicType::PERSONA,
            "institucion"=>PhysicType::INSTITUCION,
            "instrumento"=>PhysicType::INSTRUMENTO,
            "experimento"=>PhysicType::EXPERIMENTO,
            "publicacion"=>PhysicType::PUBLICACION,
        };
    }
}
