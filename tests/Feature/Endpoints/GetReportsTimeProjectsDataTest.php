<?php

namespace Byte5\LaravelHarvest\Test\Feature\Endpoints;

use Byte5\LaravelHarvest\Test\TestCase;

class GetReportsTimeProjectsDataTest extends TestCase
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
            $this->assertEquals('https://api.harvestapp.com/v2/reports/time/projects', $this->harvest->getRequestUrl());
        });

        $this->harvest->reportsTimeProjects->get();
    }

    /** @test **/
    public function a_report_can_be_received_by_from_and_to()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/reports/time/projects?from=1235-01-01&to=1235-01-31', $this->harvest->getRequestUrl());
        });

        $this->harvest->reportsTimeProjects
            ->from('1235-01-01')
            ->to('1235-01-31')
            ->get();
    }
}
