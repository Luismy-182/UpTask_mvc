<div class="contenedor crear">
    <?php include_once __DIR__ .'/../templates/nombre-sitio.php'; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Crear cuenta</p>
        <?php include_once __DIR__ .'/../templates/alertas.php'; ?>
        <form action="/crear" class="formulario" method="POST">
            
        <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="nombre" name="nombre" placeholder="Tu nombre" id="nombre" value="<?php echo $usuario->nombre; ?>">
            </div>
        
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Tu email" id="email" value="<?php echo $usuario->email; ?>">
            </div>

            <div class="campo">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Tu password" id="password">
            </div>

            <div class="campo">
                <label for="password2">Repite tu password</label>
                <input type="password" name="password2" placeholder="Repite tu password" id="password2">
            </div>
            <input type="submit" class="boton" value="Crear cuenta">
        </form>
        <div class="acciones">
            <a href="/">¿Ya tienes una cuenta? Iniciar sesión</a>
            <a href="/olvide">¿Olvidaste tu password?</a>
        </div>
    </div><!--contenedor-sm--> 
    <footer class="footer text-white">
    <p class="text-center ">&copy; <span>Miguel Angel Suarez | <?php echo(date('Y') ); ?></span>. Todos los derechos reservados</p>
    </footer>
</div>