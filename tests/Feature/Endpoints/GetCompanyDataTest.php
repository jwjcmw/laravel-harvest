<?php

namespace Byte5\LaravelHarvest\Test\Feature\Endpoints;

use Byte5\LaravelHarvest\Test\TestCase;

class GetCompanyDataTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->harvest = app()->make('harvest');
    }

    /** @test **/
    public function a_user_can_receive_company_data()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/company', $this->harvest->getRequestUrl());
        });

        $this->harvest->company->get();
    }
}
