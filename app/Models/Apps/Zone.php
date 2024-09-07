<?php

namespace App\Models\Apps;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zone extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uniq',
        'slug',
        'name',
        'description',
        'qr_code',
    ];

    public function visitors()
    {
        return $this->hasMany(Visitor::class);
    }
}
