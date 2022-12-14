<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Support\Facades\Storage;

/**
 * @property mixed $title
 * @property mixed|string $image
 * @property mixed $brand_model_id
 * @property mixed $chassis_number
 * @property mixed $details
 */
class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = ['brand_model_id', 'chassis_number', 'title', 'details', 'image'];

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        self::deleting(function (Vehicle $vehicle) {
            Storage::delete($vehicle->getRawOriginal('image'));
        });
    }

    public function brandModel(): BelongsTo
    {
        return $this->belongsTo(BrandModel::class);
    }
}
