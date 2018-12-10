
<?php
require_once("conf.php");
include("config.php")
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Monitoreo de Temperatura</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap-reboot.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>
	<nav class="navbar navbar-expand-md navbar-dark bg-dark sidebarNavigation" data-sidebarClass="navbar-dark bg-dark">
			<button class="navbar-toggler rightNavbarToggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
					aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation" onclick="window.history.go(-1); return false;">
					<i class="fas fa-long-arrow-alt-left"></i>
			</button>
			<a class="navbar-brand" href="#" >Historial de temperatura</a>
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
