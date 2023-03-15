<?php


namespace App\Services;


use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

    public function storeImage($image)
    {
        $name = md5(Carbon::now() . '_' . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
        $filePath = Storage::disk('public')->putFileAs('/images', $image, $name);

        $user = Auth::user();

        $user->update([
            'path' => url('/storage/'.$filePath)
        ]);
    }


}
