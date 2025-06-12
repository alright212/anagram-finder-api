<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Anagram Finder API</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
        <style>
            * { margin: 0; padding: 0; box-sizing: border-box; }
            body { 
                font-family: 'Inter', sans-serif; 
                line-height: 1.6; 
                color: #333; 
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .container {
                max-width: 800px;
                margin: 0 auto;
                padding: 2rem;
                background: white;
                border-radius: 20px;
                box-shadow: 0 20px 40px rgba(0,0,0,0.1);
                text-align: center;
            }
            .logo {
                font-size: 3rem;
                font-weight: 700;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                margin-bottom: 1rem;
            }
            .subtitle {
                font-size: 1.2rem;
                color: #666;
                margin-bottom: 2rem;
            }
            .api-links {
                margin: 2rem 0;
                display: flex;
                gap: 1rem;
                justify-content: center;
                flex-wrap: wrap;
            }
            .btn {
                display: inline-block;
                padding: 0.75rem 1.5rem;
                text-decoration: none;
                border-radius: 8px;
                font-weight: 500;
                transition: all 0.2s;
                border: none;
                cursor: pointer;
            }
            .btn-primary {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
            }
            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
            }
            .btn-secondary {
                background: white;
                color: #667eea;
                border: 2px solid #667eea;
            }
            .btn-secondary:hover {
                background: #667eea;
                color: white;
            }
            .stats {
                margin: 2rem 0;
                padding: 1.5rem;
                background: #f8f9fa;
                border-radius: 12px;
                border-left: 4px solid #667eea;
            }
            .stat-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 1rem;
            }
            .stat {
                text-align: center;
            }
            .stat-number {
                font-size: 1.8rem;
                font-weight: 700;
                color: #667eea;
            }
            .stat-label {
                font-size: 0.9rem;
                color: #6c757d;
            }
            .features {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 1.5rem;
                margin: 2rem 0;
            }
            .feature {
                padding: 1.5rem;
                background: #f8f9fa;
                border-radius: 12px;
                border: 1px solid #e9ecef;
            }
            .feature h3 {
                color: #495057;
                margin-bottom: 0.5rem;
                font-weight: 600;
            }
            .feature p {
                color: #6c757d;
                font-size: 0.9rem;
            }
            .endpoints {
                text-align: left;
                margin: 2rem 0;
            }
            .endpoint {
                background: #f8f9fa;
                padding: 1rem;
                margin: 0.5rem 0;
                border-radius: 8px;
                border-left: 4px solid #28a745;
                font-family: 'Courier New', monospace;
                font-size: 0.9rem;
            }
            .method {
                background: #28a745;
                color: white;
                padding: 0.2rem 0.5rem;
                border-radius: 4px;
                font-size: 0.8rem;
                margin-right: 0.5rem;
            }
            .method.post { background: #007bff; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="logo">🔤 Anagram Finder API</div>
            <p class="subtitle">Estonian Language Anagram Discovery with Advanced Unicode Support</p>
            
            <div class="api-links">
                <a href="/api/documentation" class="btn btn-primary">📖 Interactive API Docs</a>
                <a href="/docs/api-docs.json" class="btn btn-secondary">📄 OpenAPI JSON</a>
            </div>

            <div class="stats">
                <h3 style="margin-bottom: 1rem;">🏆 Production Statistics</h3>
                <div class="stat-grid">
                    <div class="stat">
                        <div class="stat-number">177,953</div>
                        <div class="stat-label">Estonian Words</div>
                    </div>
                    <div class="stat">
                        <div class="stat-number">~19ms</div>
                        <div class="stat-label">Avg Response</div>
                    </div>
                    <div class="stat">
                        <div class="stat-number">100%</div>
                        <div class="stat-label">Unicode Support</div>
                    </div>
                    <div class="stat">
                        <div class="stat-number">O(1)</div>
                        <div class="stat-label">Lookup Time</div>
                    </div>
                </div>
            </div>

            <div class="features">
                <div class="feature">
                    <h3>🚀 Lightning Fast</h3>
                    <p>Sub-20ms anagram lookups with optimized algorithms and database indexing</p>
                </div>
                <div class="feature">
                    <h3>🔤 Unicode Ready</h3>
                    <p>Full Estonian diacritics support (äöüõšž) with proper normalization</p>
                </div>
                <div class="feature">
                    <h3>📚 Comprehensive</h3>
                    <p>177,953 Estonian words from official linguistic sources</p>
                </div>
                <div class="feature">
                    <h3>🏗️ Production Ready</h3>
                    <p>Built with SOLID principles, comprehensive testing, and full documentation</p>
                </div>
            </div>

            <div class="endpoints">
                <h3 style="margin-bottom: 1rem; text-align: center;">🔗 Quick API Reference</h3>
                
                <div class="endpoint">
                    <span class="method">GET</span>
                    <strong>/api/v1/anagrams/{word}</strong> - Find anagrams for a word
                </div>
                
                <div class="endpoint">
                    <span class="method">GET</span>
                    <strong>/api/v1/anagrams/stats</strong> - Get wordbase statistics
                </div>
                
                <div class="endpoint">
                    <span class="method post">POST</span>
                    <strong>/api/v1/wordbase/import</strong> - Import Estonian wordbase
                </div>
                
                <div class="endpoint">
                    <span class="method">GET</span>
                    <strong>/api/v1/wordbase/status</strong> - Check import status
                </div>
            </div>

            <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #e9ecef; color: #6c757d; font-size: 0.9rem;">
                <p>🔧 Try example: <code style="background: #f8f9fa; padding: 0.2rem 0.4rem; border-radius: 4px;">GET /api/v1/anagrams/listen</code></p>
                <p style="margin-top: 0.5rem;">Built with ❤️ for Estonian language processing</p>
            </div>
        </div>
    </body>
</html>
