<?php

namespace App\Repositories;

use App\Models\AccountHistories;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AccountHistoriesRepository
 * @package App\Repositories
 * @version September 29, 2019, 2:26 pm UTC
 *
 * @method AccountHistories findWithoutFail($id, $columns = ['*'])
 * @method AccountHistories find($id, $columns = ['*'])
 * @method AccountHistories first($columns = ['*'])
*/
class AccountHistoriesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'account_id',
        'user_id',
        'message'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return AccountHistories::class;
    }
}
