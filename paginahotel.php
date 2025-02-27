<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Hotelgranespana";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['registrar_huesped'])) {
    $id_huesped = $_POST['id_huesped'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $correo_electronico = $_POST['correo_electronico'];
    $nacionalidad = $_POST['nacionalidad'];
    $fecha_de_nacimiento = $_POST['fecha_de_nacimiento'];

    $sql = "INSERT INTO HUESPED (id_huesped, nombre, direccion, correo_electronico, nacionalidad, fecha_de_nacimiento)
            VALUES ('$id_huesped', '$nombre', '$direccion', '$correo_electronico', '$nacionalidad', '$fecha_de_nacimiento')";

    if ($conn->query($sql) === TRUE) {
        echo "Huésped registrado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
if (isset($_POST['crear_reserva'])) {
    $id_reserva = $_POST['id_reserva'];
    $fecha_de_reserva = $_POST['fecha_de_reserva'];
    $fecha_de_salida = $_POST['fecha_de_salida'];
    $numero_de_huespedes = $_POST['numero_de_huespedes'];
    $precio_total = $_POST['precio_total'];
    $forma_de_pago = $_POST['forma_de_pago'];
    $id_habitacion = $_POST['id_habitacion'];

    $sql = "INSERT INTO RESERVA (id_reserva, fecha_de_reserva, fecha_de_salida, numero_de_huespedes, precio_total, forma_de_pago, id_habitacion)
            VALUES ('$id_reserva', '$fecha_de_reserva', '$fecha_de_salida', '$numero_de_huespedes', '$precio_total', '$forma_de_pago', '$id_habitacion')";

    if ($conn->query($sql) === TRUE) {
        echo "Reserva creada exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
if (isset($_POST['gestionar_registro'])) {
    $id_registro = $_POST['id_registro'];
    $fecha_de_entrada = $_POST['fecha_de_entrada'];
    $fecha_de_salida = $_POST['fecha_de_salida'];
    $observaciones = $_POST['observaciones'];
    $id_reserva = $_POST['id_reserva_gestion'];

    $sql = "INSERT INTO REGISTRO (id_registro, fecha_de_entrada, fecha_de_salida, observaciones, id_reserva)
            VALUES ('$id_registro', '$fecha_de_entrada', '$fecha_de_salida', '$observaciones', '$id_reserva')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro gestionado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

