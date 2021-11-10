<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $statusCode)
    {
        $response = [
            'success' => true,
            'message' => "The request has succeeded.",
            'data' => $result,
        ];

        return response()->json($response, $statusCode);
    }

     /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($errorMessages = [], $statusCode)
    {
        $response = [
            'success' => false,
            'message' => "The request has not succeeded.",
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $statusCode);
    }
}
