<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasSlug {

    public static function bootHasSlug() {
        static::creating(function ($model) {
            $model->generateSlug();
        });

        static::updating(function ($model) {
            $shouldRegenerate = $model->isDirty($model->getSlugSourceColumn()) || $model->isDirty('is_home');
            // Si el prefijo proviene de columna (p.ej. 'type'), observarla también
            if (property_exists($model, 'slugPrefixColumn') && $model->isDirty($model->slugPrefixColumn)) {
                $shouldRegenerate = true;
            }

            if ($shouldRegenerate) {
                $model->generateSlug();
            }
        });
    }

    public function generateSlug() {
        // Si tiene la propiedad "is_home" y es verdadera, el slug debe ser "/"
        if (isset($this->is_home) && $this->is_home) {
            $this->{$this->getSlugColumn()} = '/';
            return;
        }

        $source = $this->{$this->getSlugSourceColumn()} ?? null;

        if (!$source) {
            return;
        }

        $base = Str::slug($source);
        $prefix = trim((string) $this->getSlugPrefix());
        $prefix = $prefix !== '' ? Str::slug($prefix) : '';

        $separator = $this->getSlugPrefixSeparator();

        $base_slug = $prefix !== '' ? rtrim($prefix, $separator) . $separator . $base : $base;
        $slug = $base_slug;
        $count = 1;

        while (
        static::where($this->getSlugColumn(), $slug)
            ->where($this->getKeyName(), '!=', $this->getKey() ?? 0)
            ->exists()
        ) {
            $slug = $base_slug . '-' . $count++;
        }

        $this->{$this->getSlugColumn()} = $slug;
    }

    protected function getSlugSourceColumn(): string {
        return property_exists($this, 'slugSource') ? $this->slugSource : 'title';
    }

    protected function getSlugColumn(): string {
        return property_exists($this, 'slugColumn') ? $this->slugColumn : 'slug';
    }

    protected function getSlugPrefix(): string {
        if (method_exists($this, 'resolveSlugPrefix')) {
            $resolved = $this->resolveSlugPrefix();
            return $resolved ? (string) $resolved : '';
        }

        if (property_exists($this, 'slugPrefixColumn')) {
            $column = $this->slugPrefixColumn;
            $value = $this->{$column} ?? null;
            return $value ? (string) $value : '';
        }

        if (property_exists($this, 'slugPrefix')) {
            return (string) $this->slugPrefix;
        }

        return '';
    }

    protected function getSlugPrefixSeparator(): string {
        return property_exists($this, 'slugPrefixSeparator')
            ? (string) $this->slugPrefixSeparator
            : '/';
    }

}
