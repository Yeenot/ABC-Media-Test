<?php

namespace App\Exceptions;

use Exception as BaseException;

class Exception extends BaseException
{
    /**
     * Initialization
     * 
     * @param string $section
     */
    public function __construct()
    {
        $this->message = __('exceptions.'.$this->key);
    }

    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        \Log::debug($this->message);
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        if ($request->wantsJson()) {
            return response()->json([
                'message' => $this->getMessage()
            ], $this->code);
        }
        abort(500);
    }
}