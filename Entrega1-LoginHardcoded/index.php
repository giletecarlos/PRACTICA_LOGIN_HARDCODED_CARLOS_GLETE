<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <title>Formulario Gilete</title>
  <link href="./styles.css" rel="stylesheet" type="text/css">
  <link rel="icon" type="image/png" href="./images/logo.png">
</head>

<div class="cont">
  <div class="form">
  <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" onsubmit="return validarForm()">
      <h1>EMPRESA GILETE (Amigo de El Fary)</h1>
      <input type="email" class="user" placeholder="Usuario" name="email" id="email"/>
      <input type="password" class="pass" placeholder="Contraseña" name="password" id="password"/>
      <button class="login" type="submit">INICIAR SESIÓN</button>
      <a class="remember" href="https://cursos.fpdeinformatica.es/">¿Has olvidado la contraseña?</a>
    </form>
  </div>
</div>

<script>
    function validarForm() {
      var email = btoa(document.getElementById("email").value);
      document.getElementById("email").value = email;
      document.getElementById("email").setAttribute("type","hidden");

      var password = btoa(document.getElementById("password").value);
      document.getElementById("password").value = password;
      document.getElementById("password").setAttribute("type","hidden");
    }

    function buidarCamps()
    {
      document.getElementById("email").value = null;
      document.getElementById("password").value = null;
    }

    function usuarioIncorrecto()
    {
        alert("Usuario incorrecto");
        buidarCamps();
    }

    function campsNoOmplerts()
    {
      alert("Hay algún campo en blanco. Por favor, introducza su usuario y contraseña");
      buidarCamps();
    }
</script>

<?php
require_once "./emails.php";
require_once "./contraseñas.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = base64_decode($_POST["email"]);
    $password = base64_decode($_POST["password"]);

    if (!isset($email) || !isset($password)) {
        echo "<script type='text/javascript'>campsNoOmplerts()</script>";
    } else {
        foreach (EMAILS as $i => $emailGuardado) {
            if ($email == $emailGuardado && password_verify($password, password_hash(CONTRASEÑAS[$i], PASSWORD_DEFAULT))) {
                header("Location: https://educem.net");
            }
        }
        echo "<script type='text/javascript'>usuarioIncorrecto()</script>";
    }
}
?>

</body>
</html>
