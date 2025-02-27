<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");
ini_set('display_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";  
$password = "";      
$dbname = "hotelgranespana";  

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión: ' . $conn->connect_error]);
    exit;
}

if (!isset($_POST['id_huesped'], $_POST['nombre'], $_POST['direccion'], $_POST['correo_electronico'], $_POST['nacionalidad'], $_POST['fecha_de_nacimiento'])) {
    echo json_encode(['success' => false, 'message' => 'Faltan parámetros']);
    exit;
}

$id_huesped = $_POST['id_huesped'];
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$correo_electronico = $_POST['correo_electronico'];
$nacionalidad = $_POST['nacionalidad'];
$fecha_nacimiento = $_POST['fecha_de_nacimiento']; 

$sql = "INSERT INTO registrar_huesped (id_huesped, nombre, direccion, correo_electronico, nacionalidad, fecha_de_nacimiento)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("isssss", $id_huesped, $nombre, $direccion, $correo_electronico, $nacionalidad, $fecha_nacimiento);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Huésped registrado exitosamente.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al registrar el huésped: ' . $conn->error]);
}

$stmt->close();
$conn->close();
?>
