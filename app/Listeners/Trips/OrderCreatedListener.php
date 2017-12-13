<?php

namespace App\Listeners\Trips;

use App\User;
use GuzzleHttp\Client;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderCreatedListener implements ShouldQueue
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
                    sprintf("Order Created.\n%s\n%s\nDate : %s\nHire : Rs.%s\n",
                        $event->order->trip->truck,
                        $event->order->when->format('d-m-Y'),
                        $event->order,
                        $event->order->hire
                    )
                );
                $client->get("https://api.telegram.org/bot{$admin->token}/sendMessage?chat_id={$admin->chat_id}&text={$text}");
            }
        }
    }
}
