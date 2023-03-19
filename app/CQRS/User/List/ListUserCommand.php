<?php

namespace App\CQRS\User\List;

use App\CQRS\Core\AbstractCommand;

class ListUserCommand extends AbstractCommand
{
    protected string $handler = ListUserHandler::class;

    public function __construct(){}


    public function toArray(): array
    {
        return [];

    }

}
