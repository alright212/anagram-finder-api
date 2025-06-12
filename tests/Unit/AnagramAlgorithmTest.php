<?php

namespace Tests\Unit;

use App\Services\AnagramAlgorithm\SortingAnagramAlgorithm;
use App\Services\AnagramAlgorithm\FrequencyMapAnagramAlgorithm;
use PHPUnit\Framework\TestCase;

class AnagramAlgorithmTest extends TestCase
{
    private SortingAnagramAlgorithm $sortingAlgorithm;
    private FrequencyMapAnagramAlgorithm $frequencyAlgorithm;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sortingAlgorithm = new SortingAnagramAlgorithm();
        $this->frequencyAlgorithm = new FrequencyMapAnagramAlgorithm();
    }

    /**
     * Test SortingAnagramAlgorithm with basic English words
     */
    public function test_sorting_algorithm_basic_words()
    {
        $canonical1 = $this->sortingAlgorithm->generateCanonical('listen');
        $canonical2 = $this->sortingAlgorithm->generateCanonical('silent');
        $canonical3 = $this->sortingAlgorithm->generateCanonical('enlist');

        $this->assertEquals($canonical1, $canonical2);
        $this->assertEquals($canonical1, $canonical3);
        $this->assertEquals('eilnst', $canonical1);
    }

    /**
     * Test SortingAnagramAlgorithm with Estonian characters
     */
    public function test_sorting_algorithm_estonian_characters()
    {
        $canonical1 = $this->sortingAlgorithm->generateCanonical('sõna');
        $canonical2 = $this->sortingAlgorithm->generateCanonical('naõs');

        $this->assertEquals($canonical1, $canonical2);
    }

    /**
     * Test case insensitivity
     */
    public function test_sorting_algorithm_case_insensitive()
    {
        $canonical1 = $this->sortingAlgorithm->generateCanonical('Listen');
        $canonical2 = $this->sortingAlgorithm->generateCanonical('SILENT');
        $canonical3 = $this->sortingAlgorithm->generateCanonical('enlist');

        $this->assertEquals($canonical1, $canonical2);
        $this->assertEquals($canonical1, $canonical3);
    }

    /**
     * Test FrequencyMapAnagramAlgorithm with basic words
     */
    public function test_frequency_algorithm_basic_words()
    {
        $canonical1 = $this->frequencyAlgorithm->generateCanonical('listen');
        $canonical2 = $this->frequencyAlgorithm->generateCanonical('silent');
        $canonical3 = $this->frequencyAlgorithm->generateCanonical('enlist');

        $this->assertEquals($canonical1, $canonical2);
        $this->assertEquals($canonical1, $canonical3);
    }

    /**
     * Test FrequencyMapAnagramAlgorithm with repeated characters
     */
    public function test_frequency_algorithm_repeated_characters()
    {
        $canonical1 = $this->frequencyAlgorithm->generateCanonical('aab');
        $canonical2 = $this->frequencyAlgorithm->generateCanonical('aba');
        $canonical3 = $this->frequencyAlgorithm->generateCanonical('baa');

        $this->assertEquals($canonical1, $canonical2);
        $this->assertEquals($canonical1, $canonical3);
        $this->assertEquals('a2b1', $canonical1);
    }

    /**
     * Test invalid UTF-8 input handling
     */
    public function test_invalid_utf8_input()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->sortingAlgorithm->generateCanonical("\xFF\xFE");
    }

    /**
     * Test empty string handling
     */
    public function test_empty_string()
    {
        $canonical1 = $this->sortingAlgorithm->generateCanonical('');
        $canonical2 = $this->frequencyAlgorithm->generateCanonical('');

        $this->assertEquals('', $canonical1);
        $this->assertEquals('', $canonical2);
    }

    /**
     * Test single character handling
     */
    public function test_single_character()
    {
        $canonical1 = $this->sortingAlgorithm->generateCanonical('a');
        $canonical2 = $this->frequencyAlgorithm->generateCanonical('a');

        $this->assertEquals('a', $canonical1);
        $this->assertEquals('a1', $canonical2);
    }
}
