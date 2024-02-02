<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profile extends Model
{
    use HasFactory;

    protected $table = "profiles";

    protected $fillable = [
        "card_number",
        "rt",
        "rw",
        "address",
        "place_status",
        "healthcare_professional",
        "sub_district_id",
        "hospital_id",
        "user_id"
    ];

    public function subDistricts(): HasMany
    {
        return $this->hasMany(SubDistrict::class, 'sub_district_id', 'id');
    }

    public function subDistrict(): BelongsTo
    {
        return $this->belongsTo(SubDistrict::class, 'sub_district_id');
    }
}
