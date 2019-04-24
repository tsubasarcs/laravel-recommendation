<?php

namespace Tsubasarcs\Recommendations\Tests;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tsubasarcs\Recommendations\Recommendation;

class RecommendationTest extends TestCase
{
    /**
     * @test
     * @group Recommendation
     */
    public function it_should_has_relationship_belongsTo_class()
    {
        $recommendation = new Recommendation();

        $this->assertInstanceOf(BelongsTo::class, $recommendation->user());
    }
}