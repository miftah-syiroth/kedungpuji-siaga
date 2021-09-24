<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;

class UserService
{
    private $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }
    
    /**
     * getAllRoles mendapatkan semua role untuk dipassing ke view create dan edit user
     *
     * @return void
     */
    public function getAllRoles()
    {
        return Role::all()->pluck('name');
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
    
    /**
     * removeRole menghapus role dari seorang user pada aksi delete user
     *
     * @param  mixed $user
     * @return void
     */
    public function removeRole(User $user)
    {
        $role = $this->getRole($user);

        $user->removeRole($role);
    }
    
    /**
     * getAllUsers mengembalikan semua user berdasarkan siapa yang sedang login.
     * hanya dua role yg dpt melihat data pengguna yaitu admin dan bidan desa.
     *
     * @return void
     */
    public function getAllUsers()
    {
        if ($this->user->hasRole('admin')) {
            return User::with(['roles'])->get();
        } elseif ($this->user->hasRole('bidan desa')) {
            return User::role('kader kesehatan')->with('roles')->get(); 
        }
    }

    public function store($request)
    {
        if ($request->role == null) {
            $request->role = 'kader kesehatan';
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        $user->syncRoles($request->role);
    }

    public function update($request, User $user)
    {
        $attributes = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        if ($request->password) {
            $attributes['password'] = Hash::make($request->password);
        }

        $user->update($attributes);
        
        if ($request->role) {
            $user->syncRoles($request->role);
        }
    }

    public function delete(User $user)
    {
        // hapus dulu role dan permission yg dimiliki
        $this->removeRole($user);
        $user->delete();
    }
}
