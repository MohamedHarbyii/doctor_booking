<?php
namespace App\Services\DatabaseServices;

use App\Models\User;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class PatientDB
{
   
    public static function create(array $data): User
    {
        
   

        $patient=Patient::create($data);
        return $patient;
  
     
    }

    /**
     * Get single user by ID or null if not found.
     */
    public function getById(int $id): ?User
    {
        return User::find($id);
    }

    
    public static function getAll()
    {
        return Patient::with('user')->cursorPaginate(15);
    }

    /**
     * Update user by ID with provided data. Returns updated User or null.
     */
    public static function update(Patient $patient, array $data)
    {
        $patient->update($data);
        return $patient->load('user');
    }
    /**
     * Delete user by ID. Returns true on success.
     */
    public static function delete(Patient $patient)
    {
        $patient->deleteOrFail();
        $user=$patient->user;
        UserDB::delete($user);
        
        

    }
    public static function get_current_patient() {

        return Patient::where('user_id','=',Auth::user()->id)->firstOrFail();
   
       
    }

    /**
     * Find user by email.
     */
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }
}