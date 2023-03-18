<?php

namespace App\CQRS\Core;

class CommandBus
{
    public function handle(AbstractCommand $command) {
        /** @var AbstractHandler $handler */
        $handler = resolve($command->getHandlerClassName());

        return $handler->handle($command);
    }
}
