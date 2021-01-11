<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    protected $table = 'transaksi_detail';
    protected $fillable = [
        'transaksi_id', 'buku_id', 'price_perpcs', 'amount', 'total_price'
    ];
    public function transaksi()
    {
        return $this->belongsTo('App\Transaksi');
    }
    public function buku()
    {
        return $this->belongsTo('App\Buku');
    }
}
