<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Services\CryptoJsAesEncryptionService;
use DateTime;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'about_me',
        'city',
        'country',
        'birthdate',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];
    /**
     * Convert the model instance to an array.
     *
     * This method overrides the default toArray() method provided by Laravel's Eloquent ORM.
     * It first calls the parent toArray() method to convert the model instance to an array, including all of its loaded relationships.
     * Then it loops over all the mutated attributes of the model. Mutated attributes are those that have an accessor or a mutator defined in the model.
     * If a mutated attribute is not already present in the array, it adds the attribute to the array by accessing it as a property of the model instance.
     * This will trigger the accessor for the attribute, if one is defined, and the decrypted value of the attribute will be added to the array.
     * Finally, it returns the array, which now includes the decrypted values of the mutated attributes.
     *
     * @return array The array representation of the model.
     */
    public function toArray(): array
    {
        $array = parent::toArray();
        foreach ($this->getMutatedAttributes() as $key)
        {
            if ( ! array_key_exists($key, $array)) {
                $array[$key] = $this->{$key};
            }
        }
        return $array;
    }
    public function getNameAttribute(): string
    {
        return CryptoJsAesEncryptionService::autoDecrypt($this->attributes['name']);
    }
    public function getAboutMeAttribute(): string
    {
        return CryptoJsAesEncryptionService::autoDecrypt($this->attributes['about_me']);
    }
    public function getCityAttribute(): string
    {
        return CryptoJsAesEncryptionService::autoDecrypt($this->attributes['city']);
    }
    public function getCountryAttribute(): string
    {
        return CryptoJsAesEncryptionService::autoDecrypt($this->attributes['country']);
    }
    public function getBirthdateAttribute(): string
    {
        $decrypted_date = CryptoJsAesEncryptionService::autoDecrypt($this->attributes['birthdate']);
        return Carbon::createFromFormat('Y-m-d', $decrypted_date)->format('Y-m-d');
    }

    /**
     * @throws Exception
     */
    public function getAgeAttribute(): int
    {
        $birthdate = new DateTime($this->birthdate);
        $today = new DateTime('today');
        return $birthdate->diff($today)->y;
    }
    /**
     * Define the relationship between the User and Post models.
     *
     * This method defines a one-to-many relationship between the User and Post models.
     * It indicates that a user can have multiple posts.
     *
     * @return HasMany The relationship between the User and Post models.
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
