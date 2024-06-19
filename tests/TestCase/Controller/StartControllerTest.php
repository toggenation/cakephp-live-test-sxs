<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\StartController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\StartController Test Case
 *
 * @uses \App\Controller\StartController
 */
class StartControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Start',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\StartController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
