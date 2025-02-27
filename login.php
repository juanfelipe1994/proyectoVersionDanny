<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "hotelgranespana";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Conexión fallida: ' . $conn->connect_error]));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        echo json_encode(['success' => false, 'message' => 'Faltan parámetros']);
        exit;
    }

    $usuario = $_POST['username']; 
    $contraseña = $_POST['password']; 

    $usuario = $conn->real_escape_string($usuario);
    $contraseña = $conn->real_escape_string($contraseña);

    try {
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = ? AND contraseña = ?");
        if ($stmt === false) {
            throw new Exception('Error al preparar la consulta SQL');
        }

        $stmt->bind_param("ss", $usuario, $contraseña);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Credenciales incorrectas']);
        }

        $stmt->close();
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}

$conn->close();
?>
