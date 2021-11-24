<?php
namespace App\Services;

use App\Models\Couple;
use App\Models\KeluargaBerencana;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class KbService
{
    public function getAnualReport()
    {
        return Couple::whereHas('wife', function (Builder $query) {
            $query->whereDate('date_of_birth', '<=', Carbon::now()->addYears(-15) )
                ->whereDate('date_of_birth', '>=', Carbon::now()->addYears(-49) );
        })->with(['kbService', 'keluargaBerencana.kbStatus', 'keluargaBerencana' => function($query){
            $query->where('year_periode', Carbon::now()->year);
        }])->get();
    }

    public function store($request, $couple)
    {
        KeluargaBerencana::updateOrCreate(
            [
                'couple_id' => $couple->id,
                'year_periode' => $request->year_periode,
                'month_periode' => $request->month_periode,
            ],
            [
                'kb_status_id' => $request->kb_status_id,
            ],
        );
    }

    public function kbMonthlyReport($request, $rt)
    {
        // bisa dibikin scop, tp males, biar bisa koreksi aja
        // batasannya pertama adalah, kb service pemerintah atau swasta, rt, rw, bulan, dan tahun
        return [
            'jumlah_pus' => Couple::whereHas('wife', function (Builder $query) use ($request, $rt) {
                                    $query->whereDate('date_of_birth', '<=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-15) ) //koreksi lagi
                                        ->whereDate('date_of_birth', '>=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-49) )
                                        ->where('rt', $rt)
                                        ->where('rw', $request->rw);
                                })->count(),
            'iud' => [
                'p' => Couple::whereHas('wife', function (Builder $query) use ($request, $rt) {
                            $query->whereDate('date_of_birth', '<=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-15) ) //koreksi lagi
                                ->whereDate('date_of_birth', '>=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-49) )
                                ->where('rt', $rt)
                                ->where('rw', $request->rw);
                        })->where('is_kb', true)->where('kb_service_id', 1)
                        ->whereHas('keluargaBerencana', function (Builder $query) use ($request) {
                            $query->where('year_periode', $request->year_periode)
                                ->where('month_periode', $request->month_periode)
                                ->where('kb_status_id', 1);
                        })->count(),
                's' => Couple::whereHas('wife', function (Builder $query) use ($request, $rt) {
                            $query->whereDate('date_of_birth', '<=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-15) ) //koreksi lagi
                                ->whereDate('date_of_birth', '>=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-49) )
                                ->where('rt', $rt)
                                ->where('rw', $request->rw);
                        })->where('is_kb', true)->where('kb_service_id', 2)
                        ->whereHas('keluargaBerencana', function (Builder $query) use ($request) {
                            $query->where('year_periode', $request->year_periode)
                                ->where('month_periode', $request->month_periode)
                                ->where('kb_status_id', 1);
                        })->count(),
            ],
            'mow' => [
                'p' => Couple::whereHas('wife', function (Builder $query) use ($request, $rt) {
                            $query->whereDate('date_of_birth', '<=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-15) ) //koreksi lagi
                                ->whereDate('date_of_birth', '>=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-49) )
                                ->where('rt', $rt)
                                ->where('rw', $request->rw);
                        })->where('is_kb', true)->where('kb_service_id', 1)
                        ->whereHas('keluargaBerencana', function (Builder $query) use ($request) {
                            $query->where('year_periode', $request->year_periode)
                                ->where('month_periode', $request->month_periode)
                                ->where('kb_status_id', 2);
                        })->count(),
                's' => Couple::whereHas('wife', function (Builder $query) use ($request, $rt) {
                            $query->whereDate('date_of_birth', '<=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-15) ) //koreksi lagi
                                ->whereDate('date_of_birth', '>=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-49) )
                                ->where('rt', $rt)
                                ->where('rw', $request->rw);
                        })->where('is_kb', true)->where('kb_service_id', 2)
                        ->whereHas('keluargaBerencana', function (Builder $query) use ($request) {
                            $query->where('year_periode', $request->year_periode)
                                ->where('month_periode', $request->month_periode)
                                ->where('kb_status_id', 2);
                        })->count(),
            ],
            'mop' => [
                'p' => Couple::whereHas('wife', function (Builder $query) use ($request, $rt) {
                            $query->whereDate('date_of_birth', '<=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-15) ) //koreksi lagi
                                ->whereDate('date_of_birth', '>=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-49) )
                                ->where('rt', $rt)
                                ->where('rw', $request->rw);
                        })->where('is_kb', true)->where('kb_service_id', 1)
                        ->whereHas('keluargaBerencana', function (Builder $query) use ($request) {
                            $query->where('year_periode', $request->year_periode)
                                ->where('month_periode', $request->month_periode)
                                ->where('kb_status_id', 3);
                        })->count(),
                's' => Couple::whereHas('wife', function (Builder $query) use ($request, $rt) {
                            $query->whereDate('date_of_birth', '<=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-15) ) //koreksi lagi
                                ->whereDate('date_of_birth', '>=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-49) )
                                ->where('rt', $rt)
                                ->where('rw', $request->rw);
                        })->where('is_kb', true)->where('kb_service_id', 2)
                        ->whereHas('keluargaBerencana', function (Builder $query) use ($request) {
                            $query->where('year_periode', $request->year_periode)
                                ->where('month_periode', $request->month_periode)
                                ->where('kb_status_id', 3);
                        })->count(),
            ],
            'kond' => [
                'p' => Couple::whereHas('wife', function (Builder $query) use ($request, $rt) {
                            $query->whereDate('date_of_birth', '<=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-15) ) //koreksi lagi
                                ->whereDate('date_of_birth', '>=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-49) )
                                ->where('rt', $rt)
                                ->where('rw', $request->rw);
                        })->where('is_kb', true)->where('kb_service_id', 1)
                        ->whereHas('keluargaBerencana', function (Builder $query) use ($request) {
                            $query->where('year_periode', $request->year_periode)
                                ->where('month_periode', $request->month_periode)
                                ->where('kb_status_id', 4);
                        })->count(),
                's' => Couple::whereHas('wife', function (Builder $query) use ($request, $rt) {
                            $query->whereDate('date_of_birth', '<=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-15) ) //koreksi lagi
                                ->whereDate('date_of_birth', '>=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-49) )
                                ->where('rt', $rt)
                                ->where('rw', $request->rw);
                        })->where('is_kb', true)->where('kb_service_id', 2)
                        ->whereHas('keluargaBerencana', function (Builder $query) use ($request) {
                            $query->where('year_periode', $request->year_periode)
                                ->where('month_periode', $request->month_periode)
                                ->where('kb_status_id', 4);
                        })->count(),
            ],
            'imp' => [
                'p' => Couple::whereHas('wife', function (Builder $query) use ($request, $rt) {
                            $query->whereDate('date_of_birth', '<=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-15) ) //koreksi lagi
                                ->whereDate('date_of_birth', '>=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-49) )
                                ->where('rt', $rt)
                                ->where('rw', $request->rw);
                        })->where('is_kb', true)->where('kb_service_id', 1)
                        ->whereHas('keluargaBerencana', function (Builder $query) use ($request) {
                            $query->where('year_periode', $request->year_periode)
                                ->where('month_periode', $request->month_periode)
                                ->where('kb_status_id', 5);
                        })->count(),
                's' => Couple::whereHas('wife', function (Builder $query) use ($request, $rt) {
                            $query->whereDate('date_of_birth', '<=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-15) ) //koreksi lagi
                                ->whereDate('date_of_birth', '>=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-49) )
                                ->where('rt', $rt)
                                ->where('rw', $request->rw);
                        })->where('is_kb', true)->where('kb_service_id', 2)
                        ->whereHas('keluargaBerencana', function (Builder $query) use ($request) {
                            $query->where('year_periode', $request->year_periode)
                                ->where('month_periode', $request->month_periode)
                                ->where('kb_status_id', 5);
                        })->count(),
            ],
            'suntik' => [
                'p' => Couple::whereHas('wife', function (Builder $query) use ($request, $rt) {
                            $query->whereDate('date_of_birth', '<=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-15) ) //koreksi lagi
                                ->whereDate('date_of_birth', '>=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-49) )
                                ->where('rt', $rt)
                                ->where('rw', $request->rw);
                        })->where('is_kb', true)->where('kb_service_id', 1)
                        ->whereHas('keluargaBerencana', function (Builder $query) use ($request) {
                            $query->where('year_periode', $request->year_periode)
                                ->where('month_periode', $request->month_periode)
                                ->where('kb_status_id', 6);
                        })->count(),
                's' => Couple::whereHas('wife', function (Builder $query) use ($request, $rt) {
                            $query->whereDate('date_of_birth', '<=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-15) ) //koreksi lagi
                                ->whereDate('date_of_birth', '>=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-49) )
                                ->where('rt', $rt)
                                ->where('rw', $request->rw);
                        })->where('is_kb', true)->where('kb_service_id', 2)
                        ->whereHas('keluargaBerencana', function (Builder $query) use ($request) {
                            $query->where('year_periode', $request->year_periode)
                                ->where('month_periode', $request->month_periode)
                                ->where('kb_status_id', 6);
                        })->count(),
            ],
            'pil' => [
                'p' => Couple::whereHas('wife', function (Builder $query) use ($request, $rt) {
                            $query->whereDate('date_of_birth', '<=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-15) ) //koreksi lagi
                                ->whereDate('date_of_birth', '>=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-49) )
                                ->where('rt', $rt)
                                ->where('rw', $request->rw);
                        })->where('is_kb', true)->where('kb_service_id', 1)
                        ->whereHas('keluargaBerencana', function (Builder $query) use ($request) {
                            $query->where('year_periode', $request->year_periode)
                                ->where('month_periode', $request->month_periode)
                                ->where('kb_status_id', 7);
                        })->count(),
                's' => Couple::whereHas('wife', function (Builder $query) use ($request, $rt) {
                            $query->whereDate('date_of_birth', '<=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-15) ) //koreksi lagi
                                ->whereDate('date_of_birth', '>=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-49) )
                                ->where('rt', $rt)
                                ->where('rw', $request->rw);
                        })->where('is_kb', true)->where('kb_service_id', 2)
                        ->whereHas('keluargaBerencana', function (Builder $query) use ($request) {
                            $query->where('year_periode', $request->year_periode)
                                ->where('month_periode', $request->month_periode)
                                ->where('kb_status_id', 7);
                        })->count(),
            ],
            'total_pus_kb' => [
                'p' => Couple::whereHas('wife', function (Builder $query) use ($request, $rt) {
                            $query->whereDate('date_of_birth', '<=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-15) ) //koreksi lagi
                                ->whereDate('date_of_birth', '>=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-49) )
                                ->where('rt', $rt)
                                ->where('rw', $request->rw);
                        })->where('is_kb', true)->where('kb_service_id', 1)->count(),
                's' => Couple::whereHas('wife', function (Builder $query) use ($request, $rt) {
                            $query->whereDate('date_of_birth', '<=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-15) ) //koreksi lagi
                                ->whereDate('date_of_birth', '>=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-49) )
                                ->where('rt', $rt)
                                ->where('rw', $request->rw);
                        })->where('is_kb', true)->where('kb_service_id', 2)->count(),
            ],
            'non_kb' => [
                'h' => Couple::whereHas('wife', function (Builder $query) use ($request, $rt) {
                            $query->whereDate('date_of_birth', '<=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-15) ) //koreksi lagi
                                ->whereDate('date_of_birth', '>=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-49) )
                                ->where('rt', $rt)
                                ->where('rw', $request->rw);
                        })->whereHas('keluargaBerencana', function (Builder $query) use ($request) {
                            $query->where('year_periode', $request->year_periode)
                                ->where('month_periode', $request->month_periode)
                                ->where('kb_status_id', 8);
                        })->count(),
                'ias' => Couple::whereHas('wife', function (Builder $query) use ($request, $rt) {
                            $query->whereDate('date_of_birth', '<=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-15) ) //koreksi lagi
                                ->whereDate('date_of_birth', '>=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-49) )
                                ->where('rt', $rt)
                                ->where('rw', $request->rw);
                        })->whereHas('keluargaBerencana', function (Builder $query) use ($request) {
                            $query->where('year_periode', $request->year_periode)
                                ->where('month_periode', $request->month_periode)
                                ->where('kb_status_id', 9);
                        })->count(),
                'iat' => Couple::whereHas('wife', function (Builder $query) use ($request, $rt) {
                            $query->whereDate('date_of_birth', '<=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-15) ) //koreksi lagi
                                ->whereDate('date_of_birth', '>=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-49) )
                                ->where('rt', $rt)
                                ->where('rw', $request->rw);
                        })->whereHas('keluargaBerencana', function (Builder $query) use ($request) {
                            $query->where('year_periode', $request->year_periode)
                                ->where('month_periode', $request->month_periode)
                                ->where('kb_status_id', 10);
                        })->count(),
                'tial' => Couple::whereHas('wife', function (Builder $query) use ($request, $rt) {
                                $query->whereDate('date_of_birth', '<=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-15) ) //koreksi lagi
                                    ->whereDate('date_of_birth', '>=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-49) )
                                    ->where('rt', $rt)
                                    ->where('rw', $request->rw);
                            })->whereHas('keluargaBerencana', function (Builder $query) use ($request) {
                                $query->where('year_periode', $request->year_periode)
                                    ->where('month_periode', $request->month_periode)
                                    ->where('kb_status_id', 11);
                            })->count(),
            ],
            'total_pus_non_kb' => Couple::whereHas('wife', function (Builder $query) use ($request, $rt) {
                                    $query->whereDate('date_of_birth', '<=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-15) ) //koreksi lagi
                                        ->whereDate('date_of_birth', '>=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-49) )
                                        ->where('rt', $rt)
                                        ->where('rw', $request->rw);
                                })->where('is_kb', false)->count(),
            'tahapan_ks' => [
                'seluruh_ks' => Couple::whereHas('wife', function (Builder $query) use ($request, $rt) {
                                    $query->whereDate('date_of_birth', '<=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-15) ) //koreksi lagi
                                        ->whereDate('date_of_birth', '>=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-49) )
                                        ->where('rt', $rt)
                                        ->where('rw', $request->rw)
                                        ->whereHas('family', function (Builder $query) {
                                            $query->whereIn('keluarga_sejahtera_id', [3,4,5]);
                                        });
                                })->count(),
                'kps' => Couple::whereHas('wife', function (Builder $query) use ($request, $rt) {
                            $query->whereDate('date_of_birth', '<=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-15) ) //koreksi lagi
                                ->whereDate('date_of_birth', '>=', Carbon::createFromDate($request->year_periode, $request->month_periode)->addYears(-49) )
                                ->where('rt', $rt)
                                ->where('rw', $request->rw)
                                ->whereHas('family', function (Builder $query) {
                                    $query->whereIn('keluarga_sejahtera_id', [1, 2]);
                                });
                        })->count(),
            ],
        ];
    }
}
