<?php
// Daniel Bonifaz Zaquinaula - DEC
$usuario = $_POST["usuario"] ?? "";
$id      = (int) ($_POST["id"] ?? 0);
include "header.php";

echo '<div class="caja">';

// 1. Solo el admin puede entrar
if ($usuario != "admin") {
    echo '<div class="error">Acceso denegado: solo el administrador puede ver los pases.</div></div></body></html>';
    exit;
}

// 2. Buscar la línea con ese ID
$lineas = file("reservas.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
if (!isset($lineas[$id - 1])) {
    echo '<div class="error">La reserva no existe.</div></div></body></html>';
    exit;
}
$d = explode("|", $lineas[$id - 1]);
?>
    <h2 style="text-align:center">Acreditación #<?= $id ?> (Vista Administrador)</h2>

    <div class="pase">
        <img src="<?= htmlspecialchars($d[8]) ?>" alt="foto">
        <h3><?= htmlspecialchars($d[1]) ?></h3>
        <p><b>Email:</b> <?= htmlspecialchars($d[2]) ?></p>
        <p><b>Edad:</b> <?= htmlspecialchars($d[3]) ?> años</p>
        <p><b>Tipo de Entrada:</b> <?= htmlspecialchars($d[4]) ?></p>
        <p><b>Días de asistencia:</b> <?= htmlspecialchars($d[5]) ?></p>
        <p><b>Método de pago:</b> <?= htmlspecialchars($d[6]) ?></p>
        <p><i>"<?= htmlspecialchars($d[9]) ?>"</i></p>
        <p class="total">Total: <?= htmlspecialchars($d[7]) ?></p>
    </div>

    <form action="ver_reservas.php" method="post" style="text-align:center">
        <input type="hidden" name="usuario" value="<?= htmlspecialchars($usuario) ?>">
        <button type="submit">← Volver al listado de reservas</button>
    </form>
</div>
</body>
</html>
