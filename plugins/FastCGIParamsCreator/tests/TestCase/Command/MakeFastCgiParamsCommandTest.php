<?php
declare(strict_types=1);

namespace FastCGIParamsCreator\Test\TestCase\Command;

use Cake\Console\TestSuite\ConsoleIntegrationTestTrait;
use Cake\TestSuite\TestCase;
use FastCGIParamsCreator\Command\MakeFastCgiParamsCommand;

/**
 * FastCGIParamsCreator\Command\MakeFastCgiParamsCommand Test Case
 *
 * @uses \FastCGIParamsCreator\Command\MakeFastCgiParamsCommand
 */
class MakeFastCgiParamsCommandTest extends TestCase
{
    use ConsoleIntegrationTestTrait;

    /**
     * Test buildOptionParser method
     *
     * @return void
     * @uses \FastCGIParamsCreator\Command\MakeFastCgiParamsCommand::buildOptionParser()
     */
    public function testBuildOptionParser(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test execute method
     *
     * @return void
     * @uses \FastCGIParamsCreator\Command\MakeFastCgiParamsCommand::execute()
     */
    public function testExecute(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
