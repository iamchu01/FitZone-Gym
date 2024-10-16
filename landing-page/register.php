<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Fit Zone - Register</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,500,600,700&display=swap" rel="stylesheet" />
    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <style>
      body {
        background: url('image.png') no-repeat center center/cover;
        font-family: 'Oswald', sans-serif;
      }
      .register-container {
        width: 100%;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .register-card {
        background-color: rgba(0, 0, 0, 0.8);
        padding: 30px;
        border-radius: 10px;
        width: 450px;
        color: white;
      }
      .register-card h2 {
        text-align: center;
        color: #44d62c;
      }
      .register-card input {
        margin-bottom: 15px;
        border-radius: 5px;
        background-color: rgba(255, 255, 255, 0.1);
        border: none;
        color: white;
      }
      .btn-register {
        background-color: #44d62c;
        color: white;
        width: 100%;
        font-weight: bold;
      }
      .register-link {
        text-align: center;
        margin-top: 20px;
      }
      .register-link a {
        color: #44d62c;
      }
    </style>
  </head>
  <body>
    <div class="register-container">
      <div class="register-card">
        <h2>Register for Fit Zone</h2>
        <form>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Full Name" required />
          </div>
          <div class="form-group">
            <input type="email" class="form-control" placeholder="Email" required />
          </div>
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" required />
          </div>
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Confirm Password" required />
          </div>
          <button type="submit" class="btn btn-register">Register</button>
        </form>
        <div class="register-link">
          <p>Already have an account? <a href="login.php">Login Here</a></p>
        </div>
      </div>
    </div>

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
