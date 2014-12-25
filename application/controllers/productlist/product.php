<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product extends CI_Controller {

    private $sessiondata;

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('ccfproduct');
        $this->sessiondata = $this->session->userdata('logindata');
        if ($this->sessiondata['status'] == 'login'):
            $accessFlag = 1;
        else:
            $accessFlag = 0;
            redirect('home');
        endif;
    }

    public function index() {
        $data['baseurl'] = $this->config->item('base_url');
        $data['title'] = "Product";
        $data['active_menu'] = "master";
        $data['active_sub_menu'] = "product";
        if ($this->sessiondata['status'] == 'login'):
            $data['costdata'] = $this->ccfproduct->costdata();
            $data['sortalldata'] = $this->ccfproduct->sortalldata();
            $data['manufaclist'] = $this->ccfproduct->manufaclist();
            $data['unitlist'] = $this->ccfproduct->unitlist();
            $data['productlist'] = $this->ccfproduct->productlist();
            $this->load->view('header', $data);
            $this->load->view('sidebar', $data);
            $this->load->view('productlist/product', $data);
            $this->load->view('footer', $data);
        else:
            redirect('home');
        endif;
    }

    public function addproductview() {
        $data['baseurl'] = $this->config->item('base_url');
        $data['title'] = "Product";
        $data['active_menu'] = "master";
        $data['active_sub_menu'] = "product";
        if ($this->sessiondata['status'] = 'login'):
            $data['sortalldata'] = $this->ccfproduct->sortalldata();
            $data['manufaclist'] = $this->ccfproduct->manufaclist();
            $data['unitlist'] = $this->ccfproduct->unitlist();
            $data['productlist'] = $this->ccfproduct->productlist();
            $this->load->view('header', $data);
            $this->load->view('sidebar', $data);
            $this->load->view('productlist/addproductview', $data);
            $this->load->view('footer', $data);
            $this->load->view('productlist/script', $data);
        else:
            redirect('home');
        endif;
    }

    public function editproductview() {
        $data['baseurl'] = $this->config->item('base_url');
        $data['title'] = "Product";
        $data['active_menu'] = "master";
        $data['active_sub_menu'] = "product";
        $id = $this->uri->segment(4);
        if ($this->sessiondata['status'] = 'login'):
            $data['databyid'] = $this->ccfproduct->editview($id);
            $data['sortalldata'] = $this->ccfproduct->sortalldata();
            $data['manufaclist'] = $this->ccfproduct->manufaclist();
            $data['unitlist'] = $this->ccfproduct->unitlist();
            $data['productlist'] = $this->ccfproduct->productlist();
            $this->load->view('header', $data);
            $this->load->view('sidebar', $data);
            $this->load->view('productlist/editproductview', $data);
            $this->load->view('footer', $data);
        else:
            redirect('home');
        endif;
    }

    public function addproduct() {
        $productName = $this->input->post('productName');
        $cmpid = $this->sessiondata['companyid'];
        $saveresult = $this->ccfproduct->addproduct();
        $query = $this->db->query("SELECT  productId  FROM  product WHERE productName='$productName' AND companyId = '$cmpid'");
        $productId = $query->row()->productId;
        $isadded = $this->ccfproduct->addproductbtch($productId);
        if ($saveresult && $isadded):
            $this->session->set_userdata('success', 'Product information saved successfully');
            redirect('productlist/product');
        else:
            $this->session->set_userdata('fail', 'Product information save failed');
            redirect('productlist/product');
        endif;
    }

    public function deleteproduct() {
        if ($this->sessiondata['status'] = 'login'):
            $deleteResult = $this->ccfproduct->deleteproduct();
            $this->session->set_userdata('deleted', $deleteResult);
            redirect('productlist/product');
        else:
            redirect('home');
        endif;
    }

    public function editproduct() {
        if ($this->sessiondata['status'] = 'login'):
            $updateResult = $this->ccfproduct->editproduct();
            if ($updateResult):
                $this->session->set_userdata('success', 'Product update successfully');
                redirect('productlist/product');
            else:
                $this->session->set_userdata('fail', 'Product update failed');
                redirect('productlist/product');
            endif;
        else:
            redirect('home');
        endif;
    }

}
