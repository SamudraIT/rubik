<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class District extends Model
{
    use HasFactory;

    protected $table = "districts";

    protected $fillable = [
        "name"
    ];

    public function sub_district(): HasMany
    {
        return $this->hasMany(SubDistrict::class, 'district_id', 'id');
    }
}
