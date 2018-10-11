<?php

namespace App\Models;

use App\Traits\UserCanBeFollowed;
use App\Traits\UserCanBeLiked;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Rennokki\Befriended\Contracts\Followable;
use Rennokki\Befriended\Contracts\Likeable;
use Rinvex\Attributes\Traits\Attributable;

class Wheel extends Model implements Followable, Likeable
{

    use UserCanBeFollowed;
    use UserCanBeLiked;
    use Attributable;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'brand_id',
        'collection_id',
        'style_id',
        'image_id',
        'customized',
        'activated',
        'retired',
    ];

    /**
     * @return BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * @return BelongsTo
     */
    public function style(): BelongsTo
    {
        return $this->belongsTo(Style::class);
    }

    /**
     * @return BelongsTo
     */
    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }

}
