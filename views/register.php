<?php include_once('../includes/header.php'); ?>
<div class="container">
    <div class="card">
        <h2>Crear Usuario</h2>
        <form action="../controllers/UserController.php?action=register" method="POST">
            <input type="text" name="name" placeholder="Nombre" required>
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Registrarse</button>
        </form>
        <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>
    </div>
</div>
<?php include_once('../includes/footer.php'); ?>
