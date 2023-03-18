<?php

namespace App\Http\Controllers\API\V2;

use App\CQRS\Core\CommandBus;
use App\Http\Controllers\Controller;

class CQRSController extends Controller
{
    private CommandBus $bus;

    public function __construct(CommandBus $bus)
    {
        $this->bus = $bus;
    }

    protected function getBus(): CommandBus
    {
        return $this->bus;
    }
}
