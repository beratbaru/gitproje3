<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body>
   
<div class="form-container">

   <form action="{{ route('register') }}" method="POST">
      @csrf
      <h3>Kayıt ol</h3>

      @if ($errors->any())
         <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                  <p>{{ $error }}</p>
            @endforeach
         </div>
      @endif


      <input type="text" name="name" required placeholder="İsminizi girin" value="{{ old('name') }}">
      <input type="email" name="email" required placeholder="Mailinizi girin" value="{{ old('email') }}">
      <input type="password" name="password" required placeholder="Şifrenizi girin">
      <input type="password" name="password_confirmation" required placeholder="Şifrenizi doğrulayın">
      <input type="submit" name="submit" value="kayıt ol" class="form-btn">
      <p>Zaten hesabın var mı? <a href="{{ route('login') }}">giriş yap</a></p>
   </form>

</div>

</body>
</html>
