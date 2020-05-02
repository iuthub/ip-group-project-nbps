<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

abstract class Elegant extends Model
{
    public abstract function rules();

    protected $errors;

    public function validateAndFill(array $data)
    {
        $validator = Validator::make($data, $this->rules());
        if ($validator->fails()) {
            $this->errors = $validator->errors();
            return false;
        }
        $this->fill($validator->validate());
        return true;
    }

    public function errors()
    {
        return $this->errors;
    }
}
