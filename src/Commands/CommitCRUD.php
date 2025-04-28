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
        $private = (string) (int) $this->option('private');
        $own = (string) (int) $this->option('own');

        $migrationFileName = getMigrationFileName(
            'commit_'.
            $resource.
            '_crud_permissions'.
            ($private ? '_with_private' : '').
            ($own ? '_with_own' : '').
            '.php'
        );

        $stub = File::get(
            __DIR__.'/../../database/migrations/crud_template.php.stub'
        );

        $stub = str_replace(
            [
                '{{resource}}',
                '{{private}}',
                '{{own}}',
                '{{create}}',
                '{{update}}',
                '{{delete}}',
                '{{read}}',
            ],
            [
                $resource,
                $private,
                $own,
                (string) (int) config('permission-maker.create.generate', true),
                (string) (int) config('permission-maker.update.generate', true),
                (string) (int) config('permission-maker.delete.generate', true),
                (string) (int) config('permission-maker.read.generate', false),
            ],
            $stub
        );

        File::put($migrationFileName, $stub);

        $this->info('Migration created successfully.');

        return self::SUCCESS;
    }
}
