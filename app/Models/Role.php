<?php

/*
 * This file is part of the Qsnh/meedu.
 *
 * (c) XiaoTeng <616896861@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'name', 'charge', 'expire_days', 'weight', 'description',
    ];

    protected $appends = [
        'edit_url', 'destroy_url',
    ];

    /**
     * @return string
     */
    public function getEditUrlAttribute()
    {
        return route('backend.role.edit', $this);
    }

    /**
     * @return string
     */
    public function getDestroyUrlAttribute()
    {
        return route('backend.role.destroy', $this);
    }

    /**
     * 当前会员下的用户.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class, 'user_id');
    }

    /**
     * @return array
     */
    public function descriptionRows()
    {
        return explode("\n", $this->getAttribute('description'));
    }
}
