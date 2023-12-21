<?php

namespace App\Models;

use App\Services\CryptoJsAesEncryptionService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;
    public const EXCERPT_LENGTH = 200;
    protected $table = 'posts';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'excerpt',
        'body',
        'slug',
        'user_id',
        'image',
        'published',
        'published_at',
    ];
    protected $casts = [
        'published' => 'boolean',
        'published_at' => 'datetime',
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
    /**
     * Get the decrypted title attribute.
     *
     * This method is an accessor for the 'title' attribute.
     * It uses the CryptoJsAesEncryptionService to automatically decrypt the 'title' attribute.
     *
     * @return string The decrypted title.
     */
    public function getTitleAttribute(): string
    {
        return CryptoJsAesEncryptionService::autoDecrypt($this->attributes['title']);
    }
    /**
     * Get the decrypted slug attribute.
     *
     * This method is an accessor for the 'slug' attribute.
     * It uses the CryptoJsAesEncryptionService to automatically decrypt the 'slug' attribute.
     *
     * @return string The decrypted slug.
     */
    public function getSlugAttribute(): string
    {
        return CryptoJsAesEncryptionService::autoDecrypt($this->attributes['slug']);
    }
    /**
     * Get the decrypted body attribute.
     *
     * This method is an accessor for the 'body' attribute.
     * It uses the CryptoJsAesEncryptionService to automatically decrypt the 'body' attribute.
     *
     * @return string The decrypted body.
     */
    public function getBodyAttribute(): string
    {
        return CryptoJsAesEncryptionService::autoDecrypt($this->attributes['body']);
    }
    /**
     * Get the decrypted excerpt attribute.
     *
     * This method is an accessor for the 'excerpt' attribute.
     * It uses the CryptoJsAesEncryptionService to automatically decrypt the 'excerpt' attribute.
     *
     * @return string The decrypted excerpt.
     */
    public function getExcerptAttribute(): string
    {
        return CryptoJsAesEncryptionService::autoDecrypt($this->attributes['excerpt']);
    }
    /**
     * Get the decrypted excerpt attribute.
     *
     * This method is an accessor for the 'image' attribute.
     * It uses the CryptoJsAesEncryptionService to automatically decrypt the 'image' attribute.
     *
     * @return string The decrypted image path.
     */
    public function getImageAttribute(): string
    {
        return CryptoJsAesEncryptionService::autoDecrypt($this->attributes['image']);
    }
    /**
     * Apply filters to the query.
     *
     * This method is a scope method for the Post model. Scope methods provide a convenient way to add constraints to all queries for the model.
     * The method takes two parameters: the query builder instance and an array of filters.
     * It uses the 'when' method of the query builder to conditionally add a where clause to the query.
     * The 'when' method takes two parameters: a value and a closure. The closure will be executed if the value is truthy.
     * In this case, the value is the 'search' key of the filters array. If the 'search' key is set and its value is truthy, the closure will be executed.
     * The closure adds a where clause to the query that checks if the 'title', 'body', or 'excerpt' of the post contains the search term.
     *
     * @param Builder $query The query builder instance.
     * @param array $filters The filters to apply to the query.
     * @return void
     */
    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%')
                    ->orWhere('excerpt', 'like', '%' . $search . '%')
                    ->orWhere('user_id', 'like', '%' . $search . '%');
            });
        });
        $query->when($filters['author'] ?? false, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('user_id', 'like', '%' . $search . '%');
            });
        });
    }
    /**
     * Define the relationship between the Post and User models.
     *
     * This method defines a one-to-many relationship between the Post and User models.
     * It indicates that each post belongs to a user.
     * The relationship is defined by the 'user_id' foreign key in the posts table.
     *
     * @return BelongsTo The relationship between the Post and User models.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    /**
     * Define the relationship between the Post and Category models.
     *
     * This method defines a many-to-many relationship between the Post and Category models.
     * It indicates that each post can belong to multiple categories and each category can have multiple posts.
     * The relationship is defined by a pivot table 'category_post'.
     * The 'withTimestamps' method indicates that the pivot table includes timestamp fields.
     *
     * @return BelongsToMany The relationship between the Post and Category models.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)
            ->withTimestamps();
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
