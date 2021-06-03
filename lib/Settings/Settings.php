<?php
class Settings
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
            'name' => 'Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'address' => 'Address',
            'hst' => 'H.S.T.',
            'invoice_data' => 'Invoice Description',
            'repair_data' => 'Repair Description',
            'estimate_data' => 'Estimate Data',
            'nametech' => 'Technician Name',
            'tcn' => 'Trade Cert. Number'
        ];

        return $ordering;
    }
}
?>
