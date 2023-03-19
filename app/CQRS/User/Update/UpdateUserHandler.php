<?php

namespace App\CQRS\User\Update;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;


class UpdateUserHandler
{
    /**
     * @param UpdateUserCommand $command
     * @return Model|User
     */
    public function handle(UpdateUserCommand $command): Model|User
    {
        $data = $command->toArray();
        $user = User::query()->find($data['id']);
        $user->fill($data);
        $user->save();

        return $user->refresh();
    }

}
