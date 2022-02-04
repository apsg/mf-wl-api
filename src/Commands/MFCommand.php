<?php

namespace Apsg\MF\Commands;

use Illuminate\Console\Command;

class MFCommand extends Command
{
    public $signature = 'mf-wl-api';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
