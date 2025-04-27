<?php

namespace Aesis\PermissionMaker\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CommitPermission extends Command
{
    protected $signature = 'permission:commit
                            {name : The name of the permission (e.g., post:create)}';

    protected $description = 'Create a migration to commit a single permission.';

    public function handle(): int
    {
        $name = $this->argument('name');
        $migrationFileName = $this->generateMigrationFileName($name);

        $stub = $this->getStub();
        $content = str_replace('{{name}}', $name, $stub);

        File::put($migrationFileName, $content);

        $this->info('Migration for permission created successfully.');

        return self::SUCCESS;
    }

    protected function generateMigrationFileName(string $name): string
    {
        $slug = str_replace([':', '_'], '-', $name);

        return getMigrationFileName("commit_permission_{$slug}.php");
    }

    protected function getStub(): string
    {
        return File::get(__DIR__.'/../../database/migrations/permission_template.php.stub');
    }
}
