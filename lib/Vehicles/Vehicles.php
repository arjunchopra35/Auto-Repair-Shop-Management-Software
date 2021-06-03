<?php
class Vehicles
{
    /**
     *
     */
    public function __construct()
    {
    }

    /**
     *
     */
    public function __destruct()
    {
    }

    /**
     * Set friendly columns\' names to order tables\' entries
     */
    public function setOrderingValues()
    {
        $ordering = [
            'id' => 'ID',
            'vehicle_make' => 'Vehicle Make',
            'vehicle_model' => 'Vehicle Model',
            'vehicle_year' => 'Vehicle Year',
            'vehicle_kms' => 'Vehicle Kms',
            'vehicle_engine' => 'Vehicle Engine',
            'vehicle_vin' => 'Vehicle Vin',
            'vehicle_lic' => 'Vehicle Lic',
            'vehicle_owner_id' => 'Vehicle Owner Id'
        ];

        return $ordering;
    }
}
?>
