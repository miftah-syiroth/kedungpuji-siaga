<?php

namespace App\Http\Livewire\Posyandu;

use App\Models\Month;
use Livewire\Component;

class Anthropometries extends Component
{
    public $posyandu; // data posyandu seorang bayi, dikirim dari controller via view
    public $anthropometries; // data antropometries dari posyandu
    public $ageInYear; // umur bayi berdasarkan tahun integer, pembulatan ke bawah, misal 13 bulan berarti 1 tahun
    public $ageInMonth;
    
    public $batasBawahBulan; // batas umur dalam bulan dalam satu tahun
    public $batasAtasBulan; // batas umur dalam bulan dalam satu tahun


    /**
     * getAge,cek apakah umur sudah 5 tahun atau lebih. jika lebih maka set jadi 0. sebaliknya maka age
     * krn antropometri hanya sampai umur 4 tahun 12 bulan. alasan diubah jadi 0 adalah supaya data yg diambil adlah
     * tahun ke 0. tidak ada aturan interval dlm getMonthInYearInteval utk 5 tahun lebih
     *
     * @param  mixed $posyandu
     * @return void
     */
    public function getAge()
    {
        $ageInYear = $this->posyandu->person->date_of_birth->age;
        $this->ageInYear = $ageInYear >= 5 ? 0 : $ageInYear;

        $this->ageInMonth = $this->posyandu->person->date_of_birth->diffInMonths(now());
    }
    
    /**
     * getMonthInYearInterval, misal tahun ke 0 berarti dimulai umur 0 bulan hingga  11 bulan
     * 1 tahun berarti 12 bulan hingga 23 bulan
     *
     * @return void
     */
    public function getMonthInYearInterval()
    {
        if ($this->ageInYear == 0) {
            $this->batasBawahBulan = 0;
            $this->batasAtasBulan = 11;
        } elseif($this->ageInYear == 1) {
            $this->batasBawahBulan = 12;
            $this->batasAtasBulan = 23;
        } elseif($this->ageInYear == 2) {
            $this->batasBawahBulan = 24;
            $this->batasAtasBulan = 35;
        } elseif($this->ageInYear == 3) {
            $this->batasBawahBulan = 36;
            $this->batasAtasBulan = 47;
        } elseif($this->ageInYear == 4) {
            $this->batasBawahBulan = 48;
            $this->batasAtasBulan = 60;
        }
    }
    
    /**
     * getAnthropometriesByAge, ambil data antropometri berdasarkan umur tahun dlm integer
     * update ageInYear supaya navigasi next and previous juga berubah
     * update batas interval looping bulan dgn fungsi getMonthInyearInterval
     *
     * @param  mixed $var
     * @return void
     */
    public function getAnthropometries($ageInYear)
    {
        $this->ageInYear = $ageInYear;
        $this->getMonthInYearInterval();
        $this->anthropometries = $this->posyandu->anthropometries()->where('year_periode', $this->ageInYear)->get();
    }

    /**
     * age, ambil umur bayi dalam tahun, jika 11 bulan maka munculnya adalah 0 tahun,
     * posyandu_services, munculkan posyandu service yang year_periodenya adalah age.
     *
     * @param  mixed $posyandu
     * @return void
     */
    public function mount()
    {
        $this->getAge(); // get umur bayi dlm tahun dan bulan
        $this->getMonthInYearInterval();
        $this->getAnthropometries($this->ageInYear); // ambil data antropometri berdasarkan umur
    }

    public function render()
    {
        return view('livewire.posyandu.anthropometries');
    }
}
