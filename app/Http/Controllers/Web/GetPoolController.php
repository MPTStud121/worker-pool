<?php

namespace App\Http\Controllers\Web;

use App\Helpers\PoolHelper;
use App\Http\Controllers\Controller;
use App\Models\Worker;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class GetPoolController extends Controller
{
    public function getPool(Request $request): View|Factory|\Exception|Application
    {
        try {
            $rate        = $request->input('rate');
            $consumption = $request->input('consumption');

            //dd((new PoolHelper())->countByDate($rate, $consumption, (new Worker)->getDate()));

            return view('getpool', [
                'result'        => (new PoolHelper)->count($rate, $consumption),
                'dates'         => (new Worker)->getDate(),
                'workers'       => (new Worker)->getWorkers(),
                'resultByDates' => (new PoolHelper())->countByDate($rate, $consumption, (new Worker)->getDate())
            ]);

        } catch (\Exception $e) {
            return $e;
        }
    }
}
