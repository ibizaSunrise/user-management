<?php

namespace App\CQRS\User\Index;

use App\CQRS\Core\AbstractCommand;

class IndexUserCommand extends AbstractCommand
{
    protected string $handler = IndexUserHandler::class;

    public function __construct(){}


    public function toArray(): array
    {
        return [];

    }

}
