<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    //Получаем авто связаное с водителем
    public function car(): HasOne
    {
        return $this->hasOne(Car::class);
    }
}
