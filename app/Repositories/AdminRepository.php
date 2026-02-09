<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\IAdminRepository;
use Illuminate\Support\Facades\Hash;

class AdminRepository implements IAdminRepository
{
    // register admin user
    public function adminRegisterProcess(array $request){
        $name = $request['name'];
        $email = $request['email'];
        $password = Hash::make($request['password']);

        if($this->checkAdminUserExists($email)){
            throw new \Exception('Admin user already exists');
        }

        $adminUser = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);

        if(!$adminUser){
            throw new \Exception('Failed to create admin user');
        }

        return $adminUser;
    }

    // check admin user is already exists
    private function checkAdminUserExists(string $email){
        return User::where('email', $email)->exists();
    }


    // admin login
    public function adminLoginProcess(array $request){
        $email = $request['email'];
        $password = $request['password'];

        $adminUser = User::where('email', $email)->first();

        if(!$adminUser){
            throw new \Exception('Admin user not found');
        }

        if(!Hash::check($password, $adminUser->password)){
            throw new \Exception('Invalid password');
        }

        session([
            'admin' => base64_encode(json_encode([
                'name' => $adminUser->name,
                'email' => $adminUser->email,
                'login_time' => now()->toDateTimeString()
            ]))
        ]);

        return $adminUser;
    }
}
