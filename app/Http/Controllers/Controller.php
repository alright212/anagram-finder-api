<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     title="Anagram Finder API",
 *     version="1.0.0",
 *     description="API for finding anagrams and managing wordbase",
 *     @OA\Contact(
 *         email="glen.kink@gmail.com"
 *     )
 * )
 * @OA\Server(
 *     url="/",
 *     description="API Server"
 * )
 * @OA\Tag(
 *     name="Anagrams",
 *     description="Operations for finding anagrams"
 * )
 * @OA\Tag(
 *     name="Wordbase",
 *     description="Operations for managing the word database"
 * )
 * @OA\Tag(
 *     name="Advanced Wordbase",
 *     description="Advanced operations for managing the word database with Unicode optimization"
 * )
 * @OA\Tag(     
 *     name="Locale",
 *     description="Internationalization and locale management operations"
 * )
 */
abstract class Controller extends BaseController
{
    //
}
