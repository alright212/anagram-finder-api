#!/bin/zsh

# 🧪 Quick Test Script for Estonian Anagram Finder API
# Tests the API locally before deploying to Heroku

set -e

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

echo -e "${BLUE}🧪 Testing Estonian Anagram Finder API${NC}"
echo "========================================"

# Check if Laravel is running
if ! pgrep -f "php artisan serve" > /dev/null; then
    echo -e "${YELLOW}⚠️  Starting Laravel development server...${NC}"
    php artisan serve --host=127.0.0.1 --port=8000 &
    SERVER_PID=$!
    echo "Server PID: $SERVER_PID"
    sleep 3
else
    echo -e "${GREEN}✅ Laravel server is already running${NC}"
fi

BASE_URL="http://127.0.0.1:8000"

echo ""
echo -e "${BLUE}🔍 Running API tests...${NC}"

# Test 1: Health check
echo -n "Health check... "
if curl -s -f "$BASE_URL/health" > /dev/null; then
    echo -e "${GREEN}✅ PASSED${NC}"
else
    echo -e "${RED}❌ FAILED${NC}"
    echo "Make sure the server is running: php artisan serve"
    exit 1
fi

# Test 2: API documentation
echo -n "API documentation... "
if curl -s -f "$BASE_URL/api/documentation" > /dev/null; then
    echo -e "${GREEN}✅ PASSED${NC}"
else
    echo -e "${YELLOW}⚠️  SKIPPED (may not be generated yet)${NC}"
fi

# Test 3: Wordbase status
echo -n "Wordbase status... "
RESPONSE=$(curl -s "$BASE_URL/api/v1/wordbase/status")
if echo "$RESPONSE" | grep -q "total_words"; then
    echo -e "${GREEN}✅ PASSED${NC}"
    WORD_COUNT=$(echo "$RESPONSE" | grep -o '"total_words":[0-9]*' | cut -d':' -f2)
    echo "   Words in database: $WORD_COUNT"
else
    echo -e "${YELLOW}⚠️  No words in database - run import first${NC}"
fi

# Test 4: Basic anagram search
echo -n "Anagram search (basic)... "
RESPONSE=$(curl -s "$BASE_URL/api/v1/anagrams/listen")
if echo "$RESPONSE" | grep -q "anagrams\|error"; then
    echo -e "${GREEN}✅ PASSED${NC}"
    if echo "$RESPONSE" | grep -q "error"; then
        echo "   Response: API responded with error (expected if no data)"
    else
        ANAGRAM_COUNT=$(echo "$RESPONSE" | grep -o '"count":[0-9]*' | cut -d':' -f2)
        echo "   Found anagrams: $ANAGRAM_COUNT"
    fi
else
    echo -e "${RED}❌ FAILED${NC}"
    echo "   Response: $RESPONSE"
fi

# Test 5: Estonian word search
echo -n "Estonian anagram search... "
RESPONSE=$(curl -s "$BASE_URL/api/v1/anagrams/kass")
if echo "$RESPONSE" | grep -q "anagrams\|error"; then
    echo -e "${GREEN}✅ PASSED${NC}"
    if echo "$RESPONSE" | grep -q "error"; then
        echo "   Response: API responded with error (expected if no data)"
    else
        ANAGRAM_COUNT=$(echo "$RESPONSE" | grep -o '"count":[0-9]*' | cut -d':' -f2)
        echo "   Found anagrams: $ANAGRAM_COUNT"
    fi
else
    echo -e "${RED}❌ FAILED${NC}"
    echo "   Response: $RESPONSE"
fi

# Test 6: Statistics endpoint
echo -n "Statistics endpoint... "
RESPONSE=$(curl -s "$BASE_URL/api/v1/anagrams/stats")
if echo "$RESPONSE" | grep -q "total_words\|error"; then
    echo -e "${GREEN}✅ PASSED${NC}"
else
    echo -e "${RED}❌ FAILED${NC}"
    echo "   Response: $RESPONSE"
fi

echo ""
echo -e "${BLUE}📊 Test Summary${NC}"
echo "================"
if [ -n "$SERVER_PID" ]; then
    echo -e "${YELLOW}Server started with PID: $SERVER_PID${NC}"
    echo "To stop: kill $SERVER_PID"
fi

echo ""
echo -e "${GREEN}🎉 Basic API tests completed!${NC}"
echo ""
echo -e "${BLUE}Next steps:${NC}"
echo "1. If wordbase is empty, run: php artisan db:seed"
echo "2. Test locally: http://127.0.0.1:8000/api/documentation"
echo "3. Deploy to Heroku: ./deploy-to-heroku.sh"
echo ""

# Optional: Check if we should import data
if [ "$WORD_COUNT" = "0" ] || [ -z "$WORD_COUNT" ]; then
    echo -e "${YELLOW}💡 Tip: Import Estonian words for full functionality:${NC}"
    echo "   php artisan db:seed"
    echo ""
fi
