<?php
// Daniel Bonifaz Zaquinaula - DEC
$usuario = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Comprobar que existe el fichero
    if (!file_exists("usuarios.txt")) {
        $error = "Error: No existe el archivo usuario.txt";
    } else {
        // 2. Leer el fichero y comparar usuario:contraseña
        $lineas = file("usuarios.txt", FILE_IGNORE_NEW_LINES);
        $correcto = false;
        foreach ($lineas as $linea) {
            if (trim($linea) == $_POST["usuario"] . ":" . $_POST["clave"]) {
                $correcto = true;
            }
        }

        if ($correcto) {
            // 3. Login correcto: enviamos el usuario a index.php con POST oculto
            ?>
            <form action="index.php" method="post">
                <input type="hidden" name="usuario" value="<?= htmlspecialchars($_POST["usuario"]) ?>">
                <p>Login correcto.</p>
                <button type="submit">Entrar al portal</button>
            </form>
            <?php
            exit;
        } else {
            $error = "Usuario o contraseña incorrectos.";
        }
    }
}

include "header.php";
?>
    <div class="caja">
        <h2>Iniciar Sesión</h2>
        <?php if ($error != "") { ?>
            <div class="error"><?= $error ?></div>
        <?php } ?>
        <form action="login.php" method="post">
            <label>Usuario:</label>
            <input type="text" name="usuario" placeholder="Ingresa tu usuario">
            <label>Contraseña:</label>
            <input type="password" name="clave" placeholder="Ingresa tu contraseña">
            <button type="submit" style="width:100%">Entrar al Sistema</button>
        </form>
    </div>
</body>
</html>
