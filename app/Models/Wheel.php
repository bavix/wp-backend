<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Rennokki\Befriended\Contracts\Followable;
use Rennokki\Befriended\Traits\CanBeFollowed;
use Rennokki\Befriended\Traits\CanBeLiked;
use Rinvex\Attributes\Traits\Attributable;

class Wheel extends Model implements Followable
{

    use Attributable;
    use CanBeFollowed;
    use CanBeLiked;

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
