<?php

namespace App\Services;

class LocationService
{
    // Earth's radius (mean value) in kilometers
    public $earthRadius = 6371.009;

    public function getDistance($loc1, $loc2)
    {
        // Convert degrees to radians
        $lat1 = deg2rad($loc1->latitude);
        $lon1 = deg2rad($loc1->longitude);
        $lat2 = deg2rad($loc2->latitude);
        $lon2 = deg2rad($loc2->longitude);

        // Differences
        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;

        // Haversine formula
        $a = pow(sin($dlat / 2), 2) +
            cos($lat1) * cos($lat2) * pow(sin($dlon / 2), 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        // Distance in kilometers
        return intval(
            round($this->earthRadius * $c, 2)
        );
    }
}
