<?php

namespace App\CQRS\User\Update;

use App\CQRS\Core\AbstractCommand;
use Illuminate\Support\Facades\Hash;

class UpdateUserCommand extends AbstractCommand
{
    protected string $handler = UpdateUserHandler::class;


    /**
     * @param int $id
     * @param string|null $name
     * @param string|null $surname
     * @param string|null $email
     * @param string|null $password
     */
    public function __construct(
        private readonly int $id,
        private readonly ?string $name = null,
        private readonly ?string $surname = null,
        private readonly ?string $email = null,
        private readonly ?string $password = null
    )
    {

    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): string|null
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getSurname(): string|null
    {
        return $this->surname;
    }

    /**
     * @return string|null
     */
    public function getEmail(): string|null
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getPassword(): string|null
    {
        return $this->password;
    }

    public function toArray(): array
    {
        $arr = [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'surname' => $this->getSurname(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword()
        ];

        foreach ($arr as $k => $v){
            if(empty($v)) unset($arr[$k]);
        }

        if(array_key_exists('password', $arr)){
            $arr->password = Hash::make($arr['password']);
        }
        return $arr;
    }


}
