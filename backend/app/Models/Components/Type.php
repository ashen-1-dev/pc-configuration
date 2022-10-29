<?php

namespace App\Models\Components;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Components\Type
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Components\Component[] $components
 * @property-read int|null $components_count
 * @method static \Illuminate\Database\Eloquent\Builder|Type newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Type newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Type query()
 * @mixin \Eloquent
 */
class Type extends Model
{
    use HasFactory;

    protected $table = 'component_types';

    public function components()
    {
        return $this->hasMany(Component::class);
    }
}
