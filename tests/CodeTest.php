<?php

namespace Tsubasarcs\Recommendations\Tests;

use Tsubasarcs\Recommendations\Facades\Code;

class CodeTest extends TestCase
{
    /**
     * @test
     * @group Code
     */
    public function it_should_generate_a_code()
    {
        $recommendations = Code::generate();

        $this->assertCount(1, $recommendations);
        $this->assertArrayHasKey('type', array_first($recommendations));
        $this->assertEquals(1, array_first($recommendations)['type']);
        $this->assertArrayHasKey('code', array_first($recommendations));
        $this->assertEquals(10, strlen(array_first($recommendations)['code']));
    }

    /**
     * @test
     * @group Code
     */
    public function it_should_generate_two_codes_by_times()
    {
        $recommendations = Code::generate(2);

        $this->assertCount(2, $recommendations);
        foreach ($recommendations as $recommendation) {
            $this->assertArrayHasKey('type', $recommendation);
            $this->assertArrayHasKey('code', $recommendation);
        }
    }

    /**
     * @test
     * @group Code
     */
    public function it_should_generate_a_code_with_specified_type()
    {
        $recommendations = Code::type(2)->generate();

        $this->assertCount(1, $recommendations);
        $this->assertArrayHasKey('type', array_first($recommendations));
        $this->assertEquals(2, array_first($recommendations)['type']);
        $this->assertArrayHasKey('code', array_first($recommendations));
    }

    /**
     * @test
     * @group Code
     */
    public function it_should_generate_a_code_with_specified_length()
    {
        $recommendations = Code::length(15)->generate();

        $this->assertCount(1, $recommendations);
        $this->assertArrayHasKey('code', array_first($recommendations));
        $this->assertEquals(15, strlen(array_first($recommendations)['code']));
        $this->assertArrayHasKey('type', array_first($recommendations));
    }

    /**
     * @test
     * @group Code
     */
    public function it_should_generate_three_codes_with_specified_times()
    {
        $recommendations = Code::times(3)->generate();

        $this->assertCount(3, $recommendations);
        foreach ($recommendations as $recommendation) {
            $this->assertArrayHasKey('type', $recommendation);
            $this->assertArrayHasKey('code', $recommendation);
        }
    }

    /**
     * @test
     * @group Code
     */
    public function it_should_generate_three_codes_with_type_is_2_and_code_code_length_is_15()
    {
        $recommendations = Code::type(2)->length(15)->times(3)->generate();

        $this->assertCount(3, $recommendations);
        foreach ($recommendations as $recommendation) {
            $this->assertArrayHasKey('type', $recommendation);
            $this->assertEquals(2, array_first($recommendations)['type']);
            $this->assertArrayHasKey('code', $recommendation);
            $this->assertEquals(15, strlen(array_first($recommendations)['code']));
        }
    }
}