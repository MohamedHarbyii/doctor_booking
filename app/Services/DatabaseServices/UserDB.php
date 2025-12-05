<?php
namespace App\Services\DatabaseServices;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserDB 
{
   
    public static function create(array $data): User
    {
        return User::create($data);
    }

    /**
     * Get single user by ID or null if not found.
     */
    public function getById(int $id): ?User
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
        return $user;
    }

    /**
     * Delete user by ID. Returns true on success.
     */
    public function delete(User $user): bool
    {
        
        return (bool) $user->delete();
    }

    /**
     * Find user by email.
     */
    public static function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }
}