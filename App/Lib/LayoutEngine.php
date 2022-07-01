<?php

namespace App\Lib;

class LayoutEngine
{
    private array $layoutConfig;

    public function __construct(array $layoutConfig)
    {
        $this->layoutConfig = $layoutConfig;
    }

    private function renderComponents(string $viewFilePath, array $data)
    {
        $components =  array_key_exists('components', $this->layoutConfig) ? $this->layoutConfig['components'] : [];

        if (empty($components)) {
            trigger_error('Please add app components in ' . CONFIG_PATH . ' layoutConfig.php' . ' File', E_USER_WARNING);
        }

        foreach ($components as $component) {
            if ($component === ":view") {
                extract($data);
                require_once $viewFilePath;
            } else {
                require_once $component;
            }
        }
    }

    public function render(string $viewFilePath, array $data)
    {
        $this->renderComponents($viewFilePath, $data);
    }
}
