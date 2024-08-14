<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'driver_id', 'comfort_id'
    ];

    protected $visible = [
        'id', 'model',
    ];

    //получает водителя связанного с авто
    public function driver(): BelongsTo {
        return $this->BelongsTo(Driver::class);
    }

    //получает категорию комфорта связанного с авто
    public function comfort(): BelongsTo {
        return $this->BelongsTo(Comfort::class);
    }
}
