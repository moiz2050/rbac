<?php

namespace Moiz2050\Rbac\Models;

use Moiz2050\Rbac\Traits\Slugable;
use Illuminate\Database\Eloquent\Model;
use Moiz2050\Rbac\Traits\PermissionHasRelations;
use Moiz2050\Rbac\Contracts\PermissionHasRelations as PermissionHasRelationsContract;

/**
 * Class Permission
 * @package Moiz2050\Rbac\Models
 */
class Permission extends Model implements PermissionHasRelationsContract
{
    use Slugable, PermissionHasRelations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description', 'model'];

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
