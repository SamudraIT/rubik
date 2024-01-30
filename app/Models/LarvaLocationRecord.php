<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LarvaLocationRecord extends Model
{
    use HasFactory;

    protected $table = "larva_location_records";

    protected $fillable = [
        "larva_location",
        "status",
        "reporter_code"
    ];
}
