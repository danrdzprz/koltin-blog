<?php

namespace Tests\Unit;

use Tests\TestCase;

class CommandExportCommentsTest extends TestCase
{
    /**
     * Test command export:comments.
     */
    public function testConsoleCommand(): void
    {
        $spreadsheet_id = config('google.config.spreadsheet_id');

        $this->artisan('export:comments')
            ->expectsQuestion('start date (Y-m-d)?', '2023-11-01')
            ->expectsQuestion('end date (Y-m-d)?', '2023-11-06')
            ->expectsOutputToContain('Comments exported to ')
            ->doesntExpectOutputToContain('Comments not exported. See error messages below:')
            ->assertExitCode(0);
    }
}
