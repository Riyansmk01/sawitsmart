<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController as AppBaseController;
use CodeIgniter\API\ResponseTrait;

abstract class BaseController extends AppBaseController
{
    use ResponseTrait;
}
