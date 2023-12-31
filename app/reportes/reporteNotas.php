<?php ob_start(); ?>

<!DOCTYPE html>
<html lang="es">


<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte del examen</title>
    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #3498db; /* Color azul para los subtitulos */
            color: #fff;
            text-align: left;
        }

        h1 {
            text-align: center;
            color: chocolate;
        }

        .green {
            color: #168242;
            text-transform: uppercase;
            font-size: 14px;
        }

        .red {
            color: #E84949;
            text-transform: uppercase;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <?php
    require_once '../db/Conexion.php';

    $id_periodo = $_GET['id_periodo'];
    $id_nivel = $_GET['id_nivel'];
    $idcurso = $_GET['idcurso'];
    $idalumno = $_GET['idalumno'];
    $promedio = 0;
    $contador = 0;

    $conexion = Conexion::obtenerConexion();

    //RESULTADOS DEL EXAMEN DEL CURSO

    $sql = "SELECT *
    FROM notas n 
    WHERE n.id_periodo = $id_periodo 
    AND n.id_nivel = $id_nivel 
    AND n.idcurso = $idcurso 
    AND n.idalumno = $idalumno  
    ORDER BY n.id DESC";
    $stmt = $conexion->query($sql);

    $resultado =  $stmt->fetchAll(PDO::FETCH_ASSOC);

    //RESULTADO DE LA IE
    $sqlIE = "SELECT * FROM empresa ORDER BY id DESC LIMIT 1";
    $stmtIE = $conexion->query($sqlIE);
    $resultadoIE =  $stmtIE->fetchAll(PDO::FETCH_ASSOC);

    ?>
    <div style="border: 2px dashed #000000;">
        <table style="text-align: left;">
            <thead>
                <tr>
                    <th style="width: 50px;"></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width: 80px;">
                        <img src="<?php echo 'http://localhost/SistemaRA' . $resultadoIE[0]['logo'] ?>" alt="" style="max-width:80px">
                    </td>
                    <td style="text-align: left;">
                        <h2 style="text-align: left; margin: 0 0 1.5rem 0; text-transform: uppercase;"><?php echo $resultadoIE[0]['nombre'] ?></h2>
                        <p style="text-align: left; margin: .25rem 0;"><?php echo $resultadoIE[0]['celular'] ?></p>
                        <p style="text-align: left; margin: .25rem 0;"><?php echo $resultadoIE[0]['direccion'] ?></p>
                    </td>
                    <td style="text-align: right;">
                        <?php echo date('d-m-Y') ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <h1 style="color:chocolate">
        Reporte de notas
    </h1>
    <table class="table">
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>NOTA</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($resultado as $key) {
                $promedio +=floatval($key['nota']);
                $contador++;
            ?>
                <tr>
                    <td scope="row"><?php echo $key['descripcion'] ?></td>
                    <td><?php echo $key['fecha'] ?></td>
                    <td><strong><?php echo $key['nota'] ?></strong></td>
                </tr>
            <?php
            }
            ?>
            <tr >
                    <td scope="row" colspan="3" style="font-weight: bold;color: peru; font-size: 1.5rem; border:1px solid peru">Promedio final: <?php echo $promedio/$contador ?></td>
                </tr>
        </tbody>
    </table>
</body>

</html>

<?php

$html = ob_get_clean();

require_once '../../librerias/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$domPDF = new Dompdf();

$options = $domPDF->getOptions();
$options->set(array('isRemoteEnabled' => true));
$domPDF->setOptions($options);

//carga del documento
$domPDF->loadHtml($html);


$domPDF->setPaper('letter');
// $domPDF->setPaper('A4','landscape');
$domPDF->render();
$domPDF->stream('Resultado-del-examen.pdf', array('Attachment' => false));
?>