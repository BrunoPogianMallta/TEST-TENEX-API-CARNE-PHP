<?php

use Slim\Routing\RouteCollectorProxy;
use App\Controllers\CarnesController;

return function (RouteCollectorProxy $group) {
    $group->post('/carne', [CarnesController::class, 'criarCarne']);
    $group->get('/carne/{id}', [CarnesController::class, 'recuperarParcelas']);
};
