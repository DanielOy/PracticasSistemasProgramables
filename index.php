
<?php
require_once("conf.php");
include("config.php")
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Monitoreo de Temperatura</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap-reboot.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>
	<nav class="navbar navbar-expand-md navbar-dark bg-dark sidebarNavigation" data-sidebarClass="navbar-dark bg-dark">
			<a class="navbar-brand" href="#">Control de temperatura</a>
			<button class="navbar-toggler leftNavbarToggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
					aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarsExampleDefault">
					<ul class="navbar-nav mr-auto">
							<li class="nav-item active">
									<a class="nav-link" href="index.html">Inicio
											<span class="sr-only">(current)</span>
									</a>
							</li>
							<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true"
											aria-expanded="false">Información</a>
									<div class="dropdown-menu" aria-labelledby="dropdown01">
											<a class="dropdown-item" href="#">Contacto</a>
											<a class="dropdown-item" href="#">Aviso Legal</a>
									</div>
							</li>
					</ul>

			</div>
	</nav>
	<br>

<div class="">
	<div class="column">
		<?php

			$consulta = "SELECT * FROM temperatura ORDER BY id DESC LIMIT 10";
                $ejecutar= mysqli_query($con, $consulta);
                $i=0;
				$valores = array();
                while ($fila =  mysqli_fetch_array($ejecutar) and ($i<10)){
                    $id=$fila['id'];
					$valor=$fila['valor'];
				$i++;
				array_push($valores,floatval($valor));
                }
                $valores = array_reverse($valores);

				$pc = new C_PhpChartX(array($valores),'basic_chart');
				$pc->set_title(array('text'=>'Historial de Temperaturas'));
				$pc->set_animate(true);
				$pc->set_grid(array(
    	'background'=>'lightblue',
    	'borderWidth'=>0,
    	'borderColor'=>'#0101DF',
    	'shadow'=>true,
    	'shadowWidth'=>10,
    	'shadowOffset'=>3,
    	'shadowDepth'=>3,
    	'shadowColor'=>'rgba(230, 230, 230, 0.7)'
    	));

			$pc->draw();
			?>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col"></div>
		<div class="button col">
			<a href="javascript:location.reload()" class="btn btn-lg btn-primary mt-3 ml-3"><i class="fas fa-sync"></i> Recargar datos</a>
		</div>
		<div class="col"></div>
	</div>
	<a>Registro de Temperaturas</a>
	<pre>
    <?php
        print_r($valores);
    ?>
</pre>

<?php
function pp($valores){
    $retStr = '<ul>';
    if (is_array($valores)){
        foreach ($valores as $key=>$valores){
            if (is_array($valores)){
                $retStr .= '<li>' . $key . ' => ' . pp($valores) . '</li>';
            }else{
                $retStr .= '<li>' . $key . ' => ' . $valores . '</li>';
            }
        }
    }
    $retStr .= '</ul>';
    return $retStr;
}

?>
</div>
<style>
    .jqplot-target{
        position: relative !important;
        width: auto !important;
    }
</style>
<script>
jQuery(document).ready(function($){
    $(window).on("resize",function(event){
        $.each(_chart1.series, function(index, series) { series.barWidth = undefined; });
        _chart1.destroy(); // Destroy the chart..
        _chart1.replot(); // Replot the chart with new/old values..
    });
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>

</body>
</html>
