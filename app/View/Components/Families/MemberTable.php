<?php

namespace App\View\Components\Families;

use Illuminate\View\Component;

class MemberTable extends Component
{
    public $family;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($family)
    {
        $this->family = $family;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.families.member-table');
    }
}
