<?php

namespace App\Models\Component;

use App\Filters\Component\ComponentFilter;
use App\Http\Controllers\Component\dto\ComponentQuery;
use App\Models\Build\Build;
use App\Traits\HasAvatar;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Component extends Model implements HasMedia
{
    use HasFactory;
    use HasAvatar;
    use InteractsWithMedia;

    public function __construct(array $attributes = [])
    {
        $this->hasDefaultAvatar = false;
        parent::__construct($attributes);
    }

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

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('avatar')
            ->singleFile();
    }

    public function scopeFilter(Builder $query, ComponentQuery $componentQuery): Builder
    {
        return (new ComponentFilter($componentQuery))->apply($query);
    }
}
