<?php
include("template/header.php");

include("config/bd.php");


// areas
$sql = "SELECT * FROM areas";
$areas = $conn->query($sql);
// roles
$sql = "SELECT * FROM roles";
$result = $conn->query($sql);



$idsave = (isset($_GET['idsave'])) ? $_GET['idsave'] : "";

if (!empty($idsave)) { ?>


    <div class="container">
        <div class=" justify-content-center  align-items-left ">
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert" s>
                <strong>

                    <!-- icono -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg>

                    Se Agrego El Registro Correctamente.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>


    <?php
}



?>


<div class="container">

    <div class="row  vh-100 justify-content-center  align-items-center text-center">

        <div class="col-auto bg-ligth p-5 ">
            <i>
                <h2>Crear Empleado</h2>
            </i>

            <form onsubmit="return validarFormulario();" method="POST" enctype="multipart/form-data">


                <div class="form-group col-p-5">
                    <label for="nombre" class="col-form-label"><b>Nombre:</b></label>
                    <input class="form-control" type="text" name="nombre" placeholder="Nombre" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+"
                        required>
                </div>
                <div class="form-group col-p-5">
                    <label for="correo" class="col-form-label"><b>Correo:</b></label>
                    <input type="email" id="correo" name="correo" placeholder="correo" class="form-control"
                        pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required>
                </div>
                <div>
                    <label for="masculino" class="col-form-label"><b>Genero:</b></label>
                    </br>
                    <input type="radio" id="masculino" name="sexo" value="M" required>
                    <label for="masculino">Masculino</label>
                    </br>
                    <input type="radio" id="femenino" name="sexo" value="F" required>
                    <label for="femenino">Femenino</label>
                </div>
                <div class="form-group col-p-5">
                    <label for="area" class="col-form-label"><b>Area:</b></label>
                    <select id="area" name="area" class="form-select" required>
                        <option value="" selected>Seleccione...</option>
                        <?php if ($areas->num_rows > 0) { ?>
                            <?php foreach ($areas as $area): ?>
                                <option value="<?php echo $area['id']; ?>"> <?php echo $area['nombre']; ?></option>
                            <?php endforeach;
                        } ?>

                    </select>
                </div>
                <div class="form-group col-p-7">
                    <label for="descripcion" class="col-form-label"><b>Descripción:</b></label>
                    <textarea id="descripcion" name="descripcion" placeholder="descripcion" class="form-control"
                        required></textarea>
                </div>
                </br>

                <div class="form-group col-p-5">
                    <input type="checkbox" name="boletin" value="<?php echo $boletin; ?>">
                    <label for="boletin" class="col-form-label"><b>Desea recibir boletín informativo</b></label>
                </div>

                <div class="form-group col-p-12" style="display: block;">
                    <label for="roles" class="col-form-label"><b>Roles:</b></label>
                    </br>
                    <?php if ($result->num_rows > 0) { ?>
                        <?php foreach ($result as $roles): ?>
                            <div style="margin-top: 5px;">
                                <input type="checkbox" name="roles" value="<?php echo $roles['id']; ?>"> <?php echo $roles['nombre']; ?> </input>
                            </div>
                        <?php endforeach;
                    } ?>
                </div>

                </br>
                <button type="submit" class="btn btn-success">Crear</button>
                <button type="button" class="btn btn-warning" onclick=location.href="mostrar.php"> Ver Empleados
                </button>
            </form>

        </div>
    </div>
</div>

<body>



    <?php

    $nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : "";
    $correo = (isset($_POST['correo'])) ? $_POST['correo'] : "";
    $sexo = (isset($_POST['sexo'])) ? $_POST['sexo'] : "";
    $area = (isset($_POST['area'])) ? $_POST['area'] : "";
    $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : "";
    $boletin = isset($_POST['boletin']) ? '1' : '0';
    $roles = (isset($_POST['roles'])) ? $_POST['roles'] : "";




    if (!empty($nombre)) {

        // Validar y limpiar los datos de entrada
        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
        $correo = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_STRING);
        $sexo = filter_input(INPUT_POST, 'sexo', FILTER_SANITIZE_STRING);
        $area = filter_input(INPUT_POST, 'area', FILTER_SANITIZE_STRING);
        $descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_STRING);
        //$boletin = filter_input(INPUT_POST, 'boletin', FILTER_SANITIZE_STRING);
        $roles = filter_input(INPUT_POST, 'roles', FILTER_SANITIZE_STRING);


        $sql = "INSERT INTO empleado (id,nombre, email,sexo, area_id,boletin,descripcion) VALUES (null,'$nombre', '$correo', '$sexo', '$area', '$boletin', '$descripcion')";

        if ($conn->query($sql) === TRUE) {

            $idEmpleado = $conn->insert_id; // obtener el id del empleado recien registrado
            $sqlrol = "INSERT INTO empleado_rol (empleado_id,rol_id) VALUES ('$idEmpleado', '$roles')";
            if ($conn->query($sqlrol) === TRUE) {

                //autoenvio el id para confirmar registro
                echo " <script> window.location.href='index.php ?idsave=<?php echo sanitize(" . $idEmpleado . "); ?> '; </script> ";

            } else {
                echo "Error al insertar el registro: " . $conn->error;
            }

        } else {
            echo "Error al insertar el registro: " . $conn->error;
        }

    }

    $conn->close();
    include("template/footer.php");
    ?>