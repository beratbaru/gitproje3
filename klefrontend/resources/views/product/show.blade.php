
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
                    <h4>Ürün Detayı
                        <a href="{{ route('product.index') }}" class="btn btn-danger float-end">Geri</a>
                    </h4>
                </div>
                <div class="card-body">
                    {{-- Display the product details --}}
                    <h5>{{ $product['product_name'] }}</h5>
                    <p>{{ $product['description'] }}</p>
                    <p>Fiyat: {{ $product['product_price'] }}₺</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
