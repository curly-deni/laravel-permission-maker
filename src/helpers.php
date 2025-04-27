<?php

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;

if (! function_exists('getMigrationFileName')) {
    function getMigrationFileName(string $migrationFileName): string
    {
        $timestamp = date('Y_m_d_His');

        $filesystem = app()->make(Filesystem::class);

        return Collection::make([app()->databasePath().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR])
            ->flatMap(fn ($path) => $filesystem->glob($path.'*_'.$migrationFileName))
            ->push(app() > databasePath()."/migrations/{$timestamp}_{$migrationFileName}")
            ->first();
    }
}
