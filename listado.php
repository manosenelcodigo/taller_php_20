<?php
require_once("usuarios.php");
$u=new Usuarios();
$cantidad_resultados_por_pagina=20;

    if(isset($_GET["pagina"]))
    {
        if(is_numeric($_GET["pagina"]))
        {
            if($_GET["pagina"]==1)
            {
                header("Location: listado.php");
            }else
            {
                $pagina=$_GET["pagina"];
            }
            
        }else
        {
           header("Location: listado.php"); 
        }
    }else
    {
        //header("Location: listado.php");
        $pagina=1;
    }
    //echo $pagina;exit;
    $empezar_desde=($pagina-1 )*$cantidad_resultados_por_pagina;
    $sql1="
        select count(*) as cuantos from paises;
    ";
    $todos=$u->getDatos($sql1);
    $sql="
        select id,iso,nombre from paises
        order by id desc
        limit ".$empezar_desde.",".$cantidad_resultados_por_pagina."
    ";
    //echo $sql;exit;
    $datos=$u->getDatos($sql);
    //print_r($datos);exit;
    //obtenemos el total de páginas existentes
    $total_paginas=ceil($todos[0]->cuantos/$cantidad_resultados_por_pagina);
    //echo $total_paginas;exit;
?>
<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8" />
            <title>Paginación de registros con PHP</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        </head>
        <body>
            
            <div class="container">
                <div class="row">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Paginación de registros (<?php echo $todos[0]->cuantos?> en total)</h3>
                        </div>
                        <div class="panel-body">
                            
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>NIC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $impresos=0;
                                    foreach($datos as $dato)
                                    {
                                        $impresos++;
                                        ?>
                                        <tr>
                                            <td><?php echo $dato->id?></td>
                                            <td><?php echo $dato->nombre?></td>
                                            <td><?php echo $dato->iso?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                <tr>
                                    <td colspan="3">
                                        <div class="pull-right">
                                            <ul class="pagination">
                                                <li><a href="listado.php">&#60;&#60;&#60;&#60;</a></li>
                                                <?php
                                                if($pagina==1)
                                                {
                                                    ?>
                                                    <li class="disabled"><a href="javascript:void(0);">&#60;&#60;</a></li>
                                                    <?php
                                                }else
                                                {
                                                    $anterior=$pagina-1;
                                                    ?>
                                                    <li><a href="listado.php?pagina=<?php echo $anterior?>">&#60;&#60;</a></li>
                                                    <?php
                                                }
                                                ?>
                                                
                                                <?php
                                                for($i=1;$i<=$total_paginas;$i++)
                                                {
                                                    ?>
                                                    <li <?php if($pagina==$i){echo 'class="active"';}?>><a href="listado.php?pagina=<?php echo $i;?>"><?php echo $i?></a></li>
                                                    <?php
                                                }
                                                ?>
                                                
                                                
                                                
                                                <?php
                                                if($impresos==$cantidad_resultados_por_pagina and $pagina<$total_paginas)
                                                {
                                                    $proximo=$pagina+1;
                                                    ?>
                                                    <li><a href="listado.php?pagina=<?php echo $proximo?>">&#62;&#62;</a></li>
                                                    <?php
                                                }else
                                                {
                                                    ?>
                                                    <li class="disabled"><a href="javascript:void(0);">&#62;&#62;</a></li>
                                                    <?php
                                                }
                                                ?>
                                                
                                                
                                                
                                                <li><a href="listado.php?pagina=<?php echo $total_paginas?>">&#62;&#62;&#62;&#62;</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                                
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
            
        </body>
    </html>
