<?php

namespace App\CQRS\User\Store;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class StoreUserHandler
{
    /**
     * @param StoreUserCommand $command
     * @return Model|User
     */
    public function handle(StoreUserCommand $command): Model|User {
        return User::query()->create($command->toArray());
    }
}
