<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;

class ManageTranslations extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'translations:manage 
                            {action : Action to perform (validate, export, import, missing)}
                            {--locale= : Specific locale to work with}
                            {--format=json : Export format (json, csv, php)}
                            {--output= : Output file path}';

    /**
     * The console command description.
     */
    protected $description = 'Manage translation files - validate, export, import, or find missing translations';

    /**
     * Supported locales
     */
    private const SUPPORTED_LOCALES = ['en', 'et', 'de', 'fr'];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $action = $this->argument('action');
        
        switch ($action) {
            case 'validate':
                return $this->validateTranslations();
            case 'export':
                return $this->exportTranslations();
            case 'import':
                return $this->importTranslations();
            case 'missing':
                return $this->findMissingTranslations();
            default:
                $this->error("Unknown action: {$action}");
                $this->info("Available actions: validate, export, import, missing");
                return 1;
        }
    }

    /**
     * Validate all translation files
     */
    private function validateTranslations(): int
    {
        $this->info('Validating translation files...');
        
        $errors = 0;
        $baseLocale = 'en';
        $baseTranslations = $this->loadTranslations($baseLocale);
        
        if (empty($baseTranslations)) {
            $this->error("Base locale ({$baseLocale}) translations not found!");
            return 1;
        }

        foreach (self::SUPPORTED_LOCALES as $locale) {
            if ($locale === $baseLocale) continue;
            
            $this->info("Validating {$locale}...");
            $localeTranslations = $this->loadTranslations($locale);
            
            if (empty($localeTranslations)) {
                $this->error("  No translations found for {$locale}");
                $errors++;
                continue;
            }

            $missing = $this->findMissingKeys($baseTranslations, $localeTranslations);
            $extra = $this->findMissingKeys($localeTranslations, $baseTranslations);

            if (!empty($missing)) {
                $this->warn("  Missing keys in {$locale}: " . count($missing));
                foreach (array_slice($missing, 0, 5) as $key) {
                    $this->line("    - {$key}");
                }
                if (count($missing) > 5) {
                    $this->line("    ... and " . (count($missing) - 5) . " more");
                }
                $errors++;
            }

            if (!empty($extra)) {
                $this->warn("  Extra keys in {$locale}: " . count($extra));
                foreach (array_slice($extra, 0, 3) as $key) {
                    $this->line("    + {$key}");
                }
            }

            if (empty($missing) && empty($extra)) {
                $this->info("  ✓ {$locale} is complete");
            }
        }

        if ($errors === 0) {
            $this->info('All translations validated successfully!');
            return 0;
        } else {
            $this->error("Validation completed with {$errors} issues.");
            return 1;
        }
    }

    /**
     * Export translations to various formats
     */
    private function exportTranslations(): int
    {
        $locale = $this->option('locale') ?? 'all';
        $format = $this->option('format') ?? 'json';
        $output = $this->option('output');

        $this->info("Exporting translations in {$format} format...");

        $locales = $locale === 'all' ? self::SUPPORTED_LOCALES : [$locale];
        $exportData = [];

        foreach ($locales as $loc) {
            $translations = $this->loadTranslations($loc);
            if (!empty($translations)) {
                $exportData[$loc] = $translations;
            }
        }

        if (empty($exportData)) {
            $this->error('No translations found to export');
            return 1;
        }

        $exported = $this->formatExport($exportData, $format);
        
        if ($output) {
            File::put($output, $exported);
            $this->info("Exported to: {$output}");
        } else {
            $this->line($exported);
        }

        return 0;
    }

    /**
     * Import translations (placeholder for future implementation)
     */
    private function importTranslations(): int
    {
        $this->warn('Import functionality not yet implemented');
        $this->info('This would allow importing translations from JSON/CSV files');
        return 0;
    }

    /**
     * Find missing translations across all locales
     */
    private function findMissingTranslations(): int
    {
        $this->info('Finding missing translations...');
        
        $locale = $this->option('locale');
        $baseLocale = 'en';
        $baseTranslations = $this->loadTranslations($baseLocale);

        if (empty($baseTranslations)) {
            $this->error("Base locale ({$baseLocale}) translations not found!");
            return 1;
        }

        $locales = $locale ? [$locale] : array_filter(self::SUPPORTED_LOCALES, fn($l) => $l !== $baseLocale);

        foreach ($locales as $loc) {
            $this->info("\nChecking {$loc}:");
            $localeTranslations = $this->loadTranslations($loc);
            
            if (empty($localeTranslations)) {
                $this->error("  No translations file found for {$loc}");
                continue;
            }

            $missing = $this->findMissingKeys($baseTranslations, $localeTranslations);
            
            if (empty($missing)) {
                $this->info("  ✓ All translations present");
            } else {
                $this->warn("  Missing " . count($missing) . " translations:");
                foreach ($missing as $key) {
                    $value = $this->getNestedValue($baseTranslations, $key);
                    $this->line("    {$key}: '{$value}'");
                }
            }
        }

        return 0;
    }

    /**
     * Load translations for a specific locale
     */
    private function loadTranslations(string $locale): array
    {
        $filePath = resource_path("lang/{$locale}/api.php");
        
        if (!File::exists($filePath)) {
            return [];
        }

        return include $filePath;
    }

    /**
     * Find missing keys by comparing two translation arrays
     */
    private function findMissingKeys(array $base, array $target, string $prefix = ''): array
    {
        $missing = [];
        
        foreach ($base as $key => $value) {
            $fullKey = $prefix ? "{$prefix}.{$key}" : $key;
            
            if (!array_key_exists($key, $target)) {
                $missing[] = $fullKey;
            } elseif (is_array($value) && is_array($target[$key])) {
                $missing = array_merge($missing, $this->findMissingKeys($value, $target[$key], $fullKey));
            }
        }
        
        return $missing;
    }

    /**
     * Get nested value from array using dot notation
     */
    private function getNestedValue(array $array, string $key): string
    {
        $keys = explode('.', $key);
        $value = $array;
        
        foreach ($keys as $k) {
            if (!is_array($value) || !array_key_exists($k, $value)) {
                return '';
            }
            $value = $value[$k];
        }
        
        return is_string($value) ? $value : '';
    }

    /**
     * Format export data based on specified format
     */
    private function formatExport(array $data, string $format): string
    {
        switch ($format) {
            case 'json':
                return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            
            case 'csv':
                $csv = "Locale,Key,Value\n";
                foreach ($data as $locale => $translations) {
                    $flattened = $this->flattenArray($translations);
                    foreach ($flattened as $key => $value) {
                        $csv .= "\"{$locale}\",\"{$key}\",\"{$value}\"\n";
                    }
                }
                return $csv;
            
            case 'php':
                return "<?php\n\nreturn " . var_export($data, true) . ";\n";
            
            default:
                return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Flatten nested array with dot notation keys
     */
    private function flattenArray(array $array, string $prefix = ''): array
    {
        $flattened = [];
        
        foreach ($array as $key => $value) {
            $fullKey = $prefix ? "{$prefix}.{$key}" : $key;
            
            if (is_array($value)) {
                $flattened = array_merge($flattened, $this->flattenArray($value, $fullKey));
            } else {
                $flattened[$fullKey] = $value;
            }
        }
        
        return $flattened;
    }
}
