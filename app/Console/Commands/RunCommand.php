<?php

namespace App\Console\Commands;

use App\Models\Car;
use App\Models\Timing;
use App\Models\Worker;
use App\Services\CarService;
use Illuminate\Console\Command;
use Illuminate\Database\Query\Builder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\FreeCarResource;

class RunCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //$cars = new CarService();
        //$cars = $cars->getCars(6);

        dump(Car::find(5)->driver->toArray());
//        $dt = Carbon::now()->addHour(3);
//        $worker_id = 6;
//        $free= array();
//        $rules = Worker::find($worker_id)->rule;
//        foreach ($rules as $rule) {
//            if(!count(Timing::query()
//                ->where('car_id', $rule->car_id)
//                ->where('start', '<', $dt)
//                ->where('end', '>', $dt)
//                ->get())) {
//                $free[] = $rule->car_id;
//            }
//        }
//        dump($free);
    }

}
