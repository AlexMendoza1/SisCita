<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinic_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$doctor_id = $_POST['doctor'];

// Obtener horarios disponibles para el doctor
$today = date('Y-m-d');
$start_time = '09:00:00';
$end_time = '15:00:00';
$interval = 30; // minutos

$appointments = [];
$sql = "SELECT start_time FROM appointments WHERE doctor_id = ? AND appointment_date = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $doctor_id, $today);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $appointments[] = $row['start_time'];
}

$conn->close();
?>
<?php include 'header.php'; ?>

<div class="content">
    <h2>Seleccionar Hora</h2>
    <form action="register_patient.php" method="GET">
        <input type="hidden" name="doctor_id" value="<?php echo htmlspecialchars($doctor_id); ?>">
        <label for="time">Seleccione una hora:</label>
        <select name="time" id="time" required>
            <option value="">Seleccione...</option>
            <?php
            $current_time = $start_time;
            while ($current_time < $end_time) {
                if (!in_array($current_time, $appointments)) {
                    echo "<option value='".$current_time."'>".$current_time."</option>";
                }
                $current_time = date('H:i:s', strtotime($current_time) + ($interval * 60));
            }
            ?>
        </select>
        <button type="submit">Continuar</button>
    </form>
</div>

<?php include 'footer.php'; ?>
