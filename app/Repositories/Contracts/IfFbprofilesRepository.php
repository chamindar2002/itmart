<?php

namespace Allison\Repositories\Contracts;

interface IfFbprofilesRepository
{
    public function getAllProfiles();
    public function createOrUpdate($request, $access_token, $id = null);
}
