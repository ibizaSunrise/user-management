<?php

namespace App\CQRS\Core;

abstract class AbstractHandler
{
    abstract public function handle(AbstractCommand $command): mixed;
}
