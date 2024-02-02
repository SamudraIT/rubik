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
        "rw",
        "phone_number",
        "is_confirm",
        "hospital_id",
        "user_id",
        "sub_district_id"
    ];

    public function subDistrict(): BelongsTo
    {
        return $this->belongsTo(SubDistrict::class, 'sub_district_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function dengueTable(): HasMany
    {
        return $this->hasMany(DengueCaseTable::class, 'id', 'dengue_case_report_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleted(function (DengueCaseReport $record) {
            $record->dengueTable()->where('dengue_case_report_id', $record->id)
                ->delete();
        });
    }
}
