<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // Tuliskan nama tabelmu (biasanya jamak/plural otomatis dari Laravel)
    protected $table = 'items'; 

    // WAJIB ADA: Daftarkan kolom apa saja yang boleh diisi di database
   protected $fillable = [
    'name',
    'quantity',
    'price',
    'category_id' // <-- Tambahkan baris ini!
];
}