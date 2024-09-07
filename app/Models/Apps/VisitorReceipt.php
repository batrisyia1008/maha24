<?php

namespace App\Models\Apps;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisitorReceipt extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'visitor_id',
        'receipt',
        'amount',
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }
}
