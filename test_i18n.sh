#!/bin/bash

# Test script for i18n functionality
echo "🌐 Testing Anagram Finder API i18n System"
echo "========================================="

BASE_URL="http://127.0.0.1:8000/api/v1"

# Test 1: Default locale (English)
echo
echo "📍 Test 1: Default locale (English)"
curl -s -H "Accept: application/json" "$BASE_URL/locale/info" | jq '.'

# Test 2: Estonian locale via Accept-Language header
echo
echo "📍 Test 2: Estonian locale via Accept-Language header"
curl -s -H "Accept-Language: et-EE,et;q=0.9,en;q=0.8" -H "Accept: application/json" "$BASE_URL/locale/info" | jq '.'

# Test 3: German locale via X-Locale header
echo
echo "📍 Test 3: German locale via X-Locale header"
curl -s -H "X-Locale: de" -H "Accept: application/json" "$BASE_URL/locale/info" | jq '.'

# Test 4: French locale via query parameter
echo
echo "📍 Test 4: French locale via query parameter"
curl -s -H "Accept: application/json" "$BASE_URL/locale/info?lang=fr" | jq '.'

# Test 5: Get API translations for Estonian
echo
echo "📍 Test 5: API translations for Estonian"
curl -s -H "Accept-Language: et" -H "Accept: application/json" "$BASE_URL/locale/translations/api" | jq '.data.translations.welcome'

# Test 6: Anagram search with Estonian locale
echo
echo "📍 Test 6: Anagram search with Estonian locale"
curl -s -H "Accept-Language: et" -H "Accept: application/json" "$BASE_URL/anagrams/test" | jq '.'

# Test 7: Wordbase status with German locale
echo
echo "📍 Test 7: Wordbase status with German locale"
curl -s -H "X-Locale: de" -H "Accept: application/json" "$BASE_URL/wordbase/status" | jq '.'

echo
echo "✅ i18n Testing Complete!"
echo "Check the response headers for Content-Language and X-API-Locale"
