<?php
namespace Apsg\MF\Tests;

use Apsg\MF\MF;
use Apsg\MF\MFServiceProvider;
use GuzzleHttp\Client;
use Orchestra\Testbench\TestCase as Orchestra;

/**
 * @see https://www.gov.pl/web/kas/api-wykazu-podatnikow-vat
 * @see https://www.gov.pl/attachment/5e7f6a61-d6de-4841-891b-ef8122353445
 */
class TestCase extends Orchestra
{
    public const TEST_NIP = '8655104670';
    public const TEST_REGON = '79156739856513';
    public const TEST_BANK_ACCOUNT = '70506405335016096312945164';

    protected MF $mf;

    protected function setUp() : void
    {
        parent::setUp();

        $this->mf = new MF(new Client(), 'https://wl-test.mf.gov.pl/api/');
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
