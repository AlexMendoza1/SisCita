<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinic_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener especialidades
$sql = "SELECT * FROM specialties";
$result = $conn->query($sql);

?>
<?php include 'header.php'; ?>

<div class="content">
    <h2>Bienvenido a la Clínica Alex</h2>
    <p>En nuestra clínica ofrecemos una amplia gama de servicios médicos.</p>
    <!-- Más contenido aquí -->
</div>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva de Citas</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Reserva de Citas</h1>
    <form action="select_doctor.php" method="POST">
        <label for="specialty">Seleccione una especialidad:</label>
        <select name="specialty" id="specialty" required>
            <option value="">Seleccione...</option>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='".$row['id']."'>".$row['name']."</option>";
                }
            }
            ?>
        </select>
        <button type="submit">Siguiente</button>
    </form>
</body>
</html>

<?php
$conn->close();
?>
<?php include 'footer.php'; ?>