@extends('layouts.template')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5>Transaksi Detail</h5>
                <span>Invoice #{{$data->id}} {{$data->created_at}}</span>
                <table class="table daftar table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Pembeli</th>
                            <th scope="col">Buku</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$data->buyer_name}} - {{$data->buyer_phone}}</td>
                            <td>
                                <table>
                                    @foreach($data_detail as $item)
                                    <tr>
                                        <td>{{$item->buku->title}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </td>
                            <td>
                                <table>
                                    @foreach($data_detail as $item)
                                    <tr>
                                        <td>{{$item->amount}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </td>
                            <td>
                                <table>
                                    @foreach($data_detail as $item)
                                    <tr>
                                        <td>Rp {{number_format($item->total_price)}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{route('transaksi.index')}}" class="btn btn-dark">Back</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
       
    });
</script>
@endsection
