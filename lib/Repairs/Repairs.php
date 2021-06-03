<?php
class Repairs
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
            'vehicle_id' => 'Vehicle Id',
            'job_status' => 'Job Status',
            'inspection_status' => 'Inspection Status'
        ];

        return $ordering;
    }
}
?>
