<?php

namespace App\Models\Apps;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visitor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uniq',
        'zone_id',
        'ic_number',
        'name',
        'phone',
        'email',
        'know_platform',
        'qr_code',
        'total',
        'state',
        'gender',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($visitor) {
            // Generate the next unique ID
            $lastId = self::max('uniq');
            $visitor->uniq = str_pad(($lastId ? intval($lastId) + 1 : 1), 8, '0', STR_PAD_LEFT);
        });
    }

    public function zone()
    {
        return $this-> belongsTo(Zone::class);
    }

    public function receipts()
    {
        return $this->hasMany(VisitorReceipt::class);
    }
}
