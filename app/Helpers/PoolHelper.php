<?php

namespace App\Helpers;

use App\Models\Worker;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PoolHelper
{
    public function updateWorker($arrayWorker): void
    {
        try {

            $workers = Worker::query()
                ->get();

            foreach ($workers as $worker) {
                if (
                    $worker->worker_id !== $arrayWorker['worker_id']
                    || $worker->worker_name !== $arrayWorker['worker_name']
                    || $worker->hashrate !== $arrayWorker['shares_1d']
                    || $worker->reject !== $arrayWorker['reject_percent']
                    || $worker->date !== $arrayWorker['last_share_time']
                ) {

                    $worker->worker_id   = $arrayWorker['worker_id'];
                    $worker->worker_name = $arrayWorker['worker_name'];
                    $worker->hashrate    = $arrayWorker['shares_1d'];
                    $worker->reject      = $arrayWorker['reject_percent'];
                    $worker->date        = $arrayWorker['last_share_time'];

                    $worker->update();

                }
            }

        } catch (\Exception $e) {
            return;
        }
    }

    public function saveWorker($arrayWorkers): void
    {
        try {
            foreach ($arrayWorkers as $arrayWorker) {

                $worker = new Worker();

                $worker->worker_id   = $arrayWorker['worker_id'];
                $worker->worker_name = $arrayWorker['worker_name'];
                $worker->hashrate    = $arrayWorker['shares_1d'];
                $worker->reject      = $arrayWorker['reject_percent'];
                $worker->date        = Carbon::createFromTimestamp($arrayWorker['last_share_time'])->format('Y-m-d');

                $worker->save();
            }
        } catch (\Exception $e) {
            return;
        }
    }

    public function count($rate, $consumption): float|\Exception|int
    {
        try {
            $worker = Worker::query()
                ->pluck('hashrate')
                ->toArray();

            $result = self::calculate($worker, $rate, $consumption);

            return array_sum($result);

        } catch (\Exception $e) {
            return $e;
        }
    }

    public function countByDate($rate, $consumption, $dates): mixed
    {
        try {
            $arrWorkers = array();
            foreach ($dates as $date){
                $worker = Worker::query()
                    ->where('date', $date)
                    ->pluck('hashrate');
                $arrWorkers = $worker;
            }

            return self::calculate($arrWorkers->toArray(), $rate, $consumption);

        } catch (\Exception $e) {
            return $e;
        }
    }

    protected function calculate($worker, $consumption, $rate)
    {
        array_walk($worker,
            function (&$value)
            use ($consumption, $rate) {
                $value = $value * ($rate * $consumption * 24 / 13.5);
            });

        return $worker;
    }

}
