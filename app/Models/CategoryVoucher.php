<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryVoucher extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function vouchers(): HasMany
    {
        return $this->hasMany(Voucher::class, 'category_id');
    }
}
