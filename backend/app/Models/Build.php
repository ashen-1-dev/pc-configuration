<?php

namespace App\Models;

use App\Models\Components\Component;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Build
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|Component[] $components
 * @property-read int|null $components_count
 * @method static \Illuminate\Database\Eloquent\Builder|Build newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Build newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Build query()
 * @mixin \Eloquent
 */
class Build extends Model
{
    use HasFactory;

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
