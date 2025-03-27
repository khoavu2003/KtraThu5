<?php
require_once 'app/models/EmployeeModel.php';
require_once 'app/controllers/LoginController.php';

$url = $_GET['url'] ?? ''; // Không đặt mặc định login
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);

$controllerName = isset($url[0]) && $url[0] != '' ? ucfirst($url[0]) . 'Controller' : 'EmployeeController';
$action = isset($url[1]) && $url[1] != '' ? $url[1] : 'index';

// Kiểm tra nếu controller không tồn tại
if (!file_exists('app/controllers/' . $controllerName . '.php')) {
    die('Controller not found: ' . $controllerName);
}

require_once 'app/controllers/' . $controllerName . '.php';

$controller = new $controllerName();

// Kiểm tra nếu action không tồn tại
if (!method_exists($controller, $action)) {
    die('Action not found: ' . $action);
}

// Gọi action
call_user_func_array([$controller, $action], array_slice($url, 2));
