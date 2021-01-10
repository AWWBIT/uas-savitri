<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    protected $table = 'transaksi_detail';
    protected $fillable = [
        'price_perpcs', 'amount', 'total_price'
    ];
}
