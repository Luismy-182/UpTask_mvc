<?php 

foreach ($alertas as $key => $alerta): //el tipo de alerta
        foreach($alerta as $mensaje): // el mensaje de la alerta

?>
<div class="alerta <?php echo $key; ?>"><?php echo $mensaje;?></div>
<?php 
    endforeach;
endforeach;

?>