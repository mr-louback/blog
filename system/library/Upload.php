<?php

namespace system\library;

class Upload
{
    private ?string $subDirectory;
    private ?array $file;
    private ?string $name;
    private ?string $directory;
    private ?string $result = null;
    private ?string $error;
    private ?int $length;
    public function getResult(): ?string
    {
        return $this->result;
    }
    public function getError(): ?string
    {
        return $this->error;
    }
    public function __construct(?string $directory = null)
    {
        $this->directory =  !is_null($directory) ?? "uploads" ;
        if (!file_exists($this->directory) and !is_dir($this->directory)) {
            mkdir($directory, 0755);
        }
    }
    public function file(array $file, ?string $name = null, ?string $subDirectory = null, ?int $length = null)
    {
        $this->name = !is_null($name) ?? pathinfo($name, PATHINFO_FILENAME);
        $this->file = $file;
        $this->subDirectory = $subDirectory ?? $this->name;
        $nameExtension = pathinfo($name, PATHINFO_EXTENSION);
        $extensionValidated = ['.pdf', 'jpeg', 'png'];
        $typesValidated = ['application/pdf', 'image/png', 'image/jpeg', 'text/plain'];
        $this->length = $length ?? 1;

        if (!in_array($nameExtension, $extensionValidated)) {
            $this->error =  'As extensões permitidas são ' . implode('.', $extensionValidated);
        } elseif (!in_array($this->file['type'], $typesValidated)) {
            $this->error = 'Tipo não permitido!';
        } elseif ($this->file['size'] > $this->length * (1024 * 1024)) {
            $this->error = 'Tamanho' . $this->length . 'MB não permitido!';
        } else {
            $this->directoryCreate();
            $this->renameFile();
            $this->moveFile();
        }
    }
    private function directoryCreate(): void
    {
        if (!file_exists($this->directory . DIRECTORY_SEPARATOR . $this->subDirectory)  and !is_dir($this->directory . DIRECTORY_SEPARATOR . $this->subDirectory)) {
            mkdir($this->directory . DIRECTORY_SEPARATOR . $this->subDirectory);
        }
    }
    private function moveFile()
    {
        if (move_uploaded_file($this->file['tmp_name'], $this->directory . DIRECTORY_SEPARATOR . $this->subDirectory . DIRECTORY_SEPARATOR . $this->name)) {
            $this->result = $this->name;
        } else {
            $this->result = null;
        }
    }
    private function renameFile()
    {
        $file = $this->name;
        if (file_exists($this->directory . DIRECTORY_SEPARATOR . $this->subDirectory . DIRECTORY_SEPARATOR . $this->name)) {
            $file = uniqid() . '-' .  $file;
        }
        $this->name = uniqid() . '-' . $file;
    }
}
