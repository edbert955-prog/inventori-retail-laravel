<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'type', 'transaction_date'];

    // Relasi ke tabel Users (Pencatat)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke tabel Transaction Details (Isi barangnya)
    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}