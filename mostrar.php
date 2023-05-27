<?php
include("template/header.php");
include("config/bd.php");

// areas
$sql = "SELECT * FROM areas";
$areas = $conn->query($sql);

// Validación y sanitización de entrada
function sanitize($data)
{
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}


$idupdate = (isset($_GET['idupdate'])) ? $_GET['idupdate'] : "";
$iddel = (isset($_GET['iddel'])) ? $_GET['iddel'] : "";


// alerta actualizacion de empleado
if (!empty($idupdate)) { ?>
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

                    Se ha actualizado correctamente.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>



    <?php
}

// alerta Eliminacion de empleado
if (!empty($iddel)) { ?>
    <div class="container">
        <div class=" justify-content-center  align-items-left ">
            <div class="alert alert-danger alert-dismissible fade show text-center" role="alert" s>
                <strong>
                    <!-- icono -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg>

                    Se ha Eliminado correctamente.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <?php
}

?>



<div class="container">
    <div class=" justify-content-center  align-items-left ">
        <i>
            <h1 style="text-align: center">Lista de Empleados</h1>
        </i>

        <?php
        $sql = "SELECT * FROM empleado";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) { ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Sexo</th>
                        <th>Area</th>
                        <th>Boletin</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $empleado): ?>
                        <tr>
                            <td>
                                <?php echo sanitize($empleado['nombre']); ?>
                            </td>
                            <td>
                                <?php echo sanitize($empleado['email']); ?>
                            </td>
                            <td>
                                <?php
                                if ($empleado['sexo'] == "M") {
                                    $M = "Masculino";
                                    echo sanitize($M);
                                } else {
                                    $F = "Femenino";
                                    echo sanitize($F);
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                foreach ($areas as $area):
                                    if ($empleado['area_id'] == $area['id']) {
                                        echo sanitize($area['nombre']);
                                    }
                                endforeach;
                                ?>
                            </td>
                            <td>
                                <?php

                                if ($empleado['boletin'] == "1") {
                                    $S = "Si";
                                    echo sanitize($S);
                                } else {
                                    $N = "No";
                                    echo sanitize($N);
                                }
                                ?>
                            </td>
                            <td>
                                <form method="post">
                                    <button type="button" class="btn btn-primary" name="accion"
                                        onclick="location.href='editar.php?id=<?php echo sanitize($empleado['id']); ?>'">
                                        Actualizar</button>
                                </form>
                            </td>
                            <td>
                                <form method="post">
                                    <button type="button" name="accion"
                                        onclick="location.href='eliminar.php?id=<?php echo sanitize($empleado['id']); ?>'"
                                        value="Borrar" class="btn btn-danger">
                                        Borrar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</div>

<?php
$conn->close();
include("template/footer.php");
?>