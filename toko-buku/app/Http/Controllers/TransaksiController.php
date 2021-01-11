<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buku;
use App\Transaksi;
use App\TransaksiDetail;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Transaksi::orderBy('id', 'DESC')->get();
        $buku = Buku::orderBy('id', 'DESC')->get();
        return view('transaksi.index', compact('data', 'buku'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'buyer_name'            => 'required|string',
            'buyer_phone'           => 'required|string',
            'multiple_id_buku'      => 'required',
            'multiple_jumlah_buku'  => 'required',
        ]);
        $id_buku = $request->all()['multiple_id_buku'];
        $jumlah_buku = $request->all()['multiple_jumlah_buku'];
        $total = 0;
        foreach ($id_buku as $key => $itemid) {
            $buku = Buku::findOrFail($itemid);
            $total += $buku->price_perpcs * $jumlah_buku[$key];
            $stock = $buku->stock - $jumlah_buku[$key];
            Buku::where('id', $itemid)->update(['stock' => $stock]);
        }
        Transaksi::create([
            'buyer_name'         => $request->buyer_name,
            'buyer_phone'        => $request->buyer_phone,
            'total'              => $total
        ]);
        $transaksi = Transaksi::orderBy('id', 'DESC')->first();
        foreach ($id_buku as $key => $itemid) {
            $buku = Buku::findOrFail($itemid);
            TransaksiDetail::create([
                'transaksi_id'  => $transaksi->id,
                'buku_id'       => $itemid,
                'price_perpcs'  => $buku->price_perpcs,
                'amount'        => $jumlah_buku[$key],
                'total_price'   => $buku->price_perpcs * $jumlah_buku[$key],
            ]);
        }
        return redirect()->route('transaksi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Transaksi::findOrFail($id);
        $data_detail = TransaksiDetail::where('transaksi_id',$id)->get();
        return view('transaksi.show', compact('data', 'data_detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Transaksi::destroy($id);
        return redirect()->route('transaksi.index');
    }
}
