<?php
// --- INCLUSIONES DE ARCHIVOS ---
// Estos archivos son necesarios para la configuración, el router y el controlador
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/libs/router/router.php';
require_once __DIR__ . '/controllers/PerfumesApiController.php';

// --- CONEXIÓN E INICIALIZACIÓN DE LA BASE DE DATOS ---
try {
    // Conexión inicial sin seleccionar la base de datos
    $pdo = new PDO('mysql:host=' . DB_HOST, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar si la base de datos existe. Si no, la inicializa.
    $stmt = $pdo->query("SHOW DATABASES LIKE '" . DB_NAME . "'");
    if ($stmt->rowCount() === 0) {
        require_once __DIR__ . '/app/db/init.php';
    } else {
        // Si existe, la usa
        $pdo->exec('USE `' . DB_NAME . '`');
    }
} catch (PDOException $e) {
    // Muestra un error si falla la conexión o la inicialización de la DB
    die('Error al conectar o crear la base de datos: ' . $e->getMessage());
}


// --- CONFIGURACIÓN DEL ENRUTADOR (ROUTER) ---

$router = new Router();

// Rutas de la API para Perfumes
// GET /perfumes            -> PerfumesApiController::getAll (con filtros opcionales)
$router->addRoute('perfumes', 'GET', 'PerfumesApiController', 'getAll');
// GET /perfumes/:id        -> PerfumesApiController::get
$router->addRoute('perfumes/:id', 'GET', 'PerfumesApiController', 'get');
// POST /perfumes           -> PerfumesApiController::create
$router->addRoute('perfumes', 'POST', 'PerfumesApiController', 'create');
// PUT /perfumes/:id        -> PerfumesApiController::update
$router->addRoute('perfumes/:id', 'PUT', 'PerfumesApiController', 'update');
// DELETE /perfumes/:id     -> PerfumesApiController::delete
$router->addRoute('perfumes/:id', 'DELETE', 'PerfumesApiController', 'delete');

// Ruta por defecto: Si el recurso solicitado no coincide con ninguna ruta,
// se llama a la función 'notFound'.
$router->setDefaultRoute('PerfumesApiController', 'notFound');

// --- EJECUCIÓN DEL ENRUTADOR ---
// El router procesa la petición usando el parámetro 'resource' (de la URL) y el método HTTP.
$router->route($_GET['resource'] ?? '', $_SERVER['REQUEST_METHOD']);