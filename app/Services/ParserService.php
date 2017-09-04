<?php
/**
 * Created by PhpStorm.
 * User: vortgo
 * Date: 04/09/2017
 * Time: 21:43
 */

namespace App\Services;


use App\Models\Announcement;
use Yangqi\Htmldom\Htmldom;

class ParserService
{
    private $url;
    /** @var  NotifyService */
    private $notifyService;

    public function __construct($url, $notifyService)
    {
        $this->url = $url;
        $this->notifyService = $notifyService;
    }

    /**
     * Handle the parser
     */
    public function handle()
    {
        $items = $this->getParsedItems();
        $this->storeItems($items);
    }

    /**
     * Parse page
     *
     * @return array
     */
    private function getParsedItems()
    {
        $items = [];

        $html = new Htmldom($this->url);
        $table = $html->find('#offers_table',0);
        $blocks = $table->find('.wrap');
        foreach ($blocks as $block){
            $items[] = [
                'url' => $block->find('a.linkWithHash',0)->href,
                'title' => $block->find('h3',0)->find('strong',0)->plaintext,
            ];
        }
        return $items;
    }

    /**
     * Store new parsed items
     *
     * @param $items
     */
    private function storeItems($items)
    {
        $itemsForNotify = [];
        foreach ($items as $item) {
            if ($this->isExist($item['url'])) {
                continue;
            }
            Announcement::create($item);
            $itemsForNotify[] = $item;
        }

        $this->notify($itemsForNotify);
    }

    /**
     * Notify
     *
     * @param $items
     */
    private function notify($items)
    {
        if(empty($items)){
            return;
        }

        $message = $this->prepareMessage($items);
        $this->notifyService->send($message);
    }

    /**
     * Prepare message
     *
     * @param $items
     * @return string
     */
    private function prepareMessage($items)
    {
        $count = count($items);
        $msg = "Новых обьявлений: {$count}\n\n";
        foreach ($items as $item){
            $msg .= $item['title'] . "\n\n";
            $msg .= $item['url'] . "\n\n\n\n";
        }
        return $msg;
    }

    /**
     * Check is exits url to announcement
     *
     * @param $url
     * @return bool
     */
    private function isExist($url)
    {
        if (Announcement::where('url', $url)->first()) {
            return true;
        }
        return false;
    }
}
