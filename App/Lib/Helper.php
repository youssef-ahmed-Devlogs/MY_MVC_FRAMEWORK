<?php

namespace App\Lib;

trait Helper
{
    public function redirect(string $path)
    {
        session_write_close();
        header('Location: ' . $path);
        exit();
        return $this;
    }

    public function with(array $data)
    {
        session_start();

        foreach ($data as $key => $val) {
            $_SESSION[$key] = $val;
        }

        return $this;
    }
}
