<?php

namespace App\Console\Commands;

use App\Models\Timing;
use App\Models\Worker;
use App\Models\Car;
use App\Models\Driver;
use App\Models\Rule;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Carbon\Carbon;

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
        //Тут код для тестирования
        //$car = Car::find(5)->driver;
        //$driver = Driver::find(5)->car;
        //$rule = Rule::find(10)->car;
        //$car = Car::find(5)->rule;

        $timing = Timing::find();
        dump($timing);

//        for ($i = 1; $i <= 10; $i++) {
//            $dt = Carbon::now()->addHour(rand(1, 100))->roundMinute();
//            echo $dt . " - " . $dt->addHour(rand(1,4)) . "\n";
//        }
//        $cars = null;
//        $rules = Worker::find(2)->rule;
//        foreach ($rules as $rule) {
//            $cars[] = $rule->car_id;
//        }
//        echo is_array($cars) ? Arr::random($cars) . "\n" : "Нет подходящих авто";
        //echo $rules[0]->car_id;
//        foreach ($rules as $rule) {
//            echo Car::find($rule->car_id)->name . " -> " . Car::find($rule->car_id)->comfort . " -> " . Car::find($rule->car_id)->driver->name . "\n";
//        }
        //dump(Worker::find(2)->rule);
    }

}
