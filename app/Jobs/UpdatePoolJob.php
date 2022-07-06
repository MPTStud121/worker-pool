<?php

namespace App\Jobs;

use App\Helpers\PoolHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class UpdatePoolJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        try {
            $response = Http::get(config('constants.BTC_POOL_BASE_URL'));

            $arrayWorkers = $response->json(['data', 'data']);

            (new PoolHelper)->saveWorker($arrayWorkers);
            (new PoolHelper)->updateWorker($arrayWorkers);

        }catch (\Exception $e){
            return $e;
        }
    }
}
