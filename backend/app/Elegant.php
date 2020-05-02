<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

abstract class Elegant extends Model
{
    public abstract function rules();

    protected $errors;

    public function validateAndFill($data)
    {
        $validator = Validator::make($data, $this->rules());
        if ($validator->fails()) {
            $this->errors = $validator->errors();
            return false;
        }
        $this->fill($data);
        return true;
    }

    public function errors()
    {
        return $this->errors;
    }
}
