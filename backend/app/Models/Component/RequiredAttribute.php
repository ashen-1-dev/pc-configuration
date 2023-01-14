<?php

namespace App\Models\Component;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequiredAttribute extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        'list' => 'array',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
