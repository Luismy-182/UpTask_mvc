<div class="contenedor olvide">
    <?php include_once __DIR__ .'/../templates/nombre-sitio.php'; ?>


    <div class="contenedor-sm">
        <p class="descripcion-pagina">Recupera tu cuenta en Uptask</p>
<?php include_once __DIR__ .'/../templates/alertas.php'; ?>
        <form action="/olvide" class="formulario" method="POST">
        
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Introduce tu email" id="email" >
            </div>

            
            <input type="submit" class="boton" value="Enviar instrucciones">
        </form>
        <div class="acciones">
            <a href="/">¿Ya tienes una cuenta? Iniciar sesión</a>
            <a href="/crear">¿Aun no tienes cuenta? Crea una</a>
        </div>
    </div><!--contenedor-sm--> 
    <footer class="footer text-white">
    <p class="text-center ">&copy; <span>Miguel Angel Suarez | <?php echo(date('Y') ); ?></span>. Todos los derechos reservados</p>
    </footer>
</div>