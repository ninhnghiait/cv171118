<?php

namespace App\Listeners\EventListener;

use App\Events\Event\viewNews;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Model\News\NENews;
use Cookie;

class IncreamentViewNews
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  viewNews  $event
     * @return void
     */
    public function handle(viewNews $event)
    {
        $id = $event->id;
        if (Cookie::has('_ninhnghiait_his')) {
            $_pro_his = $this->__decryptp(Cookie::get('_ninhnghiait_his'));
            $_ar_pro_his = explode(',', $_pro_his);
            if (!in_array($id, $_ar_pro_his)) {
                array_unshift($_ar_pro_his, $id);
                $_pro_his = implode(',', $_ar_pro_his);
                Cookie::queue(Cookie::make('_ninhnghiait_his', $_pro_his, 43200));
                $mNENews = new NENews();
                $mNENews->incrementView($id);
            }
        } else {
            Cookie::queue(Cookie::make('_ninhnghiait_his', $id, 43200));
            $mNENews = new NENews();
            $mNENews->incrementView($id);
        }
        return true;
    }
    protected function __decryptp($cookie)
    {
        $encrypted = encrypt($cookie);
        $decrypted = decrypt($encrypted);
        return $decrypted;
    }
}
