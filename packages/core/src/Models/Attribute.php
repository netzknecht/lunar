<?php

namespace Lunar\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Lunar\Base\BaseModel;
use Lunar\Base\Traits\HasMacros;
use Lunar\Base\Traits\HasTranslations;
use Lunar\Database\Factories\AttributeFactory;
use Lunar\Facades\DB;

/**
 * @property int $id
 * @property string $attribute_type
 * @property int $attribute_group_id
 * @property int $position
 * @property string $name
 * @property string $handle
 * @property string $section
 * @property string $type
 * @property bool $required
 * @property ?string $default_value
 * @property string $configuration
 * @property bool $system
 * @property string $validation_rules
 * @property bool $filterable
 * @property bool $searchable
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 */
class Attribute extends BaseModel
{
    use HasFactory;
    use HasMacros;
    use HasTranslations;

    /**
     * Define which attributes should be
     * protected from mass assignment.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Define which attributes should be cast.
     *
     * @var array
     */
    protected $casts = [
        'name' => AsCollection::class,
        'configuration' => AsCollection::class,
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'system' => 0,
        'required' => 0,
    ];
    
    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        /**
         * Handle the model's "saving" event.
         */
        static::saving(function (Attribute $attribute) {
            /**
             * If position is invalid set position to max value + 1
             */
            if (!($attribute->position > 0) || Attribute::where([
                ['id', '!=', $attribute->id],
                ['attribute_type', '=', $attribute->attribute_type],
                ['attribute_group_id', '=', $attribute->attribute_group_id],
                ['position', '=', $attribute->position],
            ])->exists()) {
                $attribute->position = Attribute::where([
                    ['attribute_type', '=', $attribute->attribute_type],
                    ['attribute_group_id', '=', $attribute->attribute_group_id],
                ])->max('position') + 1;
            }
        });
        /**
         * Handle the model's "deleting" event.
         */
        static::deleting(function (Attribute $attribute) {
            /**
             * Delete attributables
             */
            DB::table(
                config('lunar.database.table_prefix').'attributables'
            )->where('attribute_id', '=', $attribute->id)->delete();
        });
    }

    /**
     * Return a new factory instance for the model.
     */
    protected static function newFactory(): AttributeFactory
    {
        return AttributeFactory::new();
    }

    /**
     * Return the attribuable relation.
     */
    public function attributable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Returns the attribute group relation.
     */
    public function attributeGroup(): BelongsTo
    {
        return $this->belongsTo(AttributeGroup::class);
    }

    /**
     * Apply the system scope to the query builder.
     *
     * @param  string  $type
     * @return void
     */
    public function scopeSystem(Builder $query, $type)
    {
        return $query->whereAttributeType($type)->whereSystem(true);
    }
}
