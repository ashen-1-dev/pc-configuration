<?php

namespace App\Models;

use App\Models\Components\Component;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Build
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $is_ready
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Component[] $components
 * @property-read int|null $components_count
 * @method static \Illuminate\Database\Eloquent\Builder|Build newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Build newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Build query()
 * @method static \Illuminate\Database\Eloquent\Builder|Build whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Build whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Build whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Build whereIsReady($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Build whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Build whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Build whereUserId($value)
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
