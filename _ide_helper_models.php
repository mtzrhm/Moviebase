<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int $year
 * @property string|null $released_at
 * @property int $runtime
 * @property string $genre
 * @property string $plot
 * @property array<array-key, mixed>|null $languages
 * @property string|null $poster
 * @property string $imdb_rating
 * @property string $imdb_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UserRating> $ratings
 * @property-read int|null $ratings_count
 * @method static \Database\Factories\MovieFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie whereGenre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie whereImdbId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie whereImdbRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie whereLanguages($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie wherePlot($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie wherePoster($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie whereReleasedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie whereRuntime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie whereYear($value)
 */
	class Movie extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UserRating> $ratings
 * @property-read int|null $ratings_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $movie_id
 * @property float $rating
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Movie $movie
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\UserRatingFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserRating newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserRating newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserRating query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserRating whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserRating whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserRating whereMovieId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserRating whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserRating whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserRating whereUserId($value)
 */
	class UserRating extends \Eloquent {}
}

