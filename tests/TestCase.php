<?php
namespace Apsg\MF\Tests;

use Apsg\MF\MF;
use Apsg\MF\MFServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected MF $mf;

    protected function setUp() : void
    {
        parent::setUp();

        $this->mf = new MF();
    }

    protected function getPackageProviders($app)
    {
        return [
            MFServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }
}
