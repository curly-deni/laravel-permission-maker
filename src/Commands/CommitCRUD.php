<?php

namespace Aesis\PermissionMaker\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CommitCRUD extends Command
{
    public $signature = 'permission:commit-crud
                        {resource : The name of the resource to create, prefer model name in snake_case}
                        {--private : add permission to view private}
                        {--own : add permission to view, update and delete own}';

    public $description = 'Create CRUD permissions for resource';

    public function handle(): int
    {
        $resource = $this->argument('resource');
        $private = $this->option('private');
        $own = $this->option('own');

        $migrationFileName = getMigrationFileName('commit_'.$resource.'_crud_permissions');

        $stub = File::get(__DIR__.'/../../database/migrations/crud_template.php.stub');

        $stub = str_replace(
            ['{{resource}}', '{{private}}', '{{own}}'],
            [$resource, $private, $own],
            $stub
        );

        File::put($migrationFileName, $stub);

        $this->info('Migration created successfully.');

        return self::SUCCESS;
    }
}
