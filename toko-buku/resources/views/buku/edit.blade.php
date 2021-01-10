@extends('layouts.template')

@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h3>Tambah Buku</h3>
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
                <form method="POST" action="{{ route('buku.update', $dataEdit->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="{{$dataEdit->title}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Author</label>
                        <input type="text" name="author" class="form-control" value="{{$dataEdit->author}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stock</label>
                        <input type="number" name="stock" class="form-control" value="{{$dataEdit->stock}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price/pcs</label>
                        <div class="input-group">
                            <div class="input-group-text">Rp</div>
                            <input type="number" name="price_perpcs" class="form-control" value="{{$dataEdit->price_perpcs}}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <table id="table" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Stock</th>
                            <th>Price/pcs</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                        <tr>
                            <td class="d-flex">
                                <a href="{{ route('buku.edit', $item->id) }}" class="btn btn-sm btn-success me-2">Edit</a>
                                <form action="{{ route('buku.destroy', $item->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-sm btn-danger" onClick="return confirm('Delete data?')"
                                    >Delete</button>
                                </form>
                            </td>
                            <td>{{$item->title}}</td>
                            <td>{{$item->author}}</td>
                            <td>{{number_format($item->stock)}}</td>
                            <td>Rp {{number_format($item->price_perpcs)}}</td>
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
    });

</script>
@endsection
