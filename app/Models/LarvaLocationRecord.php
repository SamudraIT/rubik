<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LarvaLocationRecord extends Model
{
    use HasFactory;

    protected $table = "larva_location_records";

    protected $fillable = [
        "larva_location",
        "status",
        "reporter_code",
        "larval_surveillance_record_id"
    ];

    public function pencatatanJentik(): BelongsTo
    {
        return $this->belongsTo(LarvalSurveillanceRecord::class, 'larval_surveillance_record_id');
    }
}
