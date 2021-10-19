<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    
    public function manager() {
        return $this->hasOne(Employee::class, 'id', 'superior_id');
    }
}
