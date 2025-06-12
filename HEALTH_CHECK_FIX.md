# 🚨 Health Check Troubleshooting Guide

## The Problem

Your App Runner deployment shows as "successful" but DNS doesn't resolve globally. This is typically caused by a **misconfigured health check**.

## Root Cause Analysis

1. **TCP Health Check**: App Runner was using a basic TCP check on port 80
2. **Apache Responds**: Apache answers the TCP check, so deployment appears "successful"
3. **Laravel Issues**: Laravel application has errors (missing APP_KEY, database issues, etc.)
4. **No Healthy Targets**: Since Laravel isn't working, there are no healthy instances
5. **DNS Failure**: App Runner doesn't activate DNS when there are no healthy targets

## The Fix

### 1. Improved Health Check Configuration

We've implemented a comprehensive Laravel health check system:

**New Health Endpoints:**
- `/health` - Full health check (database, storage, config)
- `/ready` - Simple readiness check
- `/up` - Laravel's built-in health check

**App Runner Configuration (`apprunner.yaml`):**
```yaml
health_check:
  protocol: http
  path: /health
  interval: 30
  timeout: 5
  healthy_threshold: 2
  unhealthy_threshold: 3
```

### 2. Health Check Controller

The new `HealthController` performs these checks:
- ✅ Database connectivity
- ✅ Storage write permissions
- ✅ Laravel configuration loading

### 3. What This Fixes

- **Accurate Health Status**: Only marks deployment healthy when Laravel actually works
- **Early Problem Detection**: Catches configuration issues before they affect DNS
- **Better Debugging**: Detailed health check responses show what's failing

## Debugging Your Current Issue

### Step 1: Run the Debug Script

```bash
./debug-apprunner.sh
```

This will:
- Show recent application and service logs
- Test DNS resolution
- Check health check configuration
- Provide specific debugging suggestions

### Step 2: Check Application Logs

The most likely issues in your application logs:
1. **Missing APP_KEY** - Laravel can't start without encryption key
2. **Database Connection** - SQLite file permissions or path issues
3. **File Permissions** - Storage directory not writable
4. **Configuration Errors** - Missing or invalid config values

### Step 3: Deploy the Fixed Version

1. **Commit the health check improvements** (already done)
2. **Push to trigger new deployment**:
   ```bash
   git push origin main
   ```
3. **Monitor the deployment** with the debug script

## Expected Results After Fix

1. **Build Phase**: Should complete successfully (same as before)
2. **Health Check Phase**: Will now properly validate Laravel is working
3. **DNS Activation**: Only happens when health checks pass
4. **Service Available**: URL will resolve and respond correctly

## Prevention

To prevent this in the future:
- Always use HTTP health checks for web applications
- Test health endpoints locally before deploying
- Monitor application logs during deployment
- Use meaningful health check paths that test actual application functionality

## Manual Verification

After deployment, verify:

```bash
# Test health endpoint
curl https://your-app-url.com/health

# Expected response:
{
  "status": "healthy",
  "timestamp": "...",
  "checks": {
    "database": "ok",
    "storage": "ok", 
    "config": "ok"
  }
}
```

## Next Steps

1. **Deploy the fix** - Push the current changes
2. **Monitor deployment** - Use `./debug-apprunner.sh` 
3. **Verify DNS** - Check whatsmydns.net after deployment completes
4. **Test application** - Ensure all endpoints work correctly

The DNS propagation issue should resolve once Laravel is actually running correctly inside the container.
