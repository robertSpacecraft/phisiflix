<?php

namespace App\Class;

use \DateTime;
use Ramsey\Uuid\Uuid;
use App\Enum\UserType;
use Ramsey\Uuid\UuidInterface;

class User
{
    private UuidInterface $id;
    private string $username;
    private string $email;
    private string $password;
    private DateTime $birthday;
    private DesbloqueadosList $list;
    private UserType $type;

    public function __construct(UuidInterface $id, string $username){
        $this->id = $id;
        $this->username = $username;
        $this->type=UserType::REGULAR;
        $this->list = new DesbloqueadosList();
    }


    public function getId(): Uuid
    {
        return $this->id;
    }

    public function setId(Uuid $id): User
    {
        $this->id = $id;
        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): User
    {
        $this->username = $username;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    public function getBirthday(): DateTime
    {
        return $this->birthday;
    }

    public function setBirthday(DateTime $birthday): User
    {
        $this->birthday = $birthday;
        return $this;
    }

    public function getList(): DesbloqueadosList
    {
        return $this->list;
    }

    public function setList(DesbloqueadosList $list): User
    {
        $this->list = $list;
        return $this;
    }

    public function getType(): UserType
    {
        return $this->type;
    }

    public function setType(UserType $type): User
    {
        $this->type = $type;
        return $this;
    }

    public static function fromArray(array $userData): User{
        return new User();
    }

}