<?php

namespace Byte5\LaravelHarvest\Test\Feature\Transformer;

use Byte5\LaravelHarvest\ApiResponse;
use Byte5\LaravelHarvest\Models\Reports\Time\Team\Result;
use Byte5\LaravelHarvest\Test\Fakes\FakeApiResponse;
use Byte5\LaravelHarvest\Test\TestCase;
use Illuminate\Support\Collection;

class TransformReportsTimeTeamTest extends TestCase
{
    /** @test **/
    public function it_can_transform_reports_api_responses_into_their_corresponding_models()
    {
        $json = $this->getFakeData();
        $apiResult = new FakeApiResponse($json);

        $collection = (new ApiResponse($apiResult, Result::class))->toCollection();

        $this->assertTrue($collection instanceof Collection);
        $this->assertSame(2, $collection->count());
        $this->assertTrue($collection->first() instanceof Result);

        $this->assertSame($json['results'][0]['user_id'], $collection->first()->external_user_id);
        $this->assertSame($json['results'][1]['user_id'], $collection->get(1)->external_user_id);
    }

    /**
     * @return array
     */
    private function getFakeData()
    {
        return [
            'results' => [
                [
                    'user_id' => 123
                ],
                [
                    'user_id' => 321
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
