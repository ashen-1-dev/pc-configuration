<?php

// @formatter:off

/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models {
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
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Component\Component[] $components
     * @property-read int|null $components_count
     * @property-read \App\Models\User\User $user
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
     */
    class Build extends \Eloquent
    {
    }
}

namespace App\Models\Component {
    /**
     * App\Models\Components\Attribute
     *
     * @property int $id
     * @property string $name
     * @property string $value
     * @property int $component_id
     * @property-read \App\Models\Component\Component $components
     * @method static \Illuminate\Database\Eloquent\Builder|Attribute newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Attribute newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Attribute query()
     * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereComponentId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereValue($value)
     */
    class Attribute extends \Eloquent
    {
    }
}

namespace App\Models\Component {
    /**
     * App\Models\Components\Component
     *
     * @property int $id
     * @property string $name
     * @property string|null $description
     * @property string|null $photo_url
     * @property int|null $type_id
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Component\Attribute[] $attributes
     * @property-read int|null $attributes_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Build[] $builds
     * @property-read int|null $builds_count
     * @property-read \App\Models\Component\Type|null $type
     * @method static \Illuminate\Database\Eloquent\Builder|Component newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Component newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Component query()
     * @method static \Illuminate\Database\Eloquent\Builder|Component whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Component whereDescription($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Component whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Component whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Component wherePhotoUrl($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Component whereTypeId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Component whereUpdatedAt($value)
     */
    class Component extends \Eloquent
    {
    }
}

namespace App\Models\Component {
    /**
     * App\Models\Components\RequiredAttribute
     *
     * @property int $id
     * @property int $component_type_id
     * @property string $name
     * @property-read \App\Models\Component\Type $type
     * @method static \Illuminate\Database\Eloquent\Builder|RequiredAttribute newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|RequiredAttribute newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|RequiredAttribute query()
     * @method static \Illuminate\Database\Eloquent\Builder|RequiredAttribute whereComponentTypeId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|RequiredAttribute whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|RequiredAttribute whereName($value)
     */
    class RequiredAttribute extends \Eloquent
    {
    }
}

namespace App\Models\Component {
    /**
     * App\Models\Components\Type
     *
     * @property int $id
     * @property string $name
     * @property int|null $required
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Component\Component[] $components
     * @property-read int|null $components_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Component\RequiredAttribute[] $requiredAttributes
     * @property-read int|null $required_attributes_count
     * @method static \Illuminate\Database\Eloquent\Builder|Type newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Type newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Type query()
     * @method static \Illuminate\Database\Eloquent\Builder|Type whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Type whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Type whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Type whereRequired($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Type whereUpdatedAt($value)
     */
    class Type extends \Eloquent
    {
    }
}

namespace App\Models\User {
    /**
     * App\Models\Users\Role
     *
     * @property int $id
     * @property string $name
     * @property string|null $description
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User\User[] $users
     * @property-read int|null $users_count
     * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Role query()
     * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Role whereDescription($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
     */
    class Role extends \Eloquent
    {
    }
}

namespace App\Models\User {
    /**
     * App\Models\Users\User
     *
     * @property int $id
     * @property string $first_name
     * @property string $last_name
     * @property string $email
     * @property \Illuminate\Support\Carbon|null $email_verified_at
     * @property string $password
     * @property string|null $remember_token
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Build[] $builds
     * @property-read int|null $builds_count
     * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
     * @property-read int|null $notifications_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User\Role[] $roles
     * @property-read int|null $roles_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
     * @property-read int|null $tokens_count
     * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|User query()
     * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
     */
    class User extends \Eloquent
    {
    }
}

