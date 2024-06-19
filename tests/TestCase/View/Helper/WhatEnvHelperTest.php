<?php
declare(strict_types=1);

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\WhatEnvHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\WhatEnvHelper Test Case
 */
class WhatEnvHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\WhatEnvHelper
     */
    protected $WhatEnv;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->WhatEnv = new WhatEnvHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->WhatEnv);

        parent::tearDown();
    }
}
