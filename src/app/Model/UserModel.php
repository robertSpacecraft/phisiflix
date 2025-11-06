<?php

namespace App\Model;

use App\Class\User;
use App\Enum\UserType;
use mysql_xdevapi\TableUpdate;
use Ramsey\Uuid\Nonstandard\Uuid;

class UserModel
{
    public static function getAllUsers(): array{
        $usuario1 = new User(Uuid::uuid4(), "Roberto");
        $usuario1->setEmail("roberto@mail.com");
        $usuario1->setPassword("otrebor");
        $usuario1->setType(UserType::ADMIN);
        $usuario2 = new User(Uuid::uuid4(), "Juan");
        $usuario2->setEmail("juan@mail.com");
        $usuario2->setPassword("nauj");
        $usuario2->setType(UserType::REGULAR);
        $usuario3 = new User(Uuid::uuid4(), "Graciela");
        $usuario3->setEmail("graciela@mail.com");
        $usuario3->setPassword("aleicarg");

        return $usuarios = [$usuario1, $usuario2, $usuario3];
    }

    public static function getUserById($id): User{
        $usuario1 = new User(Uuid::uuid4(), "Roberto");
        $usuario1->setEmail("roberto@mail.com");
        $usuario1->setPassword("otrebor");
        $usuario1->setBirthdate(\DateTime::createFromFormat('Y-m-d', "1984-05-05"));
        $usuario1->setType(UserType::ADMIN);

        return $usuario1;
    }

    public static function saveUser(User $user): bool{
        return true;
    }
}