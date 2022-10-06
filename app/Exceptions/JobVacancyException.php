<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Http\Response;
class JobVacancyException extends Exception
{

    public function render(Request $request): Response
    {
        $status = 400;
        $error = "Something is wrong";
        $help = "Contact the sales team to verify";

        return response(["error" => $error, "help" => $help], $status);
    }
}
