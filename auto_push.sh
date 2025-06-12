#!/bin/bash

# Auto Push Script for Estonian Anagram Finder API
# This script automatically commits and pushes changes to the repository

REPO_ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
CURRENT_BRANCH=$(git -C "$REPO_ROOT" branch --show-current)

echo "🚀 Estonian Anagram Finder API - Auto Push Tool"
echo "=============================================="
echo "Current branch: $CURRENT_BRANCH"
echo ""

# Check if there are any changes to commit
if [[ -z $(git -C "$REPO_ROOT" status --porcelain) ]]; then
    echo "✅ No changes to commit"
    exit 0
fi

# Show the changes that will be committed
echo "📋 Changes to be committed:"
git -C "$REPO_ROOT" status --short
echo ""

# Prompt for commit message
read -p "Enter commit message: " COMMIT_MESSAGE

if [[ -z "$COMMIT_MESSAGE" ]]; then
    echo "❌ Commit message cannot be empty"
    exit 1
fi

# Commit the changes
git -C "$REPO_ROOT" add .
git -C "$REPO_ROOT" commit -m "$COMMIT_MESSAGE"

if [[ $? -ne 0 ]]; then
    echo "❌ Failed to commit changes"
    exit 1
fi

echo "✅ Changes committed successfully"

# Push to remote
echo "📤 Pushing to remote..."
git -C "$REPO_ROOT" push origin "$CURRENT_BRANCH"

if [[ $? -ne 0 ]]; then
    echo "❌ Failed to push changes"
    exit 1
fi

echo "🎉 Changes pushed successfully"
