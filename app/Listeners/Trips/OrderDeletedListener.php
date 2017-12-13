<?php

namespace App\Listeners\Trips;

use App\User;
use GuzzleHttp\Client;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderDeletedListener implements ShouldQueue
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $client = new Client();
        $admins = User::role('admin')->get();
        foreach ($admins as $admin) {
            if ($admin->chat_id && $admin->token) {
                $text = urlencode(
                    sprintf(
                        "Order Deleted from Trip %s", $event->order->trip->id()
                    )
                );
                $client->get("https://api.telegram.org/bot{$admin->token}/sendMessage?chat_id={$admin->chat_id}&text={$text}");
            }
        }
    }
}
