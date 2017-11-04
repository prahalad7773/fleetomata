<?php

namespace App\Jobs;

use App\Models\Trip;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CalculateGPSKm implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $trip;
    protected $truck;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Trip $trip)
    {
        $this->truck = $trip->truck;
        $this->trip = $trip;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $start = $this->trip->started_at->startOfDay();
        $end = $this->trip->completed_at ?: Carbon::now();
        $end = $end->endOfDay();
        $client = new Client();
        $response = $client->get("http://gps.truckjee.com:3001/gps/{$this->truck->imei}/{$start}/{$end}");
        $data = json_decode($response->getBody()->getContents(), true);
        $this->calculateDistance($data);
    }

    protected function calculateDistance($data)
    {
        $distance = 0;
        for ($i = 0; $i < count($data) - 1; $i++) {
            $distance += round(
                $this->vincentyGreatCircleDistance(
                    $data[$i]['lat'], $data[$i]['long'], $data[$i + 1]['lat'], $data[$i + 1]['long']
                ), 2);
        }
        $this->trip->update([
            'gps_km' => round($distance, 2),
        ]);
        return $this;
    }

    protected function vincentyGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371)
    {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $lonDelta = $lonTo - $lonFrom;
        $a = pow(cos($latTo) * sin($lonDelta), 2) +
        pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
        $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

        $angle = atan2(sqrt($a), $b);
        return $angle * $earthRadius;
    }

}
