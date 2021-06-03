<?php
class Services
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
            'service_code' => 'Service Code',
            'service_name' => 'Service Name',
            'service_desc' => 'Service Description',
            'service_price' => 'Service Price'
        ];

        return $ordering;
    }
}
?>
