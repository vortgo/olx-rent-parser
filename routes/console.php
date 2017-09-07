<?php

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('advice', function () {
    $urls = [
        'http://fucking-great-advice.ru/api/random_by_tag/кодеру',
        'http://fucking-great-advice.ru/api/random_by_tag/верстальщику'
    ];
    $advice = json_decode(file_get_contents($urls[rand(0, 1)]));
    $text = preg_replace("/&#?[a-z0-9]{2,8};/i", "", html_entity_decode($advice->text));
    $message = "Совет: $text";
    $notify = new \App\Services\NotifyService();
    $notify->setChannelId('19:54b970231658409680e96affbf2d2e73@thread.skype')->send($message);

});
