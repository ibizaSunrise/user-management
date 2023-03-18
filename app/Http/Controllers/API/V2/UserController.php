<?php

namespace App\Http\Controllers\API\V2;

use App\CQRS\User\Store\StoreUserCommand;
use App\Http\Requests\UserRequest;
use Illuminate\Http\JsonResponse;

class UserController extends CQRSController
{
    public function store(UserRequest $request): JsonResponse
    {
        $command = new StoreUserCommand(
            $request->post('name'),
            $request->post('surname'),
            $request->post('email'),
            $request->post('password'),
        );

        return $this->sendResponse(
            ['user' => $this->getBus()->handle($command)]
        );
    }
}
