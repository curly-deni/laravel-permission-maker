<?php

namespace Aesis\PermissionMaker;

use Aesis\PermissionMaker\Commands\CommitCRUD;
use Aesis\PermissionMaker\Commands\CommitPermission;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class PermissionMakerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-permission-maker')
            ->hasCommand(CommitCRUD::class)
            ->hasCommand(CommitPermission::class)
            ->hasConfigFile();
    }
}
