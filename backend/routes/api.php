<?php

Route::get('/tariff', TariffController::class.'@index');
Route::post('/order', OrderController::class.'@store');
