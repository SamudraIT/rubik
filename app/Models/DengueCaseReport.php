<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DengueCaseReport extends Model
{
    use HasFactory;

    protected $table = 'dengue_case_reports';

    protected $fillable = [
        "patient_name",
        "patient_status",
        "report_status",
        "diseases_symptom",
        "phone_number",
        "confirmation_date",
        "recovery_date",
        "phone_number",
        "hospital_id",
        "user_id",
        "district_id"
    ];

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}