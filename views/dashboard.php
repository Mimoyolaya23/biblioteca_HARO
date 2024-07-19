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
                <button type="button" onclick="cargarRoles()" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalLibro">
                    Nuevo Libro
                </button>
                <div class='d-flex align-items-center justify-content-between mb-4'>

                    <h6 class='mb-0'> Lista de Libros </h6>
                    <br>

                    <table class="table table-bordered table-striped table-hover table-responsive">
                        <thead class="table-light text-center">
                            <tr>
                                <th>#</th>
                                <th>Titulo</th>
                                <th>Autor</th>
                                <th>Genero</th>
                                <th>Año Publicación</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tabla_libros">

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



    <div class="modal fade" id="modalLibro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Libro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="frm_libros">
                    <div class="modal-body">

                        <input type="hidden" name="id_libro" id="id_libro" value="0">

                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input type="text" name="titulo" id="titulo" placeholder="Ingrese el título del libro" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="autor">Autor</label>
                            <input type="text" name="autor" id="autor" placeholder="Ingrese el Autor" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="genero">Genero literario</label>
                            <input type="text" name="genero" id="genero" placeholder="Ingrese el genero literario" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="anio">Año de Publicación</label>
                            <input type="text" name="anio" id="anio" placeholder="Ingrese elAño de Publicación" class="form-control" required>
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


    <div class="modal fade" id="modalPrestamo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Préstamo de libro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="frm_prestamos">
                    <div class="modal-body">

                        <input type="hidden" name="id_prestamo" id="id_prestamo" value="0">

                        <div class="form-group">
                            <label for="titulo_prestamo">Título del Libro</label>
                            <input type="text" name="titulo_prestamo" id="titulo_prestamo" placeholder="Ingrese el título del prestamo" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="autor_prestamo">Autor</label>
                            <input type="text" name="autor_prestamo" id="autor_prestamo" placeholder="Ingrese el Autor" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="id_miembro">Miembro</label>
                            <select name="id_miembro" id="id_miembro" class="form-control" required>
                            </select>
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
    <script src="dashboard.js"></script>


</body>

</html>