<?php
// Daniel Bonifaz Zaquinaula - DEC
$usuario = $_POST["usuario"] ?? "";

include "header.php";

if ($usuario == "") {
    echo '<div class="caja"><div class="error">Debes iniciar sesión primero.</div></div></body></html>';
    exit;
}
?>
    <div class="caja">
        <h2>Reserva tu Pase</h2>

        <form action="procesar.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="usuario" value="<?= htmlspecialchars($usuario) ?>">

            <label>Nombre:</label>
            <input type="text" name="nombre" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Edad:</label>
            <input type="number" name="edad" required>

            <label>Tipo de pase:</label>
            <select name="pase">
                <option>General</option>
                <option>VIP</option>
                <option>Super VIP</option>
            </select>

            <label>Días de asistencia:</label>
            <input type="checkbox" name="dias[]" value="Viernes"> Viernes
            <input type="checkbox" name="dias[]" value="Sábado"> Sábado
            <input type="checkbox" name="dias[]" value="Domingo"> Domingo

            <label>Método de pago:</label>
            <select name="pago">
                <option>Bizum</option>
                <option>PayPal</option>
                <option>Tarjeta</option>
            </select>

            <label>Foto:</label>
            <input type="file" name="foto" required>

            <label>Comentarios:</label>
            <textarea name="comentarios"></textarea>

            <button type="submit">Reservar</button>
        </form>

        <!-- Botón para ir al listado (también por POST con el usuario oculto) -->
        <form action="ver_reservas.php" method="post">
            <input type="hidden" name="usuario" value="<?= htmlspecialchars($usuario) ?>">
            <button type="submit">Ver reservas</button>
        </form>
    </div>
</body>
</html>
