<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LarvaRecordTable extends Model
{
    use HasFactory;

    protected $table = "larva_record_tables";

    protected $fillable = [
        "district",
        "sub_district",
        "rw",
        "larval_surveillance_record_id"
    ];
}
