<?php
// Daniel Bonifaz Zaquinaula - DEC
if (!isset($usuario)) {
    $usuario = "";
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>DEVMUSIC FEST 2026</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>DEVMUSIC FEST 2026</h1>
    <p>Sistema Oficial de Reserva y Acreditación Digital</p>
    <?php if ($usuario != "") { ?>
        <p>Usuario activo: <b><?= htmlspecialchars($usuario) ?></b> <a href="login.php">Cerrar Sesión / Salir</a></p>
    <?php } else { ?>
        <p>Acceso al portal: 🔑 <a href="login.php">Iniciar Sesión</a></p>
    <?php } ?>
