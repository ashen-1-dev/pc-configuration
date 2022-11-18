<?php

namespace App\Models\Component;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Type extends Model
{
    use HasFactory;

    protected $table = 'component_types';

    public function components()
    {
        return $this->hasMany(Component::class);
    }

    public function requiredAttributes()
    {
        return $this->hasMany(RequiredAttribute::class, 'component_type_id');
    }
}
