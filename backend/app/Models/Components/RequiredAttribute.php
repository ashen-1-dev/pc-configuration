<?php

namespace App\Models\Components;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequiredAttribute extends Model
{
    use HasFactory;

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
