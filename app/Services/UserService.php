<?php


namespace App\Services;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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

    public function editUser(User $user, array $data): User
    {
        $user->fill($data);
        $user->password = Hash::make($data['password']);
        $user->save();

        return $user->refresh();
    }

    public function storeImage(User $user, UploadedFile $image): User
    {
        $name = sprintf('%s.%s', Str::uuid(), $image->getClientOriginalExtension());
        $filePath = Storage::disk('public')->putFileAs('/images', $image, $name);

        $user->update([
            'path' => url('/storage/' . $filePath)
        ]);

        return $user->refresh();
    }


}
