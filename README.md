
Sample application to demo issue with `dama/doctrine-test-bundle` when bootstrap is done in a PHPUnit extension.

```
Dropped database `app_test` for connection named default
Created database `app_test` for connection named default

In DatabaseRequired.php line 16:
                                                                                                      
  [Doctrine\DBAL\Exception\DatabaseRequired]                                                          
  A database is required for the method: Doctrine\DBAL\Schema\AbstractSchemaManager::listTableNames.  
                                                                                                      

Exception trace:
  at /vendor/doctrine/dbal/Exception/DatabaseRequired.php:16
 Doctrine\DBAL\Exception\DatabaseRequired::new() at /vendor/doctrine/dbal/Schema/AbstractSchemaManager.php:837
 Doctrine\DBAL\Schema\AbstractSchemaManager->getDatabase() at /vendor/doctrine/dbal/Schema/AbstractSchemaManager.php:164
 Doctrine\DBAL\Schema\AbstractSchemaManager->listTableNames() at /vendor/doctrine/dbal/Schema/AbstractSchemaManager.php:143
 Doctrine\DBAL\Schema\AbstractSchemaManager->tablesExist() at /vendor/doctrine/migrations/Metadata/Storage/TableMetadataStorage.php:215
 Doctrine\Migrations\Metadata\Storage\TableMetadataStorage->isInitialized() at /vendor/doctrine/migrations/Metadata/Storage/TableMetadataStorage.php:170
 Doctrine\Migrations\Metadata\Storage\TableMetadataStorage->ensureInitialized() at /vendor/doctrine/migrations/Tools/Console/Command/MigrateCommand.php:158
 Doctrine\Migrations\Tools\Console\Command\MigrateCommand->execute() at /vendor/symfony/console/Command/Command.php:279
 Symfony\Component\Console\Command\Command->run() at /vendor/symfony/console/Application.php:1047
 Symfony\Component\Console\Application->doRunCommand() at /vendor/symfony/framework-bundle/Console/Application.php:123
 Symfony\Bundle\FrameworkBundle\Console\Application->doRunCommand() at /vendor/symfony/console/Application.php:316
 Symfony\Component\Console\Application->doRun() at /vendor/symfony/framework-bundle/Console/Application.php:77
 Symfony\Bundle\FrameworkBundle\Console\Application->doRun() at /vendor/symfony/console/Application.php:167
 Symfony\Component\Console\Application->run() at /tests/Extension/DatabaseExtension.php:46
 App\Tests\Extension\DatabaseExtension->executeBeforeTest() at /vendor/phpunit/phpunit/Runner/Hook/TestListenerAdapter.php:44
 PHPUnit\Runner\TestListenerAdapter->startTest() at /vendor/phpunit/phpunit/Framework/TestResult.php:434
 PHPUnit\Framework\TestResult->startTest() at /vendor/phpunit/phpunit/Framework/TestResult.php:654
 PHPUnit\Framework\TestResult->run() at /vendor/phpunit/phpunit/Framework/TestCase.php:884
 PHPUnit\Framework\TestCase->run() at /vendor/phpunit/phpunit/Framework/TestSuite.php:677
 PHPUnit\Framework\TestSuite->run() at /vendor/phpunit/phpunit/Framework/TestSuite.php:677
 PHPUnit\Framework\TestSuite->run() at /vendor/phpunit/phpunit/Framework/TestSuite.php:677
 PHPUnit\Framework\TestSuite->run() at /vendor/phpunit/phpunit/TextUI/TestRunner.php:667
 PHPUnit\TextUI\TestRunner->run() at /vendor/phpunit/phpunit/TextUI/Command.php:142
 PHPUnit\TextUI\Command->run() at /vendor/phpunit/phpunit/TextUI/Command.php:95
 PHPUnit\TextUI\Command::main() at /vendor/phpunit/phpunit/phpunit:61
 include() at /vendor/bin/phpunit:122

doctrine:migrations:migrate [--write-sql [WRITE-SQL]] [--dry-run] [--query-time] [--allow-no-migration] [--all-or-nothing [ALL-OR-NOTHING]] [--no-all-or-nothing] [--configuration CONFIGURATION] [--em EM] [--conn CONN] [--] [<version>]
```
