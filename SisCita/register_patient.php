<?php
if (!isset($_GET['doctor_id']) || !isset($_GET['time'])) {
    die("Datos incompletos.");
}

$doctor_id = $_GET['doctor_id'];
$appointment_time = $_GET['time'];

include 'header.php';
?>

<div class="main-content">
    <h2>Registrar Paciente</h2>
    
    <form action="process_patient.php" method="post">
        <input type="hidden" name="doctor_id" value="<?php echo htmlspecialchars($doctor_id); ?>">
        <input type="hidden" name="appointment_time" value="<?php echo htmlspecialchars($appointment_time); ?>">
        
        <label for="first_name">Nombre:</label>
        <input type="text" id="first_name" name="first_name" required>
        
        <label for="last_name">Apellido:</label>
        <input type="text" id="last_name" name="last_name" required>
        
        <label for="phone">Teléfono:</label>
        <input type="tel" id="phone" name="phone">
        
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email">
        
        <label for="address">Dirección:</label>
        <textarea id="address" name="address" rows="4"></textarea>
        
        <button type="submit" class="button">Guardar Datos</button>
    </form>
</div>

<?php include 'footer.php'; ?>
