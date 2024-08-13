<?php

namespace App\Console\Commands;

use App\Models\Worker;
use App\Models\Car;
use App\Models\Driver;
use App\Models\Rule;
use Illuminate\Console\Command;

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

        $rules = Worker::find(2)->rule;
        foreach ($rules as $rule) {
            echo Car::find($rule->car_id)->name . "->" . Car::find($rule->car_id)->driver->name . "\n";
        }
        //dump(Worker::find(2)->rule);
    }

}
