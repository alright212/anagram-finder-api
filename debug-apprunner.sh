#!/bin/bash

# App Runner Debug Script
# This script helps investigate App Runner deployment issues

set -e

echo "🔍 App Runner Debug Helper"
echo "=========================="
echo ""

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Get service name from user
read -p "Enter your App Runner service name: " SERVICE_NAME

if [ -z "$SERVICE_NAME" ]; then
    echo -e "${RED}❌ Service name is required${NC}"
    exit 1
fi

echo ""
echo -e "${BLUE}📋 Service Information${NC}"
echo "Service: $SERVICE_NAME"
echo ""

# Function to run AWS CLI commands with error handling
run_aws_command() {
    local description="$1"
    local command="$2"
    
    echo -e "${YELLOW}🔄 $description...${NC}"
    
    if eval "$command"; then
        echo -e "${GREEN}✅ $description completed${NC}"
    else
        echo -e "${RED}❌ $description failed${NC}"
        echo "Command: $command"
    fi
    echo ""
}

# Check service status
run_aws_command "Getting service status" "aws apprunner describe-service --service-arn \$(aws apprunner list-services --query \"ServiceSummaryList[?ServiceName=='$SERVICE_NAME'].ServiceArn\" --output text)"

# Get recent application logs
echo -e "${YELLOW}📜 Recent Application Logs (last 50 lines)${NC}"
echo "----------------------------------------"
aws logs tail "/aws/apprunner/$SERVICE_NAME/application" --since 1h --follow=false | tail -50
echo ""

# Get recent service logs
echo -e "${YELLOW}⚙️  Recent Service Logs (last 50 lines)${NC}"
echo "--------------------------------------"
aws logs tail "/aws/apprunner/$SERVICE_NAME/service" --since 1h --follow=false | tail -50
echo ""

# Get operations history
echo -e "${YELLOW}📊 Recent Operations${NC}"
echo "-------------------"
aws apprunner list-operations --service-arn $(aws apprunner list-services --query "ServiceSummaryList[?ServiceName=='$SERVICE_NAME'].ServiceArn" --output text) --max-results 10
echo ""

# Check health check configuration
echo -e "${YELLOW}🏥 Health Check Configuration${NC}"
echo "-----------------------------"
aws apprunner describe-service --service-arn $(aws apprunner list-services --query "ServiceSummaryList[?ServiceName=='$SERVICE_NAME'].ServiceArn" --output text) --query 'Service.HealthCheckConfiguration'
echo ""

# Test DNS resolution
echo -e "${YELLOW}🌐 DNS Resolution Test${NC}"
echo "----------------------"
SERVICE_URL=$(aws apprunner describe-service --service-arn $(aws apprunner list-services --query "ServiceSummaryList[?ServiceName=='$SERVICE_NAME'].ServiceArn" --output text) --query 'Service.ServiceUrl' --output text)
echo "Service URL: $SERVICE_URL"

if [ ! -z "$SERVICE_URL" ]; then
    echo "Testing DNS resolution..."
    if nslookup "$SERVICE_URL" > /dev/null 2>&1; then
        echo -e "${GREEN}✅ DNS resolves successfully${NC}"
        
        echo "Testing HTTP connectivity..."
        if curl -f --max-time 10 "https://$SERVICE_URL/health" > /dev/null 2>&1; then
            echo -e "${GREEN}✅ Health endpoint responds successfully${NC}"
        else
            echo -e "${RED}❌ Health endpoint not responding${NC}"
            echo "Trying root endpoint..."
            if curl -I --max-time 10 "https://$SERVICE_URL/" > /dev/null 2>&1; then
                echo -e "${YELLOW}⚠️  Root endpoint responds but health endpoint doesn't${NC}"
            else
                echo -e "${RED}❌ Service not responding to HTTP requests${NC}"
            fi
        fi
    else
        echo -e "${RED}❌ DNS does not resolve${NC}"
    fi
else
    echo -e "${RED}❌ Could not retrieve service URL${NC}"
fi

echo ""
echo -e "${BLUE}🔧 Debugging Suggestions${NC}"
echo "========================"
echo ""
echo "1. Check application logs above for Laravel errors (database, config, etc.)"
echo "2. Look for health check failures in service logs"
echo "3. Verify that /health endpoint returns 200 OK with proper JSON"
echo "4. Ensure database migrations ran successfully during build"
echo "5. Check that APP_KEY is properly generated in production environment"
echo ""
echo -e "${YELLOW}💡 Quick Fixes to Try:${NC}"
echo "• Force a new deployment to trigger fresh build"
echo "• Check .env.production has all required variables"
echo "• Verify Dockerfile builds successfully locally"
echo "• Ensure health check path matches route definition"
