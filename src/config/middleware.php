<?php

use Slim\App;

return function (App $app) {
    $app->addBodyParsingMiddleware();
    $app->addErrorMiddleware(true, true, true);
};
