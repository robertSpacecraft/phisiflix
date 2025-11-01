<?php

namespace App\Class;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Hito
{
    private UuidInterface $id;
    private string $titulo;
    private string $descripcion;
    private int $year_start;
    private int $year_end;
    private string $label;
    private string $summary;
    private array $tags = []; //string
    private array $list_categorias = []; //String
    private array $list_campos = []; //string

    public function __construct(UuidInterface $id, string $titulo){
        $this->id = Uuid::uuid4();
        $this->titulo = $titulo;
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

    public function getYearStart(): int
    {
        return $this->year_start;
    }

    public function setYearStart(int $year_start): Hito
    {
        $this->year_start = $year_start;
        return $this;
    }

    public function getYearEnd(): int
    {
        return $this->year_end;
    }

    public function setYearEnd(int $year_end): Hito
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