<?php

namespace App\Http\Controllers;

use App\Services\User\UserDataService;


class UsersController extends Controller
{
    public function getList(UserDataService $dataService)
    {
        try {
            return $this->responseSuccess(['items' => $dataService->getList()]);
        } catch (\Exception $e) {
            return $this->responseError();
        }
    }
}
