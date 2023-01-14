<?php

namespace App\Models\Component;

use App\Filters\Component\ComponentFilter;
use App\Filters\SpecialistCatalog\SpecialistFilter;
use App\Http\Controllers\Component\dto\ComponentQuery;
use App\Models\Build\Build;
use Illuminate\Database\Eloquent\Builder;
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

    public function scopeFilter(Builder $query, ComponentQuery $componentQuery): Builder
    {
        return (new ComponentFilter($componentQuery))->apply($query);
    }
}
