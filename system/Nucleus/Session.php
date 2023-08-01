<?php

namespace system\Nucleus;

class Session
{
    public function __construct()
    {
        if (!session_id()) {
            session_start();
        }
    }
    public function sessionCreate(string $key, mixed $value): Session
    {
        $_SESSION[$key] = (is_array($value) ? (object) $value : $value);
        return $this;
    }
    public function sessionClear(string $key): Session
    {
        unset($_SESSION[$key]);
        return $this;
    }
    public function sessionLoad(): ?object
    {
        return (object) $_SESSION;
    }
    public function sessionCheck(string $key): bool
    {

        return isset($_SESSION[$key]);
    }
    public function sessionDelete(): Session
    {
        session_destroy();
        return $this;
    }
    public function __get($atribuit)
    {
        if (!empty($_SESSION[$atribuit])) {
            return $_SESSION[$atribuit];
        }
    }
    public function flash(): ?RenderMessage
    {
        if ($this->sessionCheck('flash')) {
            $flash = $this->flash;
            $this->sessionClear('flash');
            return $flash;
        }
        return null;
    }
}
