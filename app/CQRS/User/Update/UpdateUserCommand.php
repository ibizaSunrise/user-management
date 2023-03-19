<?php

namespace App\CQRS\User\Update;

use App\CQRS\Core\AbstractCommand;

class UpdateUserCommand extends AbstractCommand
{
    protected string $handler = UpdateUserHandler::class;

    public function __construct(
        private readonly int $id,
        private readonly string $name,
        private readonly string $surname,
        private readonly string $email,
        private readonly string $password

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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'surname' => $this->getSurname(),
            'email' => $this->getEmail(),
            'password' => bcrypt($this->getPassword())
        ];
    }


}
