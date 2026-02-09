<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRepositoryCommand extends Command
{
    protected $signature = 'make:repository {name}';
    protected $description = 'Create a repository with interface and bind in AppServiceProvider';

    public function handle()
    {
        $name = $this->argument('name');
        $interfaceName = "I{$name}Repository";
        $repositoryName = "{$name}Repository";

        $this->createInterface($interfaceName);
        $this->createRepository($repositoryName, $interfaceName);
        $this->bindInServiceProvider($interfaceName, $repositoryName);

        $this->info("Repository created successfully!");
    }

    private function createInterface($name)
    {
        $path = app_path("Repositories/Interfaces/{$name}.php");
        File::ensureDirectoryExists(dirname($path));

        $content = "<?php\n\nnamespace App\Repositories\Interfaces;\n\ninterface {$name}\n{\n    //\n}\n";
        File::put($path, $content);
        $this->info("Interface created: {$path}");
    }

    private function createRepository($name, $interface)
    {
        $path = app_path("Repositories/{$name}.php");
        File::ensureDirectoryExists(dirname($path));

        $content = "<?php\n\nnamespace App\Repositories;\n\nuse App\Repositories\Interfaces\\{$interface};\n\nclass {$name} implements {$interface}\n{\n    //\n}\n";
        File::put($path, $content);
        $this->info("Repository created: {$path}");
    }

    private function bindInServiceProvider($interface, $repository)
    {
        $providerPath = app_path('Providers/AppServiceProvider.php');
        $content = File::get($providerPath);

        $binding = "\$this->app->bind(\App\Repositories\Interfaces\\{$interface}::class, \App\Repositories\\{$repository}::class);";

        if (strpos($content, $binding) !== false) {
            $this->warn("Binding already exists in AppServiceProvider");
            return;
        }

        $content = preg_replace(
            '/(public function register\(\): void\s*\{)/',
            "$1\n        {$binding}",
            $content
        );

        File::put($providerPath, $content);
        $this->info("Binding added to AppServiceProvider");
    }
}
