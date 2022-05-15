<?php

namespace App\Models\Components;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    public function components()
    {
        return $this->belongsToMany(Component::class, 'component_attribute_value');
    }
}
