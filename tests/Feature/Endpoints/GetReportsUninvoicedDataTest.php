<?php

namespace Byte5\LaravelHarvest\Test\Feature\Endpoints;

use Byte5\LaravelHarvest\Test\TestCase;

class GetReportsUninvoicedDataTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->harvest = app()->make('harvest');
    }

    /** @test **/
    public function all_reports_can_be_received()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/reports/uninvoiced', $this->harvest->getRequestUrl());
        });

        $this->harvest->reportsUninvoiced->get();
    }

    /** @test **/
    public function a_report_can_be_received_by_from_and_to()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/reports/uninvoiced?from=1235-01-01&to=1235-01-31', $this->harvest->getRequestUrl());
        });

        $this->harvest->reportsUninvoiced
            ->from('1235-01-01')
            ->to('1235-01-31')
            ->get();
    }
}
