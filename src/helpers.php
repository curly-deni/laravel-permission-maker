<?php

if (! function_exists('getMigrationFileName')) {
    function getMigrationFileName(string $migrationFileName): string
    {
        $timestamp = date('Y_m_d_His');

        return database_path("migrations/{$timestamp}_{$migrationFileName}");
    }
}
