<!DOCTYPE html>
<html lang='es'>

<head>
    <?php require_once('./html/head.php') ?>
    <link href='../public/lib/calendar/lib/main.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <style>
        .custom-flatpickr {
            display: flex;
            align-items: center;
        }

        .custom-flatpickr input {
            margin-right: 5px;
            flex: 1;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class='container-xxl position-relative bg-white d-flex p-0'>
        <!-- Spinner Start -->
        <div id='spinner' class='show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center'>
            <div class='spinner-border text-primary' style='width: 3rem; height: 3rem;' role='status'>
                <span class='sr-only'>Cargando...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Sidebar Start -->
        <?php require_once('./html/menu.php') ?>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class='content'>
            <!-- Navbar Start -->
            <?php require_once('./html/header.php') ?>
            <!-- Navbar End -->

            <!-- Recent Books Start -->
            <div class='container-fluid pt-4 px-4'>
                <button type="button" onclick="cargarRoles()" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalmiembro">
                    Nuevo Miembro
                </button>
                <div class='d-flex align-items-center justify-content-between mb-4'>

                    <h6 class='mb-0'> Lista de Miembros </h6>
                    <br>

                    <table class="table table-bordered table-striped table-hover table-responsive">
                        <thead class="table-light text-center">
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Correo</th>
                                <th>Fecha de suscripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tabla_miembros">

                        </tbody>

                    </table>

                </div>

            </div>
            <!-- Recent Books End -->


            <!-- Footer Start -->
            <?php require_once('./html/footer.php') ?>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href='#' class='btn btn-lg btn-primary btn-lg-square back-to-top'><i class='bi bi-arrow-up'></i></a>
    </div>
    <!-- aqui van los modales -->



    <div class="modal fade" id="modalmiembro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo miembro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="frm_miembros">
                    <div class="modal-body">

                        <input type="hidden" name="id_miembro" id="id_miembro" value="0">

                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="nombre" placeholder="Ingrese nombre" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="apellido">Apellido</label>
                            <input type="text" name="apellido" id="apellido" placeholder="Ingrese apellido" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Correo</label>
                            <input type="mail" name="email" id="email" placeholder="Ingrese el correo" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="fecha_suscripcion">fecha de subscripcion</label>
                            <input type="date" name="fecha_suscripcion" id="fecha_suscripcion" placeholder="Ingrese elAño de Publicación" class="form-control" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <?php require_once('./html/scripts.php') ?>
    <script src="miembros.js"></script>


</body>

</html>