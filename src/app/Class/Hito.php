<?php

namespace App\Class;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Hito
{
    // Identificador interno (UUID para la BD)
    private UuidInterface $id;

    // Relación 1→N: cada Hito pertenece a un Physic
    private ?UuidInterface $physicId;

    // Identificador tal cual viene en el JSON ("event-xxxxx")
    private string $eventId;

    // Campos principales
    private string $titulo;
    private string $descripcion;
    private ?int $year_start;
    private ?int $year_end;
    private string $label;
    private string $summary;

    // Campos directamente del JSON
    private string $category;      // category
    private array $people = [];    // array de string
    private array $tags = [];      // array de string

    // Campos extra que ya tenías
    private array $list_categorias = []; // para clasificaciones adicionales
    private array $list_campos = [];     // campos/áreas científicas

    public function __construct(string $titulo)
    {
        $this->id = Uuid::uuid4();
        $this->titulo = $titulo;

        // Por defecto sin físico asociado; se asigna después con el setter
        $this->physicId = null;

        // Valores por defecto razonables
        $this->eventId = '';
        $this->descripcion = '';
        $this->year_start = null;
        $this->year_end = null;
        $this->label = '';
        $this->summary = '';
        $this->category = '';

        $this->people = [];
        $this->tags = [];
        $this->list_categorias = [];
        $this->list_campos = [];
    }

    //Funciones operativas
    public static function createFromArray(array $hitoData): Hito
    {
        // Si no viene id, generamos uno nuevo
        if (!isset($hitoData['id'])) {
            $hitoData['id'] = Uuid::uuid4()->toString();
        }

        // El constructor solo necesita el título
        $hito = new Hito($hitoData['titulo']);

        // ID interno UUID
        $hito->setId(Uuid::fromString($hitoData['id']));

        // Relación con Physic (puede venir null si no está en BD)
        if (!empty($hitoData['physic_id'])) {
            $hito->setPhysicId(Uuid::fromString($hitoData['physic_id']));
        }
        // Campos simples (usar ?? para evitar undefined index)
        $hito->setEventId($hitoData['eventId'] ?? '');
        $hito->setDescripcion($hitoData['descripcion'] ?? '');
        $hito->setYearStart($hitoData['year_start'] ?? null);
        $hito->setYearEnd($hitoData['year_end'] ?? null);
        $hito->setLabel($hitoData['label'] ?? '');
        $hito->setSummary($hitoData['summary'] ?? '');
        $hito->setCategory($hitoData['category'] ?? '');

        // De momento, dejamos los arrays vacíos hasta que gestiones JSON
        $hito->setPeople([]);
        $hito->setTags([]);
        $hito->setListCategorias([]);
        $hito->setListCampos([]);

        return $hito;
    }


    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function setId(UuidInterface $id): Hito
    {
        $this->id = $id;
        return $this;
    }

    public function getPhysicId(): ?UuidInterface
    {
        return $this->physicId;
    }

    public function setPhysicId(?UuidInterface $physicId): Hito
    {
        $this->physicId = $physicId;
        return $this;
    }

    public function getEventId(): string
    {
        return $this->eventId;
    }

    public function setEventId(string $eventId): Hito
    {
        $this->eventId = $eventId;
        return $this;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): Hito
    {
        $this->titulo = $titulo;
        return $this;
    }

    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): Hito
    {
        $this->descripcion = $descripcion;
        return $this;
    }

    public function getYearStart(): ?int
    {
        return $this->year_start;
    }

    public function setYearStart(?int $year_start): Hito
    {
        $this->year_start = $year_start;
        return $this;
    }

    public function getYearEnd(): ?int
    {
        return $this->year_end;
    }

    public function setYearEnd(?int $year_end): Hito
    {
        $this->year_end = $year_end;
        return $this;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): Hito
    {
        $this->label = $label;
        return $this;
    }

    public function getSummary(): string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): Hito
    {
        $this->summary = $summary;
        return $this;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): Hito
    {
        $this->category = $category;
        return $this;
    }

    public function getPeople(): array
    {
        return $this->people;
    }

    public function setPeople(array $people): Hito
    {
        $this->people = $people;
        return $this;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function setTags(array $tags): Hito
    {
        $this->tags = $tags;
        return $this;
    }

    public function getListCategorias(): array
    {
        return $this->list_categorias;
    }

    public function setListCategorias(array $list_categorias): Hito
    {
        $this->list_categorias = $list_categorias;
        return $this;
    }

    public function getListCampos(): array
    {
        return $this->list_campos;
    }

    public function setListCampos(array $list_campos): Hito
    {
        $this->list_campos = $list_campos;
        return $this;
    }

}
