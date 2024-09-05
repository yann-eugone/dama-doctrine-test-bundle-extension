<?php

declare(strict_types=1);

namespace App\Tests\Extension;

use App\Kernel;
use PHPUnit\Framework\TestCase;
use PHPUnit\Runner\BeforeTestHook;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Zenstruck\Foundry\Test\Factories;

final class DatabaseExtension implements BeforeTestHook
{
    private bool $initialized = false;

    public function executeBeforeTest(string $test): void
    {
        if ($this->initialized) {
            return;
        }
        if (!$this->requiresDatabase($test)) {
            return;
        }

        $kernel = new Kernel($_ENV['APP_ENV'], (bool)$_ENV['APP_DEBUG']);
        $kernel->boot();

        $application = new Application($kernel);
        $application->setAutoExit(false);

        $output = new BufferedOutput();

        foreach (
            [
                ['command' => 'doctrine:database:drop', '--if-exists' => true, '--force' => true],
                ['command' => 'doctrine:database:create'],
                ['command' => 'doctrine:migrations:migrate', '--no-all-or-nothing' => true],
            ] as $input
        ) {
            $result = $application->run(
                new ArrayInput(['--no-interaction' => true, '--verbose' => true, ...$input]),
                $output,
            );
            if ($result !== Command::SUCCESS) {
                throw new \RuntimeException($output->fetch());
            }
        }

        $kernel->shutdown();

        $this->initialized = true;
    }

    private function requiresDatabase(string $test): bool
    {
        if (!\str_contains($test, '::')) {
            return false;
        }

        $className = \explode('::', $test)[0];
        if (!\is_a($className, TestCase::class, true)) {
            return false;
        }

        do {
            $traits = \class_uses($className) ?: [];
            if (isset($traits[Factories::class])) {
                return true;
            }
        } while ($className = \get_parent_class($className));

        return false;
    }
}
