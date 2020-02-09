<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccountHistoriesRequest;
use App\Http\Requests\UpdateAccountHistoriesRequest;
use App\Repositories\AccountHistoriesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class AccountHistoriesController extends AppBaseController
{
    /** @var  AccountHistoriesRepository */
    private $accountHistoriesRepository;

    public function __construct(AccountHistoriesRepository $accountHistoriesRepo)
    {
        $this->accountHistoriesRepository = $accountHistoriesRepo;
    }

    /**
     * Display a listing of the AccountHistories.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->accountHistoriesRepository->pushCriteria(new RequestCriteria($request));
        $accountHistories = $this->accountHistoriesRepository->all();

        return view('account_histories.index')
            ->with('accountHistories', $accountHistories);
    }

    /**
     * Show the form for creating a new AccountHistories.
     *
     * @return Response
     */
    public function create()
    {
        return view('account_histories.create');
    }

    /**
     * Store a newly created AccountHistories in storage.
     *
     * @param CreateAccountHistoriesRequest $request
     *
     * @return Response
     */
    public function store(CreateAccountHistoriesRequest $request)
    {
        $input = $request->all();

        $accountHistories = $this->accountHistoriesRepository->create($input);

        Flash::success('Account Histories saved successfully.');

        return redirect(route('accountHistories.index'));
    }

    /**
     * Display the specified AccountHistories.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $accountHistories = $this->accountHistoriesRepository->findWithoutFail($id);

        if (empty($accountHistories)) {
            Flash::error('Account Histories not found');

            return redirect(route('accountHistories.index'));
        }

        return view('account_histories.show')->with('accountHistories', $accountHistories);
    }

    /**
     * Show the form for editing the specified AccountHistories.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $accountHistories = $this->accountHistoriesRepository->findWithoutFail($id);

        if (empty($accountHistories)) {
            Flash::error('Account Histories not found');

            return redirect(route('accountHistories.index'));
        }

        return view('account_histories.edit')->with('accountHistories', $accountHistories);
    }

    /**
     * Update the specified AccountHistories in storage.
     *
     * @param  int              $id
     * @param UpdateAccountHistoriesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAccountHistoriesRequest $request)
    {
        $accountHistories = $this->accountHistoriesRepository->findWithoutFail($id);

        if (empty($accountHistories)) {
            Flash::error('Account Histories not found');

            return redirect(route('accountHistories.index'));
        }

        $accountHistories = $this->accountHistoriesRepository->update($request->all(), $id);

        Flash::success('Account Histories updated successfully.');

        return redirect(route('accountHistories.index'));
    }

    /**
     * Remove the specified AccountHistories from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $accountHistories = $this->accountHistoriesRepository->findWithoutFail($id);

        if (empty($accountHistories)) {
            Flash::error('Account Histories not found');

            return redirect(route('accountHistories.index'));
        }

        $this->accountHistoriesRepository->delete($id);

        Flash::success('Account Histories deleted successfully.');

        return redirect(route('accountHistories.index'));
    }
}
