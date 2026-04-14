<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Java Coffee // Welcome to the IDE of Coffee</title>
    
    <link rel="stylesheet" href="public/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/custom-java.css">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300;500&display=swap" rel="stylesheet">
</head>
<body class="bg-dark text-light">

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top border-bottom border-secondary">
        <div class="container">
            <a class="navbar-brand text-success" href="index.html">Java Coffee //</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="index.html">Principal</a></li>
                    <li class="nav-item"><a class="nav-link" href="nosotros.html">Quiénes Somos</a></li>
                    <li class="nav-item"><a class="nav-link" href="catalogo.html">Catálogo</a></li>
                    <li class="nav-item"><a class="nav-link" href="comercializacion.html">Comercialización</a></li>
                    <li class="nav-item"><a class="nav-link" href="contacto.html">Contacto</a></li>
                    <li class="nav-item"><a class="nav-link" href="consultas.html">Consultas</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Clientes</a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="login.html">Login</a></li>
                            <li><a class="dropdown-item" href="registro.html">Registro</a></li>
                        </ul>
                    </li>
                </ul>
                <a href="catalogo.html" class="btn btn-outline-success ms-lg-3 btn-sm">Execute Checkout</a>
            </div>
        </div>
    </nav>

    <main class="container py-5">
        <section class="row align-items-center">
            <div class="col-md-6">
                <span class="badge bg-secondary mb-2">v4.2.0 Stable Build</span>
                <h1 class="display-3 fw-bold">Welcome to <span class="text-success italic">the IDE</span> of Coffee.</h1>
                <p class="lead text-secondary">Optimiza tu rutina diaria con granos de alto rendimiento. Perfiles de tostado diseñados para claridad mental.</p>
                <div class="mt-4">
                    <a href="catalogo.html" class="btn btn-success px-4 py-2 me-2">> Initialize Order</a>
                    <a href="nosotros.html" class="btn btn-outline-light px-4 py-2">Read Documentation</a>
                </div>
            </div>
            <div class="col-md-6 text-center">
                <div class="code-window shadow-lg mt-5 mt-md-0">
                    <div class="code-header"><span></span><span></span><span></span> brew_config.java</div>
                    <pre class="p-3 text-start mb-0"><code><span class="text-info">import</span> java.coffee.core.*;

<span class="text-warning">public class</span> MorningRoutine {
  <span class="text-info">public static final</span> Roast DARK_MATTER;
}</code></pre>
                </div>
            </div>
        </section>
    </main>

    <footer class="border-top border-secondary py-4 mt-5">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="mb-3 mb-md-0">
                <h5 class="text-success mb-0">Java Coffee //</h5>
                <small class="text-secondary">© 2026 JAVA COFFEE // BUILT FOR PERFORMANCE.</small>
            </div>
            <div class="footer-links">
                <a href="terminos.html" class="text-secondary text-decoration-none me-3">TERMS_OF_SERVICE</a>
                <a href="terminos.html" class="text-secondary text-decoration-none me-3">PRIVACY.PY</a>
                <a href="contacto.html" class="text-secondary text-decoration-none">SUPPORT_TICKETING</a>
            </div>
        </div>
    </footer>

    <script src="public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>