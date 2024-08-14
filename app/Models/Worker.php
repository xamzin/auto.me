<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Worker extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position_id',
    ];

    public function rule(): HasMany {
        return $this->HasMany(RuleUseCar::class, 'position_id', 'position_id');
    }
}
