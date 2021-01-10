<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buku;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Buku::orderBy('id', 'DESC')->get();
        return view('buku.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'title'         => 'required|string',
            'author'        => 'required|string',
            'stock'         => 'required|integer',
            'price_perpcs'  => 'required|integer',
        ]);

        Buku::create([
            'title'         => $request->title,
            'author'        => $request->author,
            'stock'         => $request->stock,
            'price_perpcs'  => $request->price_perpcs,
        ]);
        return redirect()->route('buku.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Buku::orderBy('id', 'DESC')->get();
        $dataEdit   = Buku::findOrFail($id);
        return view('buku.edit', compact('data','dataEdit'));
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
        $request->validate([
            'title'         => 'required|string',
            'author'        => 'required|string',
            'stock'         => 'required|integer',
            'price_perpcs'  => 'required|integer',
        ]);

        $model              = Buku::findOrFail($id);
        $model->title       = $request->title;
        $model->author      = $request->author;
        $model->stock       = $request->stock;
        $model->price_perpcs= $request->price_perpcs;
        $model->save();
        return redirect()->route('buku.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Buku::destroy($id);
        return redirect()->route('buku.index');
    }
}
