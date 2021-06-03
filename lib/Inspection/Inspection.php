<?php
class Inspection
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
            'job_id' => 'Job Id',
            'date' => 'Date',
            'vin' => 'Vin',
            'plate' => 'Plate',
            'odo_in' => 'Odo in',
            'odo_out' => 'Odo out'
        ];

        return $ordering;
    }
}
?>
