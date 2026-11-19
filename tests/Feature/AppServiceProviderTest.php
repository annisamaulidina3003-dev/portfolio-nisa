<?php

use App\Providers\AppServiceProvider;
use Illuminate\Support\Facades\DB;

test('boot aplikasi tidak menjalankan query database', function () {
    DB::enableQueryLog();

    $this->app->register(AppServiceProvider::class, true);

    expect(DB::getQueryLog())->toBeEmpty();
});
