<?php
namespace App\Services\DatabaseServices;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class PatientDB
{
   
    public function create(array $data): User
    {
        $user=User::create($data);
        $data['user_id']=$user->id;
        $patient=Patient::create($data);
        return $patient->load('user');
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
        return User::with('user')->cursorPaginate(15);
    }

    /**
     * Update user by ID with provided data. Returns updated User or null.
     */
    public function update(Patient $patient, array $data)
    {
        $user=(array)UserDB::update($patient->user,$data);
        $patient->update($data);
        return $patient->load('user');
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
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }
}