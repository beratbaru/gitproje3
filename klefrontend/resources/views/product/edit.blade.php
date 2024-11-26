@extends('layouts.frontend')

@section('content')
@if(!session('api_token'))
<div class="d-flex justify-content-center align-items-center vh-100" style="color:red; background-color:black;">
    <div class="text-center">
        <h3>Verileri görmek için giriş yapınız.</h3>
        <div class="mt-4">
            <a href="{{ route('register') }}" class="btn btn-danger me-2" style="color:pink; text-decoration:none;">Kayıt Ol</a>
            <a href="{{ route('login') }}" class="btn btn-secondary" style="color:pink; text-decoration:none;">Giriş Yap</a>
        </div>
    </div>
</div>
@else
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Ürün Düzenle
                        <a href="{{ route('product.index') }}" class="btn btn-danger float-end">Geri</a>
                    </h4>
                </div>
                <div class="card-body">
                    <!-- Form for editing the product -->
                    <form action="{{ route('product.update', $product['id']) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="product_name">Ürün Adı</label>
                            <input type="text" name="product_name" class="form-control" value="{{ old('product_name', $product['product_name']) }}">
                            @error('product_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="product_price">Fiyat</label>
                            <input type="text" name="product_price" class="form-control" value="{{ old('product_price', $product['product_price']) }}">
                            @error('product_price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Açıklama</label>
                            <textarea name="description" class="form-control">{{ old('description', $product['description']) }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Güncelle</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
