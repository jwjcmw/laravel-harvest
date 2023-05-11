<?php

namespace Byte5\LaravelHarvest\Test\Feature\Transformer;

use Byte5\LaravelHarvest\ApiResponse;
use Byte5\LaravelHarvest\Models\Invoice;
use Byte5\LaravelHarvest\Models\Reports\Uninvoiced\Result;
use Byte5\LaravelHarvest\Test\Fakes\FakeApiResponse;
use Byte5\LaravelHarvest\Test\TestCase;
use Illuminate\Support\Collection;

class TransformReportsUninvoicedTest extends TestCase
{
    /** @test **/
    public function it_can_transform_reports_api_responses_into_their_corresponding_models()
    {
        $apiResult = new FakeApiResponse($this->getFakeData());

        $collection = (new ApiResponse($apiResult, Result::class))->toCollection();

        $this->assertTrue($collection instanceof Collection);
        $this->assertSame(2, $collection->count());
        $this->assertTrue($collection->first() instanceof Result);
    }

    /**
     * @return array
     */
    private function getFakeData()
    {
        return [
            'results' => [
                [

                ],
                [

                ],
            ],
            'per_page' => 100,
            'total_pages' => 1,
            'total_entries' => 2,
            'next_page' => null,
            'previous_page' => null,
            'page' => 1,
            'links' => [
                'first' => 'https://api.harvestapp.com/v2/invoices?page=1&per_page=100',
                'next' => null,
                'previous' => null,
                'last' => 'https://api.harvestapp.com/v2/invoices?page=1&per_page=100',
            ],
        ];
    }
}
