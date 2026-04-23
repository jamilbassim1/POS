<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
     protected $fillable = [
        'name',
        'category_id',
        'company_id',
        'location',
        'purchase_rate',
        'sale_rate',
        'whole_sale_rate',
        'roi',
        'asin',
        'barcode',
        'summary',
    ];
     public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // =========================
    // RELATION: Product belongs to Company
    // =========================
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
