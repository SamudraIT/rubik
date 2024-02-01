<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        "rw",
        "reporter_code",
        "user_id",
        "district_id"
    ];

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function keberadaanJentik(): HasMany
    {
        return $this->hasMany(LarvaLocationRecord::class, 'reporter_code', 'reporter_code');
    }

    public function larveTable(): HasMany
    {
        return $this->hasMany(LarvaRecordTable::class, 'id', 'larval_surveillance_record_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleted(function (LarvalSurveillanceRecord $record) {
            $record->keberadaanJentik()->where('reporter_code', $record->reporter_code)
                ->delete();
            $record->larveTable()->where('larval_surveillance_record_id', $record->id)
                ->delete();
        });
    }
}
