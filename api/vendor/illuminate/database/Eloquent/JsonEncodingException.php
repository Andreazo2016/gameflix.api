<?php

namespace Illuminate\Database\Eloquent;

use RuntimeException;

class JsonEncodingException extends RuntimeException
{
    /**
     * Create a new JSON encoding exception for the Model.
     *
     * @param  mixed  $model
     * @param  string  $message
     * @return static
     */
    public static function forModel($model, $message)
    {
        return new static('Error encoding Model ['.get_class($model).'] with ID ['.$model->getKey().'] to JSON: '.$message);
    }
}
