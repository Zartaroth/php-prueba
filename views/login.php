<?php include_once('../includes/header.php'); ?>
<div class="container">
    <div class="card">
        <h2>Iniciar Sesión</h2>
        <form action="../controllers/UserController.php?action=login" method="POST">
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Iniciar Sesión</button>
        </form>
        <p>¿Aún no tienes una cuenta? <a href="register.php">Regístrate aquí</a></p>
    </div>
</div>
<?php include_once('../includes/footer.php'); ?>
