<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos docentes | Sistema Realidad aumentada</title>
    <?php include './componentes/bootstrap.php' ?>
    <link rel="stylesheet" href="./assets/css/main.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <?php include './componentes/header.php' ?>
    <main class="main">
        <div class="form-control">
            <div class="card-header">
                <div class="mb-3 mt-2 flex-center">
                    <input type="search" class="form-control" id="search" placeholder="Buscar...">

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Asignar curso docentes</button>
                </div>
            </div>
            <div class="card-body  over-flow-auto">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Curso</th>
                            <th scope="col">Docente</th>
                            <th scope="col">Nivel</th>
                            <th scope="col">Periodo</th>
                            <th scope="col" class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="dataBody">

                    </tbody>
                </table>
            </div>
        </div>

        <!-- registrar usuarios -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Asignar cursos</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="register" autocomplete="off">
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="id_periodo" class="form-label">Periodos</label>
                                    <select class="form-select" id="id_periodo" aria-label="Default select example">
                                    </select>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="id_docente" class="form-label">Docentes</label>
                                    <select class="form-select" id="id_docente" aria-label="Default select example">
                                    </select>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="id_nivel" class="form-label">Nivel académico</label>
                                    <select class="form-select" id="id_nivel" aria-label="Default select example">
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="id_curso" class="form-label">Cursos</label>
                                <select class="form-select" id="id_curso" aria-label="Default select example">
                                </select>
                            </div>


                            <div id="cursos-asignados">
                               
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script src="./assets/js/header.js"></script>
    <script src="./app/scripts/cursos-docente.js" type="module"></script>
</body>

</html>