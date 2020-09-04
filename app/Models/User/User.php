<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $table = 'user';

    public $timestamps = false;
    
    protected $hidden = [
        'password'
    ];

    protected $fillable = [
        'name', 
        'password', 
        'updated_at',
        'created_at'
    ];

    /**
     * 获取所有用户列表
     *
     * @return object
     */ 
    public function getUserAll(): object
    {
        return User::select('id as userId', 'name', 'created_at as createdAt', 'updated_at as updatedAt')->get();
    }

}
