<?php

namespace App\Models\Component;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Attribute extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'component_attributes';
    protected $fillable = [
        'name',
        'value',
        'component_id'
    ];

    public function components()
    {
        return $this->belongsTo(Component::class, 'component_id', 'id');
    }
}
