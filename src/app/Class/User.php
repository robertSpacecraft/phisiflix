<?php

namespace App\Class;

use App\Model\UserModel;
use \DateTime;
use Ramsey\Uuid\Rfc4122\UuidV4;
use Ramsey\Uuid\Uuid;
use App\Enum\UserType;
use Ramsey\Uuid\UuidInterface;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Rules\StringType;
use Respect\Validation\Validator as v;

class User
{
    private UuidInterface $id;
    private string $username;
    private string $email;
    private string $password;
    private DateTime $birthdate;
    private UserType $type;
    private array $desbloqueados = []; //array de Physic

    public function __construct(UuidInterface $id, string $username){
        $this->id = $id;
        $this->username = $username;
        $this->type=UserType::REGULAR;
    }


    public function getId(): UuidInterface
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

    public function getBirthdate(): DateTime
    {
        return $this->birthdate;
    }

    public function setBirthdate(DateTime $birthdate): User
    {
        $this->birthdate = $birthdate;
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

    public function getDesbloqueados(): array
    {
        return $this->desbloqueados;
    }

    public function setDesbloqueados(array $desbloqueados): User
    {
        $this->desbloqueados = $desbloqueados;
        return $this;
    }

    //Funciones mías:
    public static function createFromArray(array $userData): User{
        if (!key_exists('id', $userData)){
            $userData['id'] = Uuid::uuid4()->toString();
            $userData['password'] = password_hash($userData['password'], PASSWORD_DEFAULT);
        }
        $usuario = new User(
            Uuid::fromString($userData['id']),
            $userData['username']
        );
        $usuario->setPassword($userData['password']);
        $usuario->setEmail($userData['email']);
        $usuario->setBirthdate(DateTime::createFromFormat('Y-m-d', $userData['birthdate']));
        $usuario->setType(UserType::createFromString($userData['type']));
        return $usuario;
    }

    public static function editFromArray(User $usuario, array $userData): User{

        $usuario->setUsername($userData['username']??$usuario->getUsername());

        if (isset($userData['password'])){
            $usuario->setPassword(password_hash($userData['password'], PASSWORD_DEFAULT));
        }

        $usuario->setEmail($userData['email']??$usuario->getEmail());
        $usuario->setBirthdate(DateTime::createFromFormat('Y-m-d', $userData['birthdate'])??$usuario->getBirthdate()->format('Y-m-d'));
        $usuario->setType(UserType::createFromString($userData['type']??$usuario->getType()->name));

        return $usuario;

    }


    public static function validateUserCreation(array $userData):array|true{
        try {
            v::key('username', v::stringType()->length(3, 60))
                ->key('email', v::email())
                ->key('password', v::stringType()->length(8, 32))
                ->key('birthdate', v::date('Y-m-d'))
                ->key('type', v::in(['admin', 'editor', 'regular', 'advertising']))
                ->assert($userData);

        } catch (NestedValidationException $errores) {
            return $errores->getMessages();
        }
        //El usuario ha superado el proceso de validación
        return true;
    }

        public static function validateUserUpdate(array $userData):array|true{
            try{
                v::key('id', v::uuid()->notEmpty());
                v::key('username', v::stringType()->length(3, 60), false)
                    ->key('email', v::email(), false)
                    ->key('password', v::stringType()->length(8, 32), false)
                    ->key('birthdate', v::date('Y-m-d'), false)
                    ->key('type',v::in(['admin', 'editor', 'regular', 'advertising']), false)
                    ->assert($userData);

            } catch(NestedValidationException $errores){
                return $errores->getMessages();
            }

            return true;
        }

        //Comprueba si el usuario de la sesión es un ADMIN
        public function isAdmin(): bool{
            if ($this->type===UserType::ADMIN) {
                return true;
            }
            return false;
        }


}