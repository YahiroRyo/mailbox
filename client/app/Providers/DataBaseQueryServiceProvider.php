<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Database\Events\TransactionBeginning;
use Illuminate\Database\Events\TransactionCommitted;
use Illuminate\Database\Events\TransactionRolledBack;
use Carbon\Carbon;
use DateTime;

class DataBaseQueryServiceProvider extends ServiceProvider
{
    public function register()
    {
		DB::listen(function ($query): void {
			$sql = $query->sql;

			foreach ($query->bindings as $binding) {
				if (is_string($binding)) {
					$binding = "'{$binding}'";
				} elseif (is_bool($binding)) {
					$binding = $binding ? '1' : '0';
				} elseif (is_int($binding)) {
					$binding = (string) $binding;
				} elseif ($binding === null) {
					$binding = 'NULL';
				} elseif ($binding instanceof Carbon) {
					$binding = "'{$binding->toDateTimeString()}'";
				} elseif ($binding instanceof DateTime) {
					$binding = "'{$binding->format('Y-m-d H:i:s')}'";
				}

				$sql = preg_replace('/\\?/', $binding, $sql, 1);
			}

			logs()->debug('SQL', ['sql' => $sql, 'time' => "{$query->time} ms"]);
		});

		Event::listen(TransactionBeginning::class, function (TransactionBeginning $event): void {
			logs()->debug('SQL START TRANSACTION');
		});

		Event::listen(TransactionCommitted::class, function (TransactionCommitted $event): void {
			logs()->debug('SQL COMMIT');
		});

		Event::listen(TransactionRolledBack::class, function (TransactionRolledBack $event): void {
			logs()->debug('SQL ROLLBACK');
		});
    }

    public function boot()
    {
    }
}
