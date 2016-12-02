<?php

namespace Moiz2050\Rbac\Models;

use Moiz2050\Rbac\Traits\Slugable;
use Illuminate\Database\Eloquent\Model;
use Moiz2050\Rbac\Traits\RoleHasRelations;
use Moiz2050\Rbac\Contracts\RoleHasRelations as RoleHasRelationsContract;

/**
 * Class Role
 * @package Moiz2050\Rbac\Models
 */

class Role extends Model implements RoleHasRelationsContract
{
    use Slugable, RoleHasRelations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description', 'level'];

    /**
     * Create a new model instance.
     *
     * @param array $attributes
     *
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if ($connection = config('roles.connection')) {
            $this->connection = $connection;
        }
    }
}
