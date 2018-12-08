<?php
include("core/config.php");
                $user = $_POST["name"];
                $pass = $_POST["pass"];
                $consulta = "SELECT * FROM users WHERE nombre='".$user."'&&pass='".$pass."'";
                $ejecutar= mysqli_query($con, $consulta);
              //Hola mundo
                $fila =  mysqli_num_rows($ejecutar);
                if($fila>0){echo "<script>window.open('home.php','_self')</script>";}
                else
                {
                    echo "<link rel='stylesheet' href='css/bootstrap.min.css'>";
                    echo "<div class='alert alert-danger mt-3 ml-2 mr-2'><strong>Error: Usuario no Encontrado</strong><br><br><img src='img/fail.png' class='img img-thumbnail'><br><br><a href='index.html' class='alert-link'>Regresar</a></div>";}  
?>
