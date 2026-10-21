<?php

class Controller
{
    protected function model(string $model)
    {
        require_once __DIR__ . '/../models/' . $model . '.php';
        return new $model();
    }

    protected function view(string $view, array $data = []): void
    {
        extract($data);
        require __DIR__ . '/../views/' . $view . '.php';
    }

    protected function redirect(string $url): never
    {
        header('Location: ' . BASE_URL . '/' . ltrim($url, '/'));
        exit;
    }
}
