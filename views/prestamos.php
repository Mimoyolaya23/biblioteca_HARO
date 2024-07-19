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
                <div class='d-flex align-items-center justify-content-between mb-4'>

                    <h6 class='mb-0'> Lista de Prestamos </h6>
                    <br>

                    <table class="table table-bordered table-striped table-hover table-responsive">
                        <thead class="table-light text-center">
                            <tr>
                                <th>#</th>
                                <th>Nombre Miembro</th>
                                <th>Título Libro</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody id="tabla_prestamos">

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



    <!-- JavaScript Libraries -->
    <?php require_once('./html/scripts.php') ?>
    <script src="prestamos.js"></script>


</body>

</html>