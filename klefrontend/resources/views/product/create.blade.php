@extends('layouts.frontend')

@section('content')
@if(!session('api_token'))

<div class="d-flex justify-content-center align-items-center vh-100 text-danger bg-dark">
    <div class="text-center">
        <h3>Verileri görmek için giriş yapınız.</h3>
        <div class="mt-4">
            <a href="{{ route('register') }}" class="btn btn-danger me-2">Kayıt Ol</a>
            <a href="{{ route('login') }}" class="btn btn-secondary">Giriş Yap</a>
        </div>
    </div>
</div>
@else
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-dark text-white">
            <h4>Ürün Oluştur
                <a href="{{ route('product.index') }}" class="btn btn-danger float-end">Geri</a>
            </h4>
        </div>
        <div class="card-body">
            <form action="{{ route('product.store') }}" method="POST" id="createProductForm">
                @csrf
                <div class="mb-3">
                    <label>Ürün Adı</label>
                    <input type="text" name="product_name" class="form-control" value="{{ old('product_name') }}" required />
                    @error('product_name') 
                    <span class="text-danger">{{ $message }}</span> 
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Ürün Açıklaması</label>
                    <textarea name="description" rows="3" class="form-control" required>{{ old('description') }}</textarea>
                    @error('description') 
                    <span class="text-danger">{{ $message }}</span> 
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Fiyat</label>
                    <input type="text" name="product_price" class="form-control" value="{{ old('product_price') }}" required />
                    @error('product_price') 
                    <span class="text-danger">{{ $message }}</span> 
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Kaydet</button>
            </form>
        </div>
    </div>
</div>
@endif
@endsection
