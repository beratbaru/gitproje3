

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Giriş Yap</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/app.css">

</head>
<body>
   
<div class="form-container">

<form action="{{ route('login') }}" method="post">
   @csrf
      <h3>Giriş Yap</h3>
      
      <?php
      
      if($errors->any()){
         foreach ($errors->all() as $error){
            echo '<span class="error-msg"> Mail veya şifre hatalı. </span>';
      };
   };

      ?>
      <input type="email" name="email" required placeholder="mailinizi girin">
      <input type="password" name="password" required placeholder="şifrenizi girin">
      <input type="submit" name="submit" value="giriş yap" class="form-btn">
      <p>Hesabın yok mu?<a href="register"> kayıt ol</a></p>
   </form>

</div>

</body>
</html>