<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoce extends Model
{
    use HasFactory;

    protected $table = 'invoces';

    protected $fillable = [
        'nama',
        'nomor',
        'alamat',
        'harga',
        'keperluan',
        'tanggal',
        'item',
        'deskripsi',
    ];

    protected static function boot()
    {
        parent::boot();

        // Mengenerate nomor invoice secara otomatis
        static::creating(function ($model) {
            $lastInvoice = static::latest('id')->first();
            $number = $lastInvoice ? intval(substr($lastInvoice->nomor, 2, 5)) + 1 : 1;
            $year = now()->format('y');
            $model->nomor = 'PA' . str_pad($number, 5, '0', STR_PAD_LEFT) . '-' . $year;
        });
    }
}
