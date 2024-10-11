<div class="contenedor reestablecer">
    <?php include_once __DIR__ .'/../templates/nombre-sitio.php'; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Coloca tu nuevo password</p>
        <?php include_once __DIR__ .'/../templates/alertas.php'; ?>


        <?php if($mostrar){ ?>
        
        
        
            <form class="formulario" method="POST">
        
            <div class="campo">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Introduce tu nuevo password" id="password">
            </div>

            
            <input type="submit" class="boton" value="Guardar password">
        </form>

        <?php } ?>
        <div class="acciones">
            <a href="/">¿Ya tienes una cuenta? Iniciar sesión</a>
            <a href="/crear">¿Aun no tienes cuenta? Crea una</a>
        </div>
    </div><!--contenedor-sm--> 
    <footer class="footer text-white">
    <p class="text-center ">&copy; <span>Miguel Angel Suarez | <?php echo(date('Y') ); ?></span>. Todos los derechos reservados</p>
    </footer>
</div>