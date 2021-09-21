<?php

namespace App\Services;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserService
{
    public $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }
    
    /**
     * getRole untuk mengambil sebuah role dari seorang user. buat aturan bahwa satu user
     * hanya satu role
     * @param  mixed $user
     * @return void
     */
    public function getRole(User $user)
    {
        return $user->getRoleNames()->first();
    }

    public function removeRole(User $user)
    {
        $role = $this->getRole($user);

        $user->removeRole($role);
    }

    public function getUsers()
    {
        if ($this->user->hasRole('admin')) {
            return User::with(['roles'])->get();
        } elseif ($this->user->hasRole('bidan desa')) {
            return User::role('kader kesehatan')->with('roles')->get(); 
        }
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        $user->assignRole($request->role);
    }

    public function deleteUser(User $user)
    {
        // hapus dulu role dan permission yg dimiliki
        $this->removeRole($user);
        $user->delete();
    }
}
