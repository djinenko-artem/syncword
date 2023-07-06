<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_title',
        'event_start_date',
        'event_end_date',
        'organization_id',
    ];

    public function organization()
    {
        return $this->belongsTo(User::class, 'organization_id', 'id');
    }


    public function scopeAccessible(Builder $query): void
    {
        $query->where('organization_id', Auth::id());
    }
}
