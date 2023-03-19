<?php

namespace App\CQRS\User\Delete;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class DeleteUserHandler
{


    public function handle(DeleteUserCommand $command): void
    {
        $data = $command->toArray();
        $user = User::query()->find($data['id']);
        $user->delete();

    }

}
