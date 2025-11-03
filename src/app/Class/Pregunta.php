<?php

namespace App\Class;

class Pregunta
{
    private string $pregunta;
    private string $respuesta;

    public function __construct(array $pregunta, string $respuesta){
        $this->pregunta = $pregunta;
        $this->respuesta = $respuesta;

    }

    public function getPregunta(): string
    {
        return $this->pregunta;
    }

    public function setPregunta(string $pregunta): Pregunta
    {
        $this->pregunta = $pregunta;
        return $this;
    }

    public function getRespuesta(): string
    {
        return $this->respuesta;
    }

    public function setRespuesta(string $respuesta): Pregunta
    {
        $this->respuesta = $respuesta;
        return $this;
    }

}