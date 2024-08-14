<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'model', 'comfort', 'comfort_name',
        'driver_id',
    ];

    protected $visible = [
        'id', 'model', 'comfort', 'comfort_name',
    ];

    //получает водителя связанного с авто
    public function driver(): BelongsTo {
        return $this->BelongsTo(Driver::class);
    }
}
