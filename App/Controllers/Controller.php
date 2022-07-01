<?php

namespace App\Controllers;

use App\Lib\Request;

class Controller
{

    protected array $params;

    public function notFound(): void
    {
        if (DEV_MODE) {
            $data = [
                'methodName' => __METHOD__,
                'lineNumber' => __LINE__
            ];
            view('errors.dev.methodNotFound', $data);
        } else {
            view('errors.usr.notFound');
        }
    }

    public function setParams(array $params): void
    {
        $this->params = $params;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function view($view, $data = []): void
    {
        view($view, $data);
    }
}
