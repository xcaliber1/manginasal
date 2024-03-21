@extends('layouts.app')
  
@section('title', 'Home Product')
  
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Product</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
    </div>
    <hr />
    <div class="d-flex justify-content-center">
        <form action="{{ route('products.search') }}" method="GET" class="form-inline my-2 my-lg-0">
            <input type="text" class="form-control mr-sm-2" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" name="q">
            <button class="btn btn-primary my-2 my-sm-0" type="submit">
                <i class="fas fa-search fa-sm"></i> Search
            </button>
        </form>
    </div>
    <br>
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Product Code</th>
                    <th>Quantity</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if($product->count() > 0)
                    @foreach($product as $rs)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $rs->title }}</td>
                            <td>₱ {{ $rs->price }}</td>
                            <td>{{ $rs->product_code }}</td>
                            <td>{{ $rs->quantity }}</td>
                            <td>{{ $rs->description }}</td>  
                            <td>
                                <div class="btn-group" role="group" aria-label="Product Actions">
                                    <a href="{{ route('products.show', $rs->id) }}" class="btn btn-secondary" title="View Details"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('products.edit', $rs->id)}}" class="btn btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('products.destroy', $rs->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="Delete"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center" colspan="5">Product not found</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
