<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}" />
  <title>Auth</title>
</head>

<body>
  <section class="login">
    <div class="blurBx">
      <div class="box SignIn">
        <h1>Already on a Account</h1>
        <button class="btn_SignIn" id="btn">Sign In</button>
      </div>
      <div class="box SignUp">
        <h1>Don't have an a Account?</h1>
        <button class="btn_SignUp" id="btn">Sign Up</button>
      </div>
    </div>
    <div class="loginBx">
      <div class="form SignIn">
        <form action="/auth/login" method="POST">
          @csrf
          <h1>Login</h1>
          <input type="text" name="email" placeholder="Email" />
          <div class="passwordBx">
            <input type="password" name="password" id="showPassword" placeholder="Password" />
            <span class="lihatPassword"><span id="eye"></span></span>
          </div>
          <input type="submit" value="Login" />
        </form>
      </div>
      <div class="form SignUp">
        <form action="/auth/register" method="POST">
          @csrf
          <h1>Register</h1>
          <input type="text" name="email" placeholder="Email" />
          <input type="text" name="name" placeholder="Username" />
          <div class="passwordBx">
            <input type="password" name="password" id="showPassword" placeholder="Password" />
            <span class="lihatPassword"><span id="eye"></span></span>
          </div>
          <div class="passwordBx">
            <input type="password" name="password" id="showPassword" placeholder="Confirm Password" />
            <span class="lihatPassword"><span id="eye"></span></span>
          </div>
          <input type="submit" value="Register" />
        </form>
      </div>
    </div>
  </section>
  <script>
    var eye = document.querySelectorAll("#eye");
    var password = document.querySelectorAll("#showPassword");

    eye.forEach((element) => {
      element.addEventListener("click", () => {
        password.forEach((item) => {
          if (item.type === "password") {
            element.classList.add("aktif");
            item.type = "text";
          } else {
            element.classList.remove("aktif");
            item.type = "password";
          }
        });
      });
    });

    var login = document.querySelector(".login");
    var btn = document.querySelectorAll('#btn');

    btn.forEach((item) => {
      item.onclick = () => {
        document.querySelector('body').classList.toggle('aktif');
        login.classList.toggle('aktif');
      }
    });
  </script>
</body>

</html>