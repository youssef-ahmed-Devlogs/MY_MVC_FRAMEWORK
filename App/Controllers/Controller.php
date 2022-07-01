<?php

namespace App\Controllers;

use App\Lib\LayoutEngine;
use App\Lib\Request;

class Controller
{
    protected array $params;
    protected LayoutEngine $layoutEngine;

    public function setLayoutEngine(LayoutEngine $layoutEngine)
    {
        $this->layoutEngine = $layoutEngine;
    }

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
    /**
     * Render new view
     *
     * @param string $view
     * @param array $data
     * @return void
     */
    public function view(string $view, array $data = []): void
    {
        $view = str_replace(".", DS, $view);
        $view =  VIEWS_PATH . $view . '.view.php';

        $this->layoutEngine->render($view, $data);
    }
}
