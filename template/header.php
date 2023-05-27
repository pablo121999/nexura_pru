<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>





    <script>
        function validarFormulario() {
            // Obtener los valores de los campos
            var nombre = document.getElementById('nombre').value;
            var correo = document.getElementById('correo').value;
            var sexo = document.querySelector('input[name="sexo"]:checked');
            var area = document.getElementById('area').value;
            var descripcion = document.getElementById('descripcion').value;
            var deseaBoletin = document.getElementById('boletin').checked;
            var roles = document.getElementById('roles').checked;

            // Validar que los campos no estén vacíos
            if (nombre === '' || correo === '' || sexo === null || area === '' || descripcion === '' || deseaBoletin=== '' || roles === '') {
                alert('Por favor, complete todos los campos.');
                return false;
            }

            // Validar el formato del correo electrónico
            var emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,})+$/;
            if (!emailRegex.test(correo)) {
                alert('Por favor, ingrese un correo electrónico válido.');
                return false;
            }

            // Si pasa todas las validaciones, se puede enviar el formulario
            alert('Formulario enviado correctamente.');
            return true;
        }
    </script>

</head>


<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" onclick=location.href="index.php" type="button"><i>Empleados</i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" type="button" aria-current="page"
                        onclick=location.href="index.php"><i>Inicio</i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" type="button" aria-current="page"
                        onclick=location.href="crear.php"><i>Crear Empleado</i></a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit"><i>Search</i></button>
            </form>
        </div>
    </div>
</nav>




<body>