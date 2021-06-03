<?php
class Jobs
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
            'inspection_status' => 'Inspection Status',
            'estimate_date' => 'Estimate Date',
            'repair_date' => 'Repair Date',
            'invoice_date' => 'Invoice Date',
            'arrived' => 'Arrived',
            'est_complete' => 'Estimate Complete',
            'part_req' => 'Parts Required',
            'in_shop' => 'In Shop',
            'cust_waiting' => 'Customer Waiting',
            'total' => 'Total',
            'notes' => 'Notes',
            'discount' => 'Discount',
            'paid' => 'Paid',
            'job_comments' => 'Job Comments'
        ];

        return $ordering;
    }
}
?>
