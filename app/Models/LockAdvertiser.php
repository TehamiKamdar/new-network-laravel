<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LockAdvertiser extends Model
{
    use HasFactory;
    protected $table = 'lock_advertiser';
    protected $fillable = [
        'id',
        'publisher_id',
        'source',
        'status',
        'website_id'
    ];
}
