<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LarvalSurveillanceRecord extends Model
{
    use HasFactory;

    protected $table = "larval_surveillance_records";

    protected $fillable = [
        "reporter_name",
        "location",
        "public_facilities",
        "reported_date",
        "ovitrap_ownership",
        "image",
        "reporter_code",
        "user_id",
        "district_id"
    ];

    public function keberadaanJentik(): HasMany
    {
        return $this->hasMany(LarvaLocationRecord::class, 'reporter_code', 'reporter_code');
    }
}
