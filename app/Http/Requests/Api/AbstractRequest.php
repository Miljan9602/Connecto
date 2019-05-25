<?php

namespace App\Http\Requests\Api;

use App\Exceptions\Api\ApiValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

abstract class AbstractRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        $errorsData = [];
        $errorMessage = null;

        foreach ($validator->errors()->toArray() as $key => $errors) {

            if (sizeof($errors) > 0) {
                $errorsData[$key] = $errors[0];
            }
        }

        throw (new ApiValidationException($validator))->setErrorData($errorsData);
    }

    /**
     * @return array
     */
    public abstract function rules(): array;
}
