<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Giriş Yap</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body>
   
<div class="form-container">

   <form action="{{ route('login') }}" method="post">
      @csrf
      <h3>GİRİŞ YAP</h3>
      
      <!-- Display success message -->
      @if (session('success'))
         <div class="alert alert-success">
            {{ session('success') }}
         </div>
      @endif

      <!-- Display validation or login errors -->
      @if ($errors->any())
         <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
               <span class="error-msg">{{ $error }}</span>
            @endforeach
         </div>
      @endif

      <input type="email" name="email" required placeholder="mailinizi girin">
      <input type="password" name="password" required placeholder="şifrenizi girin">
      <input type="submit" name="submit" value="giriş yap" class="form-btn">
      <p>Hesabın yok mu? <a href="{{ route('register') }}">kayıt ol</a></p>
   </form>

</div>

</body>
</html>
