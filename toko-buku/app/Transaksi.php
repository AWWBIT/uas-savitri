<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = [
        'buyer_name', 'buyer_phone', 'total'
    ];
    public function transaksi_detail()
    {
        return $this->hasMany('App\TransaksiDetail');
    }
}
