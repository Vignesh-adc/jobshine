<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Job Shine</title>
  <link href="{{ url('img/favicon.ico') }}" rel="icon">
  <link href="{{ url('css/login.css') }}" rel="stylesheet">
</head>
<body>
  <div class="wrapper">
    <form action="{{ route('home') }}" method="POST">
      <h2>Login</h2>
        <div class="input-field">
        <input type="text" value="vignesh.adc@gmail.com" required>
        <label>Enter your email</label>
      </div>
      <div class="input-field">
        <input type="password" value="12345" required>
        <label>Enter your password</label>
      </div>
      <div class="forget">
        <label for="remember">
          <input type="checkbox" id="remember">
          <p>Remember me</p>
        </label>
        <a href="javascript:;">Forgot password?</a>
      </div>
      <button type="submit" class="login">Log In</button>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script>
    $(function(){
        $('.login').click(function(e){
            e.preventDefault();
            window.location.href='jobseekers';
        });
    });
  </script>
</body>
</html>