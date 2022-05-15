<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\User
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
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Users\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Users\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Users\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|Users\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users\User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users\User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

