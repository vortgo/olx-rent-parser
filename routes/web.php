<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $notifyService = new \App\Services\NotifyService();
    $parser = new \App\Services\ParserService('https://www.olx.ua/nedvizhimost/arenda-kvartir/dolgosrochnaya-arenda-kvartir/kiev/?search%5Bfilter_float_price%3Ato%5D=7500&search%5Bfilter_float_number_of_rooms%3Ato%5D=1&search%5Bprivate_business%5D=private&search%5Border%5D=created_at%3Adesc', $notifyService);
    $parser->handle();
});
