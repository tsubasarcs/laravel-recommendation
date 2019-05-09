<?php

namespace Tsubasarcs\Recommendations\Tests;

use Tsubasarcs\Recommendations\CodeService;

class CodeServiceTest extends TestCase
{
    /**
     * @test
     * @group CodeService
     */
    public function it_should_generate_a_code()
    {
        $code = app(CodeService::class);
        $recommendations = $code->generate();

        $recommendation = array_first($recommendations);

        $this->assertCount(1, $recommendations);

        $this->assertArrayHasKey('type', $recommendation);
        $this->assertEquals(config('recommendation.default.type'), $recommendation['type']);

        $this->assertArrayHasKey('code', $recommendation);
        $expected_code = array_last(explode(config('recommendation.code_structure.symbol'), $recommendation['code']));
        $this->assertEquals(config('recommendation.default.length'), strlen($expected_code));
    }

    /**
     * @test
     * @group CodeService
     */
    public function it_should_generate_two_codes_by_times()
    {
        $code = app(CodeService::class);
        $recommendations = $code->generate(2);

        $this->assertCount(2, $recommendations);

        foreach ($recommendations as $recommendation) {
            $this->assertArrayHasKey('type', $recommendation);
            $this->assertEquals(config('recommendation.default.type'), $recommendation['type']);

            $this->assertArrayHasKey('code', $recommendation);
            $expected_code = array_last(explode(config('recommendation.code_structure.symbol'),
                $recommendation['code']));
            $this->assertEquals(config('recommendation.default.length'), strlen($expected_code));
        }
    }

    /**
     * @test
     * @group CodeService
     */
    public function it_should_generate_a_code_with_specified_type()
    {
        $code = app(CodeService::class);
        $recommendations = $code->type(2)->generate();

        $recommendation = array_first($recommendations);

        $this->assertCount(1, $recommendations);

        $this->assertArrayHasKey('type', $recommendation);
        $this->assertEquals(2, $recommendation['type']);

        $this->assertArrayHasKey('code', $recommendation);
        $expected_code = array_last(explode(config('recommendation.code_structure.symbol'), $recommendation['code']));
        $this->assertEquals(config('recommendation.default.length'), strlen($expected_code));
    }

    /**
     * @test
     * @group CodeService
     */
    public function it_should_generate_a_code_with_specified_length()
    {
        $code = app(CodeService::class);
        $recommendations = $code->length(15)->generate();

        $recommendation = array_first($recommendations);

        $this->assertCount(1, $recommendations);

        $this->assertArrayHasKey('type', $recommendation);
        $this->assertEquals(config('recommendation.default.type'), $recommendation['type']);

        $this->assertArrayHasKey('code', $recommendation);
        $expected_code = array_last(explode(config('recommendation.code_structure.symbol'), $recommendation['code']));
        $this->assertEquals(15, strlen($expected_code));
    }

    /**
     * @test
     * @group Code
     */
    public function it_should_generate_three_codes_with_specified_times()
    {
        $code = app(CodeService::class);
        $recommendations = $code->times(3)->generate();

        $this->assertCount(3, $recommendations);

        foreach ($recommendations as $recommendation) {
            $this->assertArrayHasKey('type', $recommendation);
            $this->assertEquals(config('recommendation.default.type'), $recommendation['type']);

            $this->assertArrayHasKey('code', $recommendation);
            $expected_code = array_last(explode(config('recommendation.code_structure.symbol'),
                $recommendation['code']));
            $this->assertEquals(config('recommendation.default.length'), strlen($expected_code));
        }
    }

    /**
     * @test
     * @group CodeService
     */
    public function it_should_generate_three_codes_with_type_is_2_and_code_length_is_15()
    {
        $code = app(CodeService::class);
        $recommendations = $code->type(2)->length(15)->times(3)->generate();

        $this->assertCount(3, $recommendations);

        foreach ($recommendations as $recommendation) {
            $this->assertArrayHasKey('type', $recommendation);
            $this->assertEquals(2, array_first($recommendations)['type']);

            $this->assertArrayHasKey('code', $recommendation);
            $expected_code = array_last(explode(config('recommendation.code_structure.symbol'),
                $recommendation['code']));
            $this->assertEquals(15, strlen($expected_code));
        }
    }

    /**
     * @test
     * @group CodeService
     */
    public function it_should_generate_onc_code_once()
    {
        $code = app(CodeService::class);
        $code1 = $code->generate();
        $code2 = $code->generate();

        $this->assertCount(1, $code1);
        $this->assertCount(1, $code2);
        $this->assertNotEquals($code1, $code2);
    }
}