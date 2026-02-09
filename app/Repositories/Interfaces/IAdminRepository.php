<?php

namespace App\Repositories\Interfaces;

interface IAdminRepository
{
    /**
     * @param $request
     * @return mixed
     */
    public function adminRegisterProcess(array $request);

    /**
     * $param array $request
     * @return mixed
     */
    public function adminLoginProcess(array $request);
}
