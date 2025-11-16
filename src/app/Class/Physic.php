<?php

namespace App\Class;
use App\Enum\PhysicGenero;
use App\Enum\PhysicType;
use JsonSerializable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

class Physic implements JsonSerializable
{
    private UuidInterface $id;
    private string $nombre;
    private string $apellido;
    private PhysicGenero $genero;
    private string $nacionalidad; //Cambiar por nacionalidad
    private string $lugar_def;
    private string $descripcion;
    private string $etiqueta; //palabras clave (relatividad, gravedad, radiación, etc)
    private PhysicType $type;
    private string $foto;
    private array $hito = [];

    public function __construct(string $nombre) {
        $this->nombre = $nombre;
        $this->type = PhysicType::PERSONA;
        $this->genero = PhysicGenero::NOT_DEFINED;
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

    public function getGenero(): PhysicGenero
    {
        return $this->genero;
    }

    public function setGenero(PhysicGenero $genero): Physic
    {
        $this->genero = $genero;
        return $this;
    }

    public function getNacionalidad(): string
    {
        return $this->nacionalidad;
    }

    public function setNacionalidad(string $nacionalidad): Physic
    {
        $this->nacionalidad = $nacionalidad;
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

    public static function createFromArray(array $physicData): Physic{
        if (!isset($physicData['id'])) {
            $physicData['id'] = Uuid::uuid4()->toString();
        }
        $physic = new Physic(
            $physicData['nombre'],
        );
        $physic->setId(Uuid::fromString($physicData['id']));
        //$physic->setNombre($physicData['nombre']);
        $physic->setApellido($physicData['apellido']);
        $physic->setGenero(PhysicGenero::createFromString($physicData['genero']));
        $physic->setNacionalidad($physicData['nacionalidad']);
        $physic->setLugarDef($physicData['lugar_def']);
        $physic->setDescripcion($physicData['descripcion']);
        $physic->setEtiqueta($physicData['etiqueta']);
        $physic->setType(PhysicType::createFromString($physicData['type']));
        $physic->setFoto($physicData['foto']);

        return $physic;
    }

    public static function editFromArray(Physic $physic, array $physicData): Physic{
        $physic->setNombre($physicData['nombre']??$physic->getNombre());
        $physic->setApellido($physicData['apellido']??$physic->getApellido());
        $physic->setGenero(PhysicGenero::createFromString($physicData['genero']??$physic->getGenero()));
        $physic->setNacionalidad($physicData['nacionalidad']??$physic->getNacionalidad());
        $physic->setLugarDef($physicData['lugar_def']??$physic->getLugarDef());
        $physic->setDescripcion($physicData['descripcion']??$physic->getDescripcion());
        $physic->setEtiqueta($physicData['etiqueta']??$physic->getEtiqueta());
        $physic->setType(PhysicType::createFromString($physicData['type']??$physic->getType()));
        $physic->setFoto($physicData['foto']??$physic->getFoto());
        return $physic;
    }

    public static function validatePhysicCreation(array $physicData):array|true{
        try {
            v::key('nombre', v::stringType()->length(3, 32))
                ->key('apellido', v::stringType()->length(3, 32))
                ->key('genero', v::in(['MASCULINO', 'FEMENINO', 'NO_APLICA', 'NOT_DEFINED']))
                ->key('nacionalidad', v::stringType()->length(2, 32))
                ->key('lugar_def', v::stringType()->length(2, 64))
                ->key('descripcion', v::stringType()->length(3, 512))
                ->key('etiqueta', v::stringType()->length(3, 128))
                ->key('type', v::in(['PERSONA', 'INSTITUCION', 'INSTRUMENTO', 'ESPERIMENTO', 'PUBLICACION']))
                ->key('foto', v::regex('/\.png$/i'))

                ->assert($physicData);

        } catch(NestedValidationException $errores){
            return $errores->getMessages();
        }
        return true;
    }

    public function jsonSerialize(): mixed{
        return [
            "id" => $this->id,
            "nombre" => $this->nombre,
            "apellido" => $this->apellido,
            "genero" => $this->genero,
            "nacionalidad" => $this->nacionalidad,
            "lugar_def" => $this->lugar_def,
            "descripcion" => $this->descripcion,
            "etiqueta" => $this->etiqueta,
            "type" => $this->type,
            "foto" => $this->foto,
            "hito" => $this->hito,
        ];
    }
}