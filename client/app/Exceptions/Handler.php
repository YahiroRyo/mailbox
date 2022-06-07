<?php

namespace App\Exceptions;

use Aws\Ses\Exception\SesException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $levels = [
    ];

    protected $dontReport = [
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

	public function render($request, Throwable $e)
	{
		if ($e->getCode() >= 400 && $request->method != 'GET') {
			logs()->error('REQUEST', $request->toArray());
		}

		return parent::render($request, $e);
	}
}
