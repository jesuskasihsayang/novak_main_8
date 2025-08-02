<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPackage extends Model
{
    protected $fillable = [
        'package_name',
        'package_code',
        'ads_quota',
        'price',
        'description',
        'features',
        'is_active',
        'display_order',
        'is_unlimited',
        'is_customizable',
        'can_delete'
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
        'is_unlimited' => 'boolean',
        'is_customizable' => 'boolean',
        'can_delete' => 'boolean',
        'price' => 'decimal:2'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'package_id');
    }
}