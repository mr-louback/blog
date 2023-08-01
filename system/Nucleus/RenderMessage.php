<?php

namespace system\Nucleus;

class RenderMessage
{
    private $texto;
    private $css;
    public function flash(): void
    {
        (new Session())->sessionCreate('flash', $this);
    }
    public function messageLight(string $message)
    {
        $this->css = alert_light;
        $this->texto = $this->filter($message);
        return $this;
    }
    public function messageDark(string $message)
    {
        $this->css = alert_dark;
        $this->texto = $this->filter($message);
        return $this;
    }
    public function messagePrimary(string $message)
    {
        $this->css = alert_primary;
        $this->texto = $this->filter($message);
        return $this;
    }
    public function messageInfo(string $message)
    {
        $this->css = alert_info;
        $this->texto = $this->filter($message);
        return $this;
    }
    public function messageDanger(string $message)
    {
        $this->css = alert_danger;
        $this->texto = $this->filter($message);
        return $this;
    }
    public function messageWarning(string $message)
    {
        $this->css = alert_warning;
        $this->texto = $this->filter($message);
        return $this;
    }
    public function messageSuccess(string $message)
    {
        $this->css = alert_success;
        $this->texto = $this->filter($message);
        return $this;
    }
    public function __toString()
    {
        return $this->rendering();
    }
    /**
     * Reinderiza uma div
     * @return string 
     */
    public function rendering(): string
    {
        return "<div  class='{$this->css}' role='alert'>{$this->texto}</div>";
    }
    /**
     * Filtra string
     * @return string 
     */
    public function filter(string $message)
    {
        return filter_var($message, FILTER_SANITIZE_SPECIAL_CHARS);
    }
 
}
