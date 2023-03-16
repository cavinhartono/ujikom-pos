<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}" />
  <title>Shopcube | Point of Sale</title>
</head>

<body>
  @if(Session::get('failed'))
  <div class="alert danger between">
    <span class="icon"></span>
    <h2 class="subtitle">{{ Session::get('failed') }}</h2>
  </div>
  @endif
  <section class="login">
    <div class="blurBx">
      <div class="box SignIn">
        <h1>Sudah punya akun?</h1>
        <button class="btn_SignIn" id="btn">Masuk</button>
      </div>
      <div class="box SignUp">
        <h1>Tidak punya akun?</h1>
        <button class="btn_SignUp" id="btn">Daftar</button>
      </div>
    </div>
    <div class="loginBx">
      <div class="form SignIn">
        <form action="/auth/login" method="POST">
          @csrf
          <h1 class="title" style="margin: (--md) 0;">Shop<b>cube</b></h1>
          <div class="field">
            <div class="input">
              <label for="email">Email</label>
              <input type="text" id="email" name="email" placeholder="johndoe@example.com" value="{{ Session::get('email') }}" />
            </div>
            <div class="input">
              <label for="password">Password</label>
              <div class="passwordBx">
                <input type="password" name="password" id="password isPassword" placeholder="Minimal 8 digit" value="{{ Session::get('password') }}" />
                <span class="lihatPassword"><span id="eye"></span></span>
              </div>
            </div>
          </div>
          <input type="submit" value="Masuk" />
        </form>
      </div>
      <div class="form SignUp">
        <form action="/auth/register" method="POST">
          @csrf
          <h1 class="title">Buat Akun</h1>
          <div class="field">
            <div class="input">
              <label for="email2">Email</label>
              <input type="text" id="email2" name="email" placeholder="johndoe@example.com" value="{{ Session::get('email') }}" />
            </div>
            <div class="input">
              <label for="username">Username</label>
              <input type="text" name="name" id="username" placeholder="John Doe" value="{{ Session::get('username') }}" />
            </div>
          </div>
          <div class="field flex gap">
            <div class="input">
              <label for="password2">Password</label>
              <div class="passwordBx">
                <input type="password" name="password" id="password2 isPassword" placeholder="Minimal 8 digit" />
                <span class="lihatPassword"><span id="eye"></span></span>
              </div>
            </div>
            <div class="input">
              <label for="confirmPassword">Konfirmasi Password</label>
              <div class="passwordBx">
                <input type="password" name="password" id="confirmPassword isPassword" placeholder="Minimal 8 digit" />
                <span class="lihatPassword"><span id="eye"></span></span>
              </div>
            </div>
          </div>
          <input type="submit" value="Daftar" />
        </form>
      </div>
    </div>
  </section>
  <script>
    var eye = document.querySelectorAll(".lihatPassword");
    var password = document.querySelectorAll("#isPassword");

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

    setTimeout(() => {
      document.querySelector(".alert").classList.add("hide");
    }, 5000);
  </script>
</body>

</html>