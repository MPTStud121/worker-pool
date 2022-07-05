<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Worker
 *
 * @property int                             $id
 * @property int                             $worker_id
 * @property string                          $worker_name
 * @property string                          $date
 * @property $hashrate
 * @property string                          $reject
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Worker newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Worker newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Worker query()
 * @method static \Illuminate\Database\Eloquent\Builder|Worker whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Worker whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Worker whereHashrate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Worker whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Worker whereReject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Worker whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Worker whereWorkerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Worker whereWorkerName($value)
 * @mixin \Eloquent
 */
class Worker extends Model
{
    use HasFactory;

    protected $fillable
        = [
            'id',
            'worker_id',
            'worker_name',
            'date',
            'hashrate',
            'reject'
        ];

    public function getDate(): array
    {
        $date = Worker::query()
            ->distinct('date')
            ->get();

        return $date
            ->unique('date')
            ->pluck('date')
            ->toArray();

    }

    public function getWorkers(): \Illuminate\Database\Eloquent\Collection|array
    {
        $worker = Worker::query()
            ->distinct('worker_id')
            ->get();

        return $worker->unique('worker_id');
    }

}
