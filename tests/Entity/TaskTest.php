<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Factory\TaskFactory;
use PHPUnit\Framework\TestCase;
use Zenstruck\Foundry\Test\Factories;

class TaskTest extends TestCase
{
    use Factories;

    public function test(): void
    {
        TaskFactory::createOne();
        TaskFactory::assert()->count(1);
    }
}
