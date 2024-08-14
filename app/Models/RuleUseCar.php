<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RuleUseCar extends Model
{
    use HasFactory;

    protected $fillable = [
        'position_id', 'car_id',
    ];

    public function car(): BelongsTo {
        return $this->BelongsTo(Car::class);
    }
}
