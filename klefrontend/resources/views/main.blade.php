<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>AnaSayfa</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/app.css">
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>

   @guest
   <div class="d-flex justify-content-center align-items-center vh-100" style="color:red;background-color:black">
      <div class="text-center">
         <h3>Verileri görmek için giriş yapınız.</h3>
         <div class="mt-4">
            <a href="{{ route('register') }}" class="btn btn-danger me-2" style="color:pink;text-decoration:none;">Kayıt Ol</a>
            <a href="{{ route('login') }}" class="btn btn-secondary" style="color:pink;text-decoration:none;">Giriş Yap</a>
         </div>
      </div>
   </div>

   @else
   @if(Auth::check())
   <div class="d-flex justify-content-center align-items-center vh-100 flex-column">
      <p>Merhaba, {{ Auth::user()->name }}</p>
      <form action="{{ route('logout') }}" method="POST" style="display:inline;">
         @csrf
         <button type="submit" class="btn btn-danger">Çıkış Yap</button>
      </form>

      <!-- Button to redirect to product/index.blade.php -->
      <div class="mt-4">
         <a href="{{ url('product') }}" class="btn btn-primary">Ürün Listesine Git</a>
      </div>
   </div>
   @endif
   @endguest

</body>
</html>
