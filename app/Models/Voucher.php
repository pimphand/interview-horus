<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class Voucher extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'photo', 'category_id', 'status'];

    public function claim()
    {
        return $this->hasMany(VoucherClaim::class);
    }

    public function scopeActive($query, $active = true)
    {
        // Pastikan $active adalah boolean
        if (!is_bool($active)) {
            throw new InvalidArgumentException('Parameter $active harus berupa boolean.');
        }

        // Gunakan $active untuk menyaring hasil
        return $query->where('status', $active ? 1 : 0);
    }
}
