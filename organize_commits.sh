#!/bin/bash

# Commit Organization Script for Estonian Anagram Finder API
# This script helps organize commits for a clean git history

REPO_ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
CURRENT_BRANCH=$(git -C "$REPO_ROOT" branch --show-current)

echo "📋 Estonian Anagram Finder API - Commit Organization Tool"
echo "========================================================"
echo "Current branch: $CURRENT_BRANCH"
echo ""

# List the last 10 commits
echo "Recent commits:"
git -C "$REPO_ROOT" log --oneline -10
echo ""

# Options
echo "Options:"
echo "1. Squash commits"
echo "2. Rebase onto main"
echo "3. Reorder commits"
echo "4. Edit commit messages"
echo "5. Exit"
echo ""

read -p "Choose an option (1-5): " OPTION

case $OPTION in
    1)
        # Squash commits
        read -p "How many commits to squash? " COMMIT_COUNT
        read -p "New commit message: " COMMIT_MESSAGE
        
        git -C "$REPO_ROOT" reset --soft HEAD~$COMMIT_COUNT
        git -C "$REPO_ROOT" commit -m "$COMMIT_MESSAGE"
        
        echo "✅ Squashed $COMMIT_COUNT commits"
        ;;
    2)
        # Rebase onto main
        git -C "$REPO_ROOT" fetch origin
        git -C "$REPO_ROOT" rebase origin/main
        
        echo "✅ Rebased onto main"
        ;;
    3)
        # Reorder commits
        echo "Starting interactive rebase. You'll need to manually reorder commits."
        read -p "How many commits to reorder? " COMMIT_COUNT
        
        git -C "$REPO_ROOT" rebase -i HEAD~$COMMIT_COUNT
        ;;
    4)
        # Edit commit messages
        echo "Starting interactive rebase to edit messages."
        read -p "How many commits to edit? " COMMIT_COUNT
        
        git -C "$REPO_ROOT" rebase -i HEAD~$COMMIT_COUNT
        ;;
    5)
        # Exit
        echo "Exiting commit organization tool"
        exit 0
        ;;
    *)
        echo "❌ Invalid option"
        exit 1
        ;;
esac

echo "🎉 Commit organization complete"
