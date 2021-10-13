<?php

namespace App\View\Components\Users;

use Illuminate\View\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateUser extends Component
{
    public $roles;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($roles)
    {
        $this->roles = $roles;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user.create-user');
    }
}
