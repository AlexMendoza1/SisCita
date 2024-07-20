<?php
if (!isset($_GET['doctor_id']) || !isset($_GET['appointment_time']) || !isset($_GET['first_name']) || !isset($_GET['last_name']) || !isset($_GET['phone']) || !isset($_GET['email']) || !isset($_GET['address'])) {
    die("Datos incompletos.");
}

$doctor_id = $_GET['doctor_id'];
$appointment_time = $_GET['appointment_time'];
$first_name = htmlspecialchars($_GET['first_name']);
$last_name = htmlspecialchars($_GET['last_name']);
$phone = htmlspecialchars($_GET['phone']);
$email = htmlspecialchars($_GET['email']);
$address = htmlspecialchars($_GET['address']);

// Conectar a la base de datos para obtener detalles del doctor
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinic_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT name FROM doctors WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $doctor_id);
$stmt->execute();
$result = $stmt->get_result();
$doctor = $result->fetch_assoc();

$conn->close();
?>

<?php include 'header.php'; ?>

<div class="main-content">
    <h2>Confirmación de Cita</h2>
    <p>¡Gracias por registrarse!</p>
    <div class="confirmation-details">
        <h3>Detalles de la Cita</h3>
        <p><strong>Doctor/a:</strong> <?php echo htmlspecialchars($doctor['name']); ?></p>
        <p><strong>Fecha y Hora:</strong> <?php echo htmlspecialchars($appointment_time); ?></p>
        
        <h3>Datos del Paciente</h3>
        <p><strong>Nombre:</strong> <?php echo $first_name; ?> <?php echo $last_name; ?></p>
        <p><strong>Teléfono:</strong> <?php echo $phone; ?></p>
        <p><strong>Correo Electrónico:</strong> <?php echo $email; ?></p>
        <p><strong>Dirección:</strong> <?php echo $address; ?></p>
    </div>
    <p><a href="index.php" class="button">Volver al Inicio</a></p>
</div>

<?php include 'footer.php'; ?>
