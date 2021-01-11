@extends('layouts.template')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5>Transaksi</h5>
                <hr>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
                @endif
                <form method="POST" action="{{ route('transaksi.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Nama Pembeli</label>
                                <input type="text" name="buyer_name" class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">No HP</label>
                                <input type="number" name="buyer_phone" class="form-control">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-4">
                            <h5>Tambah Pembelian</h5>
                            <div class="mb-3">
                                <label class="form-label">Barang</label>
                                <select class="form-control" id="id_buku">
                                    <option value="-">--Pilih--</option>
                                    @foreach($buku as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }} - Stok sisa {{ $item->stock }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" id="nama_buku" class="form-control">
                            <input type="hidden" id="stok_buku" class="form-control">
                            <div class="mb-3">
                                <label class="form-label">Jumlah</label>
                                <input type="number" id="jumlah_buku" class="form-control">
                            </div>
                            <button type="button" id="add-row" class="btn btn-dark btn-sm w-100">Tambah</button>
                        </div>
                        <div class="col-lg-8">
                            <h5>Daftar Pembelian</h5>
                            <table class="table daftar table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">ID Buku</th>
                                        <th scope="col">Nama Buku</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12 mt-5">
        <div class="card">
            <div class="card-body">
                <table id="table" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Pembeli</th>
                            <th>Total</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                        <tr>
                            <td class="d-flex">
                                <a href="{{ route('transaksi.show', $item->id) }}"
                                    class="btn btn-sm btn-success me-2">View</a>
                                <form action="{{ route('transaksi.destroy', $item->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-sm btn-danger"
                                        onClick="return confirm('Delete data?')">Delete</button>
                                </form>
                            </td>
                            <td>Nama : {{$item->buyer_name}} - No HP : {{$item->buyer_phone}}</td>
                            <td>Rp {{number_format($item->total)}}</td>
                            <td>{{$item->created_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#table').DataTable();
        $('select').on('change', function() {
            var nama_buku = $(this).find("option:selected").text();
            nama_buku = nama_buku.split(" - ");
            nama_buku = nama_buku[0];
            $('#nama_buku').val(nama_buku);

            var stok_buku = $(this).find("option:selected").text();
            stok_buku = stok_buku.split("sisa ");
            stok_buku = stok_buku[1];
            $('#stok_buku').val(stok_buku);
        });
        $('#add-row').click(function(){
            if($('#id_buku').val() == '-' || $('#jumlah_buku').val() == ''){
                alert('Data masih ada yang kosong!');
            }
            else if($('.daftar tr > td:contains("'+$('#nama_buku').val()+'")').length > 0){
                alert('Buku telah ditambah sebelumnya!');
            }
            else if($('#stok_buku').val() < $('#jumlah_buku').val()){
                alert('Stok buku tidak cukup!');
            }
            else{
                var id_buku         = $('#id_buku').val();
                var jumlah_buku     = $('#jumlah_buku').val();
                var nama_buku       = $('#nama_buku').val();
                nama_buku = nama_buku.split(" - ");
                nama_buku = nama_buku[0];
                var markup          = "<tr><td>#"+id_buku+"</td><td><input type='hidden' name='multiple_id_buku[]' value='"+id_buku+"'><input type='hidden' name='multiple_jumlah_buku[]' value='"+jumlah_buku+"'> "+ nama_buku +"</td><td>" + jumlah_buku + "</td><td><a href='#' id='DeleteButton' onclick='return false' class='btn btn-sm btn-danger me-2'>Delete</a></td></tr>";
                $(".daftar tbody").append(markup);

                $('#id_buku').val();
                $('#jumlah_buku').val();
                $('#nama_buku').val();
            }
        });
        $('.daftar').on("click", "#DeleteButton", function() {
            $(this).closest("tr").remove();
        });
    });

</script>
@endsection
