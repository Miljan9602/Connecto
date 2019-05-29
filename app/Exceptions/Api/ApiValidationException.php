<?php

namespace App\Exceptions\Api;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class ApiValidationException extends ValidationException implements Responsable
{
    /**
     * @var array $errorData
     */
    private $errorData = null;


    /**
     * @param string $message
     * @return $this
     */
    public function setMessage(string $message) {
        $this->message = $message;
        return $this;
    }

    /**
     * @param array $errorData
     * @return $this
     */
    public function setErrorData(array $errorData)
    {
        $this->errorData = $errorData;
        return $this;
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function toResponse($request)
    {
        // Must have data.
        $response = [
            'status' => 'fail',
            'message' => $this->message,
            'error_type' => 'validation_failed',
        ];

        // If additional data is set, display.
        if ($this->errorData) {
            $response['error'] = $this->errorData;
        }

        return new Response($response, $this->status);
    }

}
