<?php
/**
 * Created by PhpStorm.
 * User: vortgo
 * Date: 04/09/2017
 * Time: 22:27
 */

namespace App\Services;


class NotifyService
{
    /**
     * Send message to skype
     *
     * @param string $message
     */
    public function send(string $message)
    {
        try {
            $botman = app('botman');
            $channelId = config('services.botman.skype_chat_id');
            if (!$channelId)
                return;

            $botman->say($message, $channelId, \Mpociot\BotMan\Drivers\BotFrameworkDriver::class, ['serviceUrl' => 'https://smba.trafficmanager.net/apis/']);
        } catch (\Exception $e) {
            \Log::error('Skype bot fault', [$e]);
        }

    }
}
