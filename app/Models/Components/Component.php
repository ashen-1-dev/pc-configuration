<?php

namespace App\Models\Components;

use App\Models\Build;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;

    public function builds()
    {
        return $this->belongsToMany(Build::class);
    }

    public function type()
    {
        return $this->hasOne(Type::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'component_attribute_value');
    }
}
