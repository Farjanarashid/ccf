<?php

class Customerdb extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
    }

    //add data
    function addcustomer()
    {
        $opening_balance=$this->input->post('opening_balance');
        if($opening_balance==""){
            $opening_balance=0.00;
        }

        $data = array(
            'acccountLedgerName' => $this->input->post('customer_name'),
            'accountGroupId' => '28',
            'openingBalance' =>$opening_balance,
            'debitOrCredit' => $this->input->post('dr_cr'),
            'description' => $this->input->post('description'),
            'address' => $this->input->post('address'),
            'phoneNo' => $this->input->post('phone'),
            'emailId' => $this->input->post('email'),
            'mobileNo' => $this->input->post('mobile'),
            'defaultOrNot' => '0',
            'billByBill' => '1',
            'companyId' =>$this->input->post('company_id')
        );

        $saveresult = $this->db->insert('accountledger', $data);
        return $saveresult;
    }

    //edit data
    function editCustomer($ledgerId)
    {
        $data = array(
            'acccountLedgerName' => $this->input->post('customer_name'),
            'openingBalance' => $this->input->post('opening_balance'),
            'debitOrCredit' => $this->input->post('dr_cr'),
            'address' => $this->input->post('address'),
            'description' => $this->input->post('description'),
            'phoneNo' => $this->input->post('phone'),
            'emailId' => $this->input->post('email'),
            'mobileNo' => $this->input->post('mobile')
        );
        $this->db->where('ledgerId', $ledgerId);
        $update = $this->db->update('accountledger', $data);
        return $update;
    }


    public function customerNameCheck()
    {
        $customerName = $this->input->post('suppname');
        $queryresult = $this->db->query("select * from accountledger where 	acccountLedgerName = '$customerName'");
        if ($queryresult->num_rows() > 0):
            return 'false';
        else:
            return 'true';
        endif;
    }
}

?>