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
    die("Conexión fallida: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fechaEntrada = $_POST['fecha_de_entrada'];
    $fechaSalida = $_POST['fecha_de_salida'];
    $observaciones = $_POST['observaciones'];
    $sqlInsertar = "INSERT INTO crear_registro (fecha_de_entrada, fecha_de_salida, observaciones)
                    VALUES ('$fechaEntrada', '$fechaSalida', '$observaciones')";
    if ($conn->query($sqlInsertar) === TRUE) {
        echo json_encode(["message" => "Registro de entrada/salida guardado exitosamente."]);
    } else {
        echo json_encode(["error" => "Error al guardar el registro: " . $conn->error]);
    }

}
if (isset($_GET['buscar_id_registro'])) {

    $buscarIdRegistro = $_GET['buscar_id_registro'];
    $sqlBuscar = "SELECT * FROM crear_registro WHERE id_registro = '$buscarIdRegistro'";
    $result = $conn->query($sqlBuscar);
    if ($result->num_rows > 0) {
        $registros = [];
        while ($row = $result->fetch_assoc()) {
            $registros[] = [
                "id_registro" => $row["id_registro"],
                "fecha_de_entrada" => $row["fecha_de_entrada"],
                "fecha_de_salida" => $row["fecha_de_salida"],
                "observaciones" => $row["observaciones"]
            ];
        }
        echo json_encode(["data" => $registros]);
    } else {
        echo json_encode(["message" => "No se encontraron registros con ese ID."]);
    }

}
$conn->close();
?>
