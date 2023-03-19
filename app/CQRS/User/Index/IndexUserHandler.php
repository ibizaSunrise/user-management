<?php

namespace App\CQRS\User\Index;

use App\Http\Resources\UserResource;
use App\Models\User;

class IndexUserHandler
{

    /**
     * @param IndexUserCommand $command
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function handle(IndexUserCommand $command): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return UserResource::collection(User::all());
    }

}
