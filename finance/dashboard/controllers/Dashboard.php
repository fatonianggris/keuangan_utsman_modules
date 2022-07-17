<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->load->model('DashboardModel');
        if ($this->session->userdata('sias-finance') == FALSE) {
            redirect('finance/auth');
        }
    }

    //
    //-------------------------------DASHBOARD------------------------------//
    //
    
    public function index() {
        $data['nav_dash'] = 'menu-item-here';
        $data['budget_total'] = $this->DashboardModel->get_budget_insight();
        $data['budget_terpakai'] = $this->DashboardModel->get_budget_terpakai_insight();
        $data['budget_eksternal'] = $this->DashboardModel->get_budget_eksternal_insight();
        $data['budget_acc'] = $this->DashboardModel->get_budget_acc_insight();
        $data['budget_sisa'] = $this->DashboardModel->get_budget_sisa_insight();
        $data['outcome'] = $this->DashboardModel->get_outcome_insight();
        $data['outcome_persen'] = $this->DashboardModel->get_outcome_persen_insight();

        $this->template->load('template_finance/template_finance', 'finance_view_dashboard', $data);
        //$this->template->load('template_finance/template_finance', 'under_dev', $data);
    }

    //-----------------------------------------------------------------------//
//
}
