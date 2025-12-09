<?php
namespace App\Services\ImageServices;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserImages
{
    public static function upload(Model $model,$request_name='profile_photo') {
        $model->addMediaFromRequest($request_name)->toMediaCollection('users');
    }
    public static function update(User $user) {
        $user->clearMediaCollection('users');
        $user->addMediaFromRequest('profile_photo')->toMediaCollection('users');
    }
    public static function delete(User $user) {
        $user->clearMediaCollection('users');
    }
}