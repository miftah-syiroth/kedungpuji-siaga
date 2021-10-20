<?php

namespace App\View\Components\Posyandu;

use Illuminate\View\Component;

class Neonatus extends Component
{
    public $periode = [
        ['nomor' => 1, 'min' => 0, 'max' => 1], // 0-6 jam
        ['nomor' => 2, 'min' => 1, 'max' => 2], //6-48 jam
        ['nomor' => 3, 'min' => 3, 'max' => 7], //3-7 hari
        ['nomor' => 4, 'min' => 8, 'max' => 28], //8-28 hari
    ];

    public $posyandu;
    public $umur_bayi;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($posyandu)
    {
        $this->posyandu = $posyandu;
        $this->umur_bayi = $posyandu->person->date_of_birth->diffInDays(now());
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.posyandu.neonatus');
    }
}
