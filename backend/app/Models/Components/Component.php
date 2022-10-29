<?php

namespace App\Models\Components;

use App\Models\Build;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Components\Component
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Components\Attribute[] $attributes
 * @property-read int|null $attributes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Build[] $builds
 * @property-read int|null $builds_count
 * @property-read \App\Models\Components\Type|null $type
 * @method static \Illuminate\Database\Eloquent\Builder|Component newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Component newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Component query()
 * @mixin \Eloquent
 */
class Component extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type_id',
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
