<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #000;
      font-family: 'Inter', sans-serif;
    }
    .login-container {
      min-height: 100vh;
    }
    .form-box {
      background-color: #111;
      padding: 40px;
      border-radius: 8px;
      color: white;
      box-shadow: 0 0 10px rgba(255, 255, 255, 0.05);
    }
    .form-label {
      font-weight: 600;
    }
    .form-control {
      background-color: #222;
      border: none;
      color: white;
    }
    .form-control:focus {
      background-color: #222;
      color: white;
      box-shadow: none;
    }
    .btn-dark-custom {
      background-color: #2b2b2b;
      color: white;
    }
    .btn-dark-custom:hover {
      background-color: #3b3b3b;
    }
    .small-text a {
      color: #4d6fff;
      text-decoration: none;
    }
    .small-text a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container d-flex justify-content-center align-items-center login-container">
    <div class="form-box w-100" style="max-width: 400px;">
      <h2 class="text-center mb-4">LOGIN</h2>
      
      @if (session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif

      @if ($errors->has('login'))
        <div class="alert alert-danger">
          {{ $errors->first('login') }}
        </div>
      @endif

      <form method="POST" action="{{ route('login.store') }}">
        @csrf

        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-4">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-dark-custom w-100">Login</button>
      </form>

      <p class="text-center small-text mt-4">
        Belum punya akun? <a href="{{ route('register') }}">Register disini</a>
      </p>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    setTimeout(function() {
      const alert = document.getElementById('status-alert');
      if(alert){
        alert.style.transition = 'opacity 0.5s ease';
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 500);
      }
    }, 3000); 
  </script>
</body>
</html>
