<?php

namespace App\CQRS\User\Delete;

use App\CQRS\Core\AbstractCommand;

class DeleteUserCommand extends AbstractCommand
{
    protected string $handler = DeleteUserHandler::class;
    public function __construct(  private readonly int $id)
    {

    }
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId()
        ];
    }

}
