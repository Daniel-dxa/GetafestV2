<?php
// Daniel Bonifaz Zaquinaula - DEC
$usuario = $_POST["usuario"] ?? "";
include "header.php";
?>
    <div class="caja ancha">
        <h2>Listado de Reservas</h2>

        <?php
        if (!file_exists("reservas.txt")) {
            echo '<div class="error">Todavía no hay reservas.</div>';
        } else {
            $lineas = file("reservas.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        ?>
        <table>
            <tr>
                <th>Fecha</th><th>Nombre</th><th>Email</th><th>Edad</th>
                <th>Pase</th><th>Pago</th><th>Total</th><th>Acción Admin</th>
            </tr>
            <?php
            foreach ($lineas as $i => $linea) {
                $d = explode("|", $linea);
                $id = $i + 1; // ID correlativo según la línea
            ?>
            <tr>
                <td><?= htmlspecialchars($d[0]) ?></td>
                <td><?= htmlspecialchars($d[1]) ?></td>
                <td><?= htmlspecialchars($d[2]) ?></td>
                <td><?= htmlspecialchars($d[3]) ?></td>
                <td><?= htmlspecialchars($d[4]) ?></td>
                <td><?= htmlspecialchars($d[6]) ?></td>
                <td><?= htmlspecialchars($d[7]) ?></td>
                <td>
                    <form action="ver_pase.php" method="post">
                        <input type="hidden" name="usuario" value="<?= htmlspecialchars($usuario) ?>">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <button type="submit">Ver Pase</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
        <?php } ?>

        <form action="index.php" method="post">
            <input type="hidden" name="usuario" value="<?= htmlspecialchars($usuario) ?>">
            <button type="submit">+ Nueva Reserva</button>
        </form>
    </div>
</body>
</html>
