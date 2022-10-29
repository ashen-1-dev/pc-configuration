<?php

namespace App\Models\Components;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Components\Attribute
 *
 * @property-read \App\Models\Components\Component|null $components
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute query()
 * @mixin \Eloquent
 */
class Attribute extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'component_attributes';
    protected $fillable = [
        'name'
    ];

    public function components()
    {
        return $this->belongsTo(Component::class);
    }

}
