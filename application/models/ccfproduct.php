<?php

class Ccfproduct extends CI_Model {

    private $sessiondata;

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->sessiondata = $this->session->userdata('logindata');
    }

    function sortalldata() {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('companyId', $this->sessiondata['companyid']);
        $query = $this->db->get();
        return $query->result();
    }

    function costdata() {
        $this->db->select('*');
        $this->db->from('productbatch');
        $this->db->where('companyId', $this->sessiondata['companyid']);
        $query = $this->db->get();
        return $query->result();
    }

    function editview($data) {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('productId', $data);
        $this->db->where('companyId', $this->sessiondata['companyid']);
        $query = $this->db->get();
        return $query->result();
    }

    function productlist() {
        $this->db->select('*');
        $this->db->order_by("productGroupName", "asc");
        $this->db->from('productgroup');
        $this->db->where('companyId', $this->sessiondata['companyid']);
        $query = $this->db->get();
        return $query->result();
    }

    function manufaclist() {
        $this->db->select('*');
        $this->db->order_by("manufactureName", "asc");
        $this->db->from('manufacturer');
        $this->db->where('companyId', $this->sessiondata['companyid']);
        $query = $this->db->get();
        return $query->result();
    }

    function unitlist() {
        $this->db->select('*');
        $this->db->order_by("unitName", "asc");
        $this->db->from('unit');
        $this->db->where('companyId', $this->sessiondata['companyid']);
        $query = $this->db->get();
        return $query->result();
    }

    public function addproduct() {
        $savedata = array(
            'productName' => $_POST['productName'],
            'productGroupId' => $_POST['productGroupId'],
            'manufactureId' => $_POST['manufactureId'],
            'stockMinimumLevel' => $_POST['stockMinimumLevel'],
            'stockMaximumLevel' => $_POST['stockMaximumLevel'],
            'unitId' => $_POST['unitId'],
            'taxType' => $_POST['taxType'],
            'tax' => $_POST['tax'],
            'description' => $_POST['description'],
            'companyId' => $this->sessiondata['companyid']
        );
        $savequery = $this->db->insert('product', $savedata);
        return $savequery;
    }

    function addproductbtch($productId) {
        $data2 = array(
            'productId' => $productId,
            'companyId' => $this->sessiondata['companyid']
        );
        $saveresult = $this->db->insert('productbatch', $data2);
        return $saveresult;
    }

    public function deleteproduct() {
        $productId = $_POST['productId'];
        $checkfarmer = $this->db->query("select ledgerId from ledgerposting where ledgerId = '$productId'");
        if ($checkfarmer->num_rows() > 0):
            return 'Notdeleted';
        else:
            $this->db->where('productId', $productId);
            $this->db->where('companyId', $this->sessiondata['companyid']);
            $deleteResult = $this->db->delete('product');
            return 'Deleted';
        endif;
    }

    public function editproduct() {
        $productId = $_POST['editproductId'];
        $data = array(
            'productName' => $_POST['editproductName'],
            'productGroupId' => $_POST['editproductGroupId'],
            'manufactureId' => $_POST['editmanufactureId'],
            'stockMinimumLevel' => $_POST['editstockMinimumLevel'],
            'stockMaximumLevel' => $_POST['editstockMaximumLevel'],
            'unitId' => $_POST['editunitId'],
            'taxType' => $_POST['edittaxType'],
            'tax' => $_POST['edittax'],
            'description' => $_POST['editdescription']
        );
        $this->db->where('productId', $productId);
        $this->db->where('companyId', $this->sessiondata['companyid']);
        $updateResult = $this->db->update('product', $data);
        return $updateResult;
    }

}
