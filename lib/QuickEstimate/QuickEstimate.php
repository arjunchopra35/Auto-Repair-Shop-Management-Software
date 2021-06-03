<?php
class QuickEstimate
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
            'phone_no' => 'Phone',
            'serviceIds' => 'Services',
            'total' => 'Total',
            'discount' => 'Discount'
        ];

        return $ordering;
    }
}
?>
