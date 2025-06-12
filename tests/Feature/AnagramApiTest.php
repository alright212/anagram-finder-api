<?php

namespace Tests\Feature;

use App\Models\Word;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class AnagramApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test wordbase status endpoint when empty
     */
    public function test_wordbase_status_empty()
    {
        $response = $this->getJson('/api/v1/wordbase/status');

        $response->assertStatus(200)
                ->assertJson([
                    'data' => [
                        'wordbase_exists' => false,
                        'word_count' => 0,
                    ]
                ]);
    }

    /**
     * Test wordbase status endpoint when populated
     */
    public function test_wordbase_status_populated()
    {
        // Create some test words
        Word::create(['original_word' => 'listen', 'canonical_form' => 'eilnst', 'length' => 6]);
        Word::create(['original_word' => 'silent', 'canonical_form' => 'eilnst', 'length' => 6]);

        $response = $this->getJson('/api/v1/wordbase/status');

        $response->assertStatus(200)
                ->assertJson([
                    'data' => [
                        'wordbase_exists' => true,
                        'word_count' => 2,
                    ]
                ]);
    }

    /**
     * Test anagram search with populated wordbase
     */
    public function test_anagram_search_success()
    {
        // Create test words
        Word::create(['original_word' => 'listen', 'canonical_form' => 'eilnst', 'length' => 6]);
        Word::create(['original_word' => 'silent', 'canonical_form' => 'eilnst', 'length' => 6]);
        Word::create(['original_word' => 'enlist', 'canonical_form' => 'eilnst', 'length' => 6]);
        Word::create(['original_word' => 'hello', 'canonical_form' => 'ehllo', 'length' => 5]);

        $response = $this->getJson('/api/v1/anagrams/listen');

        $response->assertStatus(200)
                ->assertJson([
                    'data' => [
                        'original_word' => 'listen',
                        'count' => 2,
                    ]
                ])
                ->assertJsonPath('data.anagrams', function ($anagrams) {
                    return in_array('silent', $anagrams) && in_array('enlist', $anagrams) && count($anagrams) === 2;
                });
    }

    /**
     * Test anagram search with no results
     */
    public function test_anagram_search_no_results()
    {
        Word::create(['original_word' => 'hello', 'canonical_form' => 'ehllo', 'length' => 5]);

        $response = $this->getJson('/api/v1/anagrams/world');

        $response->assertStatus(200)
                ->assertJson([
                    'data' => [
                        'original_word' => 'world',
                        'anagrams' => [],
                        'count' => 0,
                    ]
                ]);
    }

    /**
     * Test anagram search with empty wordbase
     */
    public function test_anagram_search_empty_wordbase()
    {
        $response = $this->getJson('/api/v1/anagrams/test');

        $response->assertStatus(503)
                ->assertJson([
                    'error' => [
                        'message' => 'Wordbase not available. Please import wordbase first.',
                        'code' => 'WORDBASE_NOT_READY'
                    ]
                ]);
    }

    /**
     * Test anagram search with invalid input
     */
    public function test_anagram_search_invalid_input()
    {
        Word::create(['original_word' => 'test', 'canonical_form' => 'estt', 'length' => 4]);

        $response = $this->getJson('/api/v1/anagrams/');

        $response->assertStatus(404); // Route not found for empty parameter
    }

    /**
     * Test anagram search with very long word
     */
    public function test_anagram_search_word_too_long()
    {
        Word::create(['original_word' => 'test', 'canonical_form' => 'estt', 'length' => 4]);

        $longWord = str_repeat('a', 101);
        $response = $this->getJson('/api/v1/anagrams/' . $longWord);

        $response->assertStatus(400)
                ->assertJson([
                    'error' => [
                        'message' => 'Word too long. Maximum length is 100 characters.',
                        'code' => 'WORD_TOO_LONG'
                    ]
                ]);
    }

    /**
     * Test anagram stats endpoint
     */
    public function test_anagram_stats()
    {
        Word::create(['original_word' => 'listen', 'canonical_form' => 'eilnst', 'length' => 6]);
        Word::create(['original_word' => 'silent', 'canonical_form' => 'eilnst', 'length' => 6]);

        $response = $this->getJson('/api/v1/anagrams/stats');

        $response->assertStatus(200)
                ->assertJson([
                    'data' => [
                        'total_words' => 2,
                    ]
                ])
                ->assertJsonMissing([
                    'data' => [
                        'is_empty' => true,
                    ]
                ]);
    }

    /**
     * Test wordbase import with already existing data
     */
    public function test_wordbase_import_already_exists()
    {
        Word::create(['original_word' => 'test', 'canonical_form' => 'estt', 'length' => 4]);

        $response = $this->postJson('/api/v1/wordbase/import');

        $response->assertStatus(409)
                ->assertJson([
                    'error' => [
                        'code' => 'WORDBASE_EXISTS'
                    ]
                ]);
    }
}
