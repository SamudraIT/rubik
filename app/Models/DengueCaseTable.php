<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DengueCaseTable extends Model
{
    use HasFactory;

    protected $table = "dengue_case_tables";

    protected $fillable = [
        "district",
        "sub_district",
        "rw",
        "dengue_case_report_id"
    ];
}
