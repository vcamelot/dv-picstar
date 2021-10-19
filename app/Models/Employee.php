<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'superior_id',
        'start_date',
        'end_date'
    ];

    public function manager() {
        return $this->hasOne(Employee::class, 'id', 'superior_id');
    }
}
