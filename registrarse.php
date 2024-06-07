<?php
session_start();
include "conexion.php";

if(isset($_POST['registrarse'])){
    $nombre = $_POST['usarname'];
    $correo = $_POST['email'];
    $contraseña = $_POST['password'];
    $confirmar_contraseña = $_POST['cpass'];
    $verificar_correo = "SELECT * FROM usuarios WHERE email ='{$correo}'";
    $resultado = mysqli_query($conn, $verificar_correo);
    $contraseña_hasheada = password_hash($contraseña, PASSWORD_DEFAULT);
if(mysqli_num_rows($resultado)>0){
    echo"<div class='mensaje'><p>Este correo ya está en uso, Por favor intenta con otro!</p></div><br>";
    echo"<a href='javascript:self.history.back()'><button class='btn'>Volver</button></a>";
}else{
    if($contraseña === $confirmar_contraseña){
        $consulta = "INSERT INTO usuario (username, email, password) VALUES('$nombre', '$correo', '$contraseña_hashada')";
        $resultado_consulta = mysqli_query($conn, $consulta);
    if($resultado_consulta){
        echo"<div class='mensaje'><p>Te has registrado existosamente!</p>
        </div><br>";
        echo"<a href='login.php'><button class='btn'>Iniciar sesion</button></a>";
            }else{
                echo"<div class='mensaje'><p>Hubo un problema al registrar el correo, por favor intentalo nuevamente!</p>
                </div><br>";
                echo"<a href='javascript:self.history.back()'><button class='btn'>Volver</button></a>";
            }
        }else{
            echo"<div class='mensaje'>
                    <p>Las contraseñas no coinciden.</p>
                    </div><br>";
                    echo"<a href='registrarse.php'><button class='btn'>Volver</button></a>";
        }
    }
}else{
?>

<header>Formulario de registro</header>
<form action="#" method="POST">
    <div class="form-box">
        <div class="input-container">
            <input class="input-field" type="text" placeholder="Nombre de usuario" name="username" required></div>
    <div class="input-container">
        <input class="input-field" type="email" placeholder="Correo electronico" name="email" required></div>
    <div class="input-container">
        <input class="input-field password" type="password" placeholder="Contraseña" name="password" required></div>
        <div class="input-container">
            <input class="input-field" type="password" placeholder="Confirma contraseña" name="cpass" required></div>
        </div>
    </div>
    <input type="submit" name="registrarse" id="submit" value="Registrarse" class="btn">
    <div class="links">¿Ya tienes una cuenta?<a href="login.php">Iniciar Sesion</a>
    </div>
</form>
<?php
}
?>