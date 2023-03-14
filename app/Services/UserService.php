<?php


namespace App\Services;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function makeNewUser($data)
    {
        $user = new User;
        $user->fill($data);
        $user->password = Hash::make($data['password']);
        $user->save();
        return $user;

    }

    public function editUser($data, $user)
    {
        $user->fill($data);
        $user->password = Hash::make($data['password']);
        $user->save();
        return $user;

    }


}
