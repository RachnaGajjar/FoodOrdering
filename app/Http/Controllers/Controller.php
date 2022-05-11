<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as EncryptionDecryption;
class Controller extends EncryptionDecryption
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
