<?php

namespace App\Repositories;

use App\Models\User;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserRepository
 * @package App\Repositories
 * @version September 24, 2019, 4:39 pm UTC
 *
 * @method User findWithoutFail($id, $columns = ['*'])
 * @method User find($id, $columns = ['*'])
 * @method User first($columns = ['*'])
*/
class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'role_id',
        'email',
        'password',
        'remember_token'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }
}
