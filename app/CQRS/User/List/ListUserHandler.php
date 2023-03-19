<?php

namespace App\CQRS\User\List;

use App\Http\Resources\UserResource;
use App\Models\User;

class ListUserHandler
{

    /**
     * @param ListUserCommand $command
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function handle(ListUserCommand $command): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return UserResource::collection(User::all());
    }

}
