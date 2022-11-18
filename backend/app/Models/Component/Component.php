<?php

namespace App\Models\Component;

use App\Models\Build;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Component extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type_id',
        'photo_url'
    ];

    public function builds()
    {
        return $this->belongsToMany(Build::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }
}
