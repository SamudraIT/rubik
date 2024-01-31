<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        "district_id",
        "hospital_id",
        "user_id"
    ];

    public function districts(): HasMany
    {
        return $this->hasMany(District::class, 'district_id', 'id');
    }
}
