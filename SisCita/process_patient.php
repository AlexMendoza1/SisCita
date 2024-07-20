<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinic_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];
$doctor_id = $_POST['doctor_id'];
$appointment_time = $_POST['appointment_time'];

// Insertar datos del paciente
$sql = "INSERT INTO patients (first_name, last_name, phone, email, address)
        VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $first_name, $last_name, $phone, $email, $address);

if ($stmt->execute()) {
    $patient_id = $conn->insert_id; // Obtener el ID del paciente recién creado
    
    // Guardar la cita del paciente
    $today = date('Y-m-d');
    $sql_appointment = "INSERT INTO appointments (doctor_id, id, appointment_date, start_time)
                        VALUES (?, ?, ?, ?)";
    $stmt_appointment = $conn->prepare($sql_appointment);
    $stmt_appointment->bind_param("iiss", $doctor_id, $id, $today, $appointment_time);
    
    if ($stmt_appointment->execute()) {
        // Redirigir a la página de confirmación con los datos del paciente
        header("Location: confirm_appointment.php?doctor_id=$doctor_id&appointment_time=$appointment_time&first_name=".urlencode($first_name)."&last_name=".urlencode($last_name)."&phone=".urlencode($phone)."&email=".urlencode($email)."&address=".urlencode($address));
        exit();
    } else {
        echo "Error al registrar la cita: " . $stmt_appointment->error;
    }
} else {
    echo "Error al registrar el paciente: " . $stmt->error;
}

$conn->close();
?>
