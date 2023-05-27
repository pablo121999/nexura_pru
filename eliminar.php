<?php
include("config/bd.php");
$txtid = (isset($_GET['id'])) ? $_GET['id'] : "";

// Validar los campos antes 
if ($txtid != "") {
    // elimina el registro
    $sql = "DELETE FROM empleado  WHERE id=$txtid";
    $sqldel = "DELETE FROM empleado_rol  WHERE empleado_id=$txtid";
  
    if ($conn->query($sql) === TRUE && $conn->query($sqldel) === TRUE) {
        echo "se elimino correctamente.";
        //cerrar conexion
        $conn->close();
          //envio el id para confirmar eliminacion
          echo " <script> window.location.href='mostrar.php ?iddel=<?php echo sanitize(".$txtid."); ?> '; </script> ";
    } else {
        echo "Error al eliminar: "; //$conn->error;

    }
}



?>