<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

/**
 * Trait untuk auto-clear cache saat model diupdate
 */
trait ClearsCache
{
    /**
     * Boot the trait
     */
    public static function bootClearsCache()
    {
        static::saved(function ($model) {
            $model->clearCache();
        });

        static::deleted(function ($model) {
            $model->clearCache();
        });

        static::updated(function ($model) {
            $model->clearCache();
        });
    }

    /**
     * Clear cache for this model
     */
    public function clearCache()
    {
        $cacheKey = $this->getCacheKey();
        
        if (is_array($cacheKey)) {
            foreach ($cacheKey as $key) {
                Cache::forget($key);
            }
        } elseif ($cacheKey) {
            Cache::forget($cacheKey);
        }
    }

    /**
     * Get cache key(s) to clear
     * Override this method in model
     *
     * @return string|array|null
     */
    abstract public function getCacheKey();
}
