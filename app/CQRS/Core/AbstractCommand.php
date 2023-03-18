<?php

namespace App\CQRS\Core;

abstract class AbstractCommand
{
    protected string $handler;

    /**
     * @return array
     */
    abstract public function toArray(): array;

    /**
     * @return string
     */
    public function getHandlerClassName(): string
    {
        return $this->handler;
    }
}
