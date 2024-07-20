<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinic_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$specialty_id = $_POST['specialty'];

// Obtener doctores por especialidad
$sql = "SELECT * FROM doctors WHERE specialty_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $specialty_id);
$stmt->execute();
$result = $stmt->get_result();

?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Doctor</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Seleccionar Doctor</h1>
    <form action="select_time.php" method="POST">
        <label for="doctor">Seleccione un doctor:</label>
        <select name="doctor" id="doctor" required>
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