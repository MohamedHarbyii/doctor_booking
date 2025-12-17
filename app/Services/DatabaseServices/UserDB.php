<?php
namespace App\Services\DatabaseServices;

use App\Models\User;
use App\Services\ImageServices\ImageServiece;
use App\Services\ImageServices\UserImages;
use Illuminate\Database\Eloquent\Collection;

class UserDB 
{
   
    public static function create(array $data): User
    {
        $user= User::create($data);
        if(isset($data['image']))
        ImageServiece::upload($user,'user');
        
        return $user->load('media');
    }

    /**
     * Get single user by ID or null if not found.
     */
    public static function getById(int $id): ?User
    {
        return User::find($id);
    }

    
    public function getAll()
    {
        return User::cursorPaginate(15);
    }

    /**
     * Update user by ID with provided data. Returns updated User or null.
     */
    public static function update(User $user, array $data): ?User
    {
        $user->fill($data);
        $user->save();
        if(isset($data['image'])){
        ImageServiece::update($user,'user');}
        return $user;
    }

    /**
     * Delete user by ID. Returns true on success.
     */
    public static function delete(User $user)
    {
        
        $user->deleteOrFail();
        $user->tokens()->delete();
        ImageServiece::delete($user,'user');
    }

    /**
     * Find user by email.
     */
    public static function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }
}