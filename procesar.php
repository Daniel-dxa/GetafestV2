<?php
// Daniel Bonifaz Zaquinaula - DEC

// 1. Solo se acepta POST
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Petición no válida.");
}

$usuario = $_POST["usuario"] ?? "";
include "header.php";

$nombre      = str_replace("|", " ", $_POST["nombre"]);
$email       = str_replace("|", " ", $_POST["email"]);
$edad        = (int) $_POST["edad"];
$pase        = $_POST["pase"];
$pago        = $_POST["pago"];
$comentarios = str_replace(["|", "\r", "\n"], " ", $_POST["comentarios"]);
$dias        = $_POST["dias"] ?? [];

echo '<div class="caja">';

// 2. Validaciones
if ($edad < 18) {
    echo '<div class="error">Error: debes tener 18 años o más.</div></div></body></html>';
    exit;
}
if (count($dias) == 0) {
    echo '<div class="error">Error: marca al menos un día.</div></div></body></html>';
    exit;
}

// 3. Subir la foto a uploads/ con nombre único
if (!is_dir("uploads")) {
    mkdir("uploads");
}
$extension = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
$rutaFoto  = "uploads/user_" . uniqid() . "." . $extension;
move_uploaded_file($_FILES["foto"]["tmp_name"], $rutaFoto);

// 4. Calcular el total: precio del pase + 40€ por día
$precios = ["General" => 20, "VIP" => 60, "Super VIP" => 150];
$total = $precios[$pase] + 40 * count($dias);

// 5. Guardar en reservas.txt (una línea separada por |)
$linea = date("Y-m-d H:i:s") . "|" . $nombre . "|" . $email . "|" . $edad . "|" . $pase . "|"
       . implode(", ", $dias) . "|" . $pago . "|" . $total . "€|" . $rutaFoto . "|" . $comentarios . PHP_EOL;
file_put_contents("reservas.txt", $linea, FILE_APPEND);
?>
    <div class="ok">¡Reserva guardada! Total: <?= $total ?>€</div>

    <form action="ver_reservas.php" method="post">
        <input type="hidden" name="usuario" value="<?= htmlspecialchars($usuario) ?>">
        <button type="submit">Ver reservas</button>
    </form>
</div>
</body>
</html>
