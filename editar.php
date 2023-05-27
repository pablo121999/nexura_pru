<?php
include("template/header.php");
include("config/bd.php");

$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : "";
$correo = (isset($_POST['correo'])) ? $_POST['correo'] : "";
$sexo = (isset($_POST['sexo'])) ? $_POST['sexo'] : "";
$area = (isset($_POST['area'])) ? $_POST['area'] : "";
$descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : "";
$boletin = isset($_POST['boletin']) ? '1' : '0';
$roles = (isset($_POST['roles'])) ? $_POST['roles'] : "";

$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

$txtid = (isset($_GET['id'])) ? $_GET['id'] : "";


if ($accion == "Actualizar") {
    // Validar los campos antes de la actualización
    if (!empty($nombre)) {
        // Actualizar el registro
        $sql = "UPDATE empleado SET nombre='$nombre', email='$correo', email='$correo', sexo='$sexo', area_id='$area', boletin='$boletin', descripcion='$descripcion' WHERE id=$txtid";
        $sqlro = "UPDATE empleado_rol SET rol_id='$roles'  WHERE empleado_id=$txtid";

        if ($conn->query($sql) === TRUE && $conn->query($sqlro) === TRUE) {
            //se creo correctamente"      
        }

    }
    //envia el id para confirmar 
    echo " <script> window.location.href='index.php ?idupdate=<?php echo sanitize(" . $txtid . "); ?> '; </script> ";
}

// cargar informacion
$sql = "SELECT nombre, email,sexo,area_id ,boletin,descripcion FROM empleado WHERE id=$txtid";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nombre = $row['nombre'];
        $correo = $row['email'];
        $sexo = $row['sexo'];
        $area = $row['area_id'];
        $descripcion = $row['descripcion'];
        $boletin = $row['boletin'];
        break;
    }
} else {
    echo "No se encontró ningún registro.";
}

// rol del empleado seleccionado actualmente
$sqlempleadorol = "SELECT * FROM empleado_ro WHERE empleado_id=$txtid";
$emplerol = $conn->query($sqlempleadorol);
if ($emplerol != '') {
    foreach ($emplerol as $r):

        $roles = $r['id'];
    endforeach;
}



// roles
$sqlroles = "SELECT * FROM roles";
$resul = $conn->query($sqlroles);



// areas
$sql = "SELECT * FROM areas";
$areas = $conn->query($sql);


//cerrar conexion
$conn->close();


?>
<div class="container">

    <div class="row  vh-100 justify-content-center  align-items-center text-center">

        <div class="col-auto bg-ligth p-5 ">
            <i>
                <h1>lista</h1>
                <h2>Crear Usuario</h2>
            </i>

            <form onsubmit="return validarFormulario();" method="POST" enctype="multipart/form-data">

                <div class="form-group col-p-5">
                    <label for="nombre" class="col-form-label"><b>Nombre:</b></label>
                    <input class="form-control" type="text" name="nombre" value="<?php echo $nombre; ?>" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+"
                        placeholder="Nombre" required>
                </div>
                <div class="form-group col-p-5">
                    <label for="correo" class="col-form-label"><b>Correo:</b></label>
                    <input type="email" id="correo" value="<?php echo $correo; ?>" name="correo" placeholder="correo"  pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"
                        class="form-control" required>
                </div>
                <div>
                    <label for="masculino" class="col-form-label"><b>Genero:</b></label>
                    </br>
                    <!--por si no selecionan genero tome el que tenia antes -->
                    <input type="hidden" name="sexo" value="<?php echo $sexo; ?>">

                    <input type="radio" id="masculino" name="sexo" value="M">
                    <label for="masculino">Masculino</label>
                    </br>
                    <input type="radio" id="femenino" name="sexo" value="F">
                    <label for="femenino">Femenino</label>

                </div>
                <div class="form-group col-p-5">
                    <label for="area" class="col-form-label"><b>Area:</b></label>
                    <select id="area" name="area" class="form-select" required>
                        <option value="<?php echo $area; ?>" selected>Seleccione...</option>
                        <?php if ($areas->num_rows > 0) { ?>
                            <?php foreach ($areas as $area): ?>
                                <option value="<?php echo $area['id']; ?>"> <?php echo $area['nombre']; ?></option>
                            <?php endforeach;
                        } ?>

                    </select>
                </div>
                <div class="form-group col-p-5">
                    <label for="descripcion" class="col-form-label"><b>Descripción:</b></label>
                    <textarea name="descripcion" value="<?php echo $descripcion; ?>" class="form-control"
                        required><?php echo $descripcion; ?> </textarea>
                </div>
                </br>
                <div class="form-group col-p-5">
                    <input type="checkbox" name="boletin" value="<?php echo $boletin; ?>">
                    <label for="boletin" class="col-form-label"><b>Desea recibir boletín informativo</b></label>
                </div>

                <div class="form-group col-p-12" style="display: block;">
                    <label for="roles" class="col-form-label"><b>Roles:</b></label>
                    </br>
                    <?php if ($resul->num_rows > 0) { ?>
                        <?php foreach ($resul as $rol): ?>
                            <div style="margin-top: 5px;">
                                <?php if ($roles == $rol['id']) { ?>
                                    <input type="checkbox" name="roles" value="<?php echo $roles; ?>"> <?php echo $rol['nombre']; ?></input>
                                <?php } else { ?>
                                    <input type="checkbox" name="roles" value="<?php echo $rol['id']; ?>"> <?php echo $rol['nombre']; ?> </input>
                                <?php } ?>
                            </div>
                        <?php endforeach;
                    } ?>
                </div>

                </br>
                <button type="submit" name="accion" class="btn btn-primary" value="Actualizar"> Actualizar </button>
                <button type="button" class="btn btn-warning" onclick=location.href="mostrar.php"> Cancelar
                </button>
            </form>

        </div>
    </div>
</div>



<?php
include("template/footer.php");
?>