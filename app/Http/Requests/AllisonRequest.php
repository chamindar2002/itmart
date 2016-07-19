<?php

namespace Allison\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\URL;
/**
 * Created by PhpStorm.
 * User: chaminda
 * Date: 5/9/16
 * Time: 12:57 PM
 */
abstract class AllisonRequest extends FormRequest
{

    public function response(array $errors)
    {
        if ($this->ajax() || $this->wantsJson()) {
            return new JsonResponse($errors, 422);
        }

        dd($errors);

        return $this->redirector->to(URL::to('/'))
            ->withInput($this->except($this->dontFlash))
            ->withErrors($errors, $this->errorBag);
    }
}