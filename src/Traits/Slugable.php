<?php

namespace Moiz2050\Rbac\Traits;

use Illuminate\Support\Str;

/**
 * Class Slugable
 * @package Moiz2050\Rbac\Traits
 */
trait Slugable
{
    /**
     * Set slug attribute.
     *
     * @param string $value
     * @return void
     */
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value, config('roles.separator'));
    }
}
