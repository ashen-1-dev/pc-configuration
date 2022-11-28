<?php

namespace App\Models\Build;

use App\Models\Component\Component;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Build extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'is_ready',
        'user_id'
    ];

    protected $attributes = [
        'is_ready' => false
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function components()
    {
        return $this->belongsToMany(Component::class);
    }

    public function addComponent($componentId)
    {
        $this->components()->attach($componentId);
    }

    public function removeComponent($componentId)
    {
        $this->components()->detach($componentId);
    }
}
