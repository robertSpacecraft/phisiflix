<?php

namespace App\Class;
use App\Enum\PhysicSex;
use App\Enum\PhysicType;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Physic
{
    private UuidInterface $id;
    private string $nombre;
    private string $apellido;
    private PhysicSex $sex;
    private string $lugar_nac;
    private string $lugar_def;
    private string $descripcion;
    private string $etiqueta;
    private PhysicType $type;
    private string $foto;
    private array $hito = [];

    public function __construct(string $nombre) {
        $this->id = Uuid::uuid4();
        $this->nombre = $nombre;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function setId(UuidInterface $id): Physic
    {
        $this->id = $id;
        return $this;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): Physic
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getApellido(): string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): Physic
    {
        $this->apellido = $apellido;
        return $this;
    }

    public function getSex(): PhysicSex
    {
        return $this->sex;
    }

    public function setSex(PhysicSex $sex): Physic
    {
        $this->sex = $sex;
        return $this;
    }

    public function getLugarNac(): string
    {
        return $this->lugar_nac;
    }

    public function setLugarNac(string $lugar_nac): Physic
    {
        $this->lugar_nac = $lugar_nac;
        return $this;
    }

    public function getLugarDef(): string
    {
        return $this->lugar_def;
    }

    public function setLugarDef(string $lugar_def): Physic
    {
        $this->lugar_def = $lugar_def;
        return $this;
    }

    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): Physic
    {
        $this->descripcion = $descripcion;
        return $this;
    }

    public function getEtiqueta(): string
    {
        return $this->etiqueta;
    }

    public function setEtiqueta(string $etiqueta): Physic
    {
        $this->etiqueta = $etiqueta;
        return $this;
    }

    public function getType(): PhysicType
    {
        return $this->type;
    }

    public function setType(PhysicType $type): Physic
    {
        $this->type = $type;
        return $this;
    }

    public function getFoto(): string
    {
        return $this->foto;
    }

    public function setFoto(string $foto): Physic
    {
        $this->foto = $foto;
        return $this;
    }

    public function getHito(): array
    {
        return $this->hito;
    }

    public function setHito(array $hito): Physic
    {
        $this->hito = $hito;
        return $this;
    }


}