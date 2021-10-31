<?php

namespace App\Http\Livewire\Couples;

use App\Models\KbService;
use App\Models\KbStatus;
use App\Models\Month;
use Carbon\Carbon;
use Livewire\Component;

class PersonalKbReport extends Component
{
    
    public $couple;
    public $months;

    public $year_periode; //periode tahun yg jd paramter query select table
    public $batas_bawah_tahun; // batas tahun pada umur 15
    public $batas_atas_tahun; // batas tahun pada umur 49

    public $keluarga_berencana_data; // data kb yang akan dilooging

    // public $is_pus; // apakah dia pasangan subur, umur 15<=x<=49
    
    /**
     * setBatasTahun untuk mendapatkan tahun dimana umur pasangan adalah 15 tahun dan 49 tahun
     * tahun2 ini akan digunkaan untuk batas navigasi terendah dan tertinggi.
     * fungsi juga mengecek apakah umur sudah melebihi 49. jika iya maka tampilkan laporan pada tahun diumur 49
     * @param  mixed $couple
     * @return void
     */
    public function setBatasTahun($couple)
    {
        $this->batas_bawah_tahun = $couple->wife->date_of_birth->addYears(15)->year;
        $this->batas_atas_tahun = $couple->wife->date_of_birth->addYears(49)->year;
    }
        
    /**
     * menginisiasi year_periode, data kb yg ditampilkan akan berdasarkan year_periode
     * jika umur pasangan sudah 
     * @param  mixed $couple
     * @return void
     */
    public function setYearPeriode($couple)
    {
        if ($couple->wife->date_of_birth->age > 49) {
            return $this->batas_atas_tahun;
        } else {
            return Carbon::now()->year;
        }
    }
    
    /**
     * getKbReportByYear, ambil laporan kb personal berdasarkan tahun
     * baris pertama digunakan untuk merubah year_periode melalui wire:click
     * @return void
     */
    public function getKbReport($year_periode)
    {
        $this->year_periode = $year_periode; 
        $this->keluarga_berencana_data = $this->couple->keluargaBerencana()->with('kbStatus')->where('year_periode', $this->year_periode)->get();
    }

    public function checkIfCoupleKbMember($couple)
    {
        if ($couple->is_kb == true) {
            return KbStatus::whereIn('id', [1,2,3,4,5,6,7])->get();
        } elseif ($couple->is_kb == false) {
            return KbStatus::whereIn('id', [8,9,10,11])->get();
        }
    }
    
    /**
     * menginisiasi batas interval tahun berdasarkan tgl lahir istri
     * menginisiasi year_periode sbg parameter query data yang akan ditampilkan.
     *
     * @param  mixed $couple
     * @return void
     */
    public function mount($couple)
    {
        $this->setBatasTahun($couple);
        $this->year_periode = $this->setYearPeriode($couple);
        $this->getKbReport($this->year_periode);
        $this->months = Month::all();
        $this->kb_statuses = $this->checkIfCoupleKbMember($couple);
    }

    public function render()
    {
        return view('livewire.couples.personal-kb-report');
    }
}
