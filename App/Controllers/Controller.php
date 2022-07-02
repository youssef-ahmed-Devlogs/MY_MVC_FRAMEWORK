<?php

namespace App\Controllers;

use App\Lib\LanguageEngine;
use App\Lib\LayoutEngine;
use App\Lib\Request;

class Controller
{
    protected string $controller;
    protected string $method;
    protected array $params;
    protected LayoutEngine $layoutEngine;
    protected LanguageEngine $languageEngine;
    protected array $dictionary = [];

    public function setLayoutEngine(LayoutEngine $layoutEngine)
    {
        $this->layoutEngine = $layoutEngine;
    }

    public function setLanguageEngine(LanguageEngine $languageEngine)
    {
        $this->languageEngine = $languageEngine;
    }

    public function methodNotExist(): void
    {
        devError('This method is not exist.', '/index/notFound');
    }

    public function notFound(): void
    {
        $this->view('errors.notFound');
    }

    public function setController(string $controller): void
    {
        $this->controller = $controller;
    }

    public function setMethod(string $method): void
    {
        $this->method = $method;
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
        $this->languageEngine->load('global.global');
        $this->languageEngine->load($this->controller . '.' . $this->method);
        $this->setDictionary($this->languageEngine->getDictionary());

        $view = str_replace(".", DS, $view);
        $view =  VIEWS_PATH . $view . '.view.php';

        $data = array_merge($data, $this->dictionary);


        $this->layoutEngine->render($view, $data);
    }

    public function setDictionary($dictionary)
    {
        $this->dictionary = $dictionary;
    }
}
