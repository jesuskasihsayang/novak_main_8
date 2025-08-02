<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\SubscriptionPackage;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'nama',
        'username', 
        'email',
        'password',
        'package_id',
        'ads_quota',
        'ads_used',
        'device_token',
        'status',
        'approved_by',
        'approved_at',
        'akses_level',
        'gambar',
        'kode_rahasia'
    ];

    protected $hidden = [
        'password',
        'kode_rahasia',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'approved_at' => 'datetime',
    ];

    // Relationships
    public function package()
    {
        return $this->belongsTo(SubscriptionPackage::class, 'package_id');
    }

    // Get ads quota from package
    public function getAdsQuotaFromPackage()
    {
        if ($this->package) {
            return $this->package->ads_quota;
        }
        return 100; // default quota
    }
}