<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_student extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_student') == NULL) {
            header("Location:" . site_url('student/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
        $this->load->model(array('student/Student_model', 'bulan/Bulan_model', 'bulan/Bulan_pay_model', 'month/Month_model', 'setting/Setting_model','bebas/Bebas_model', 'information/Information_model', 'bebas/Bebas_pay_model', 'period/Period_model', 'ltrx/Log_trx_model', 'payment/Payment_model'));
    }

    public function index() {
        $id = $this->session->userdata('uid');

        $params['group'] = TRUE;
        $logs['limit'] = 3;
        $logs['student_id'] = $this->session->userdata('uid_student');
        $pay['paymentt'] = TRUE;
        $pay['student_id'] = $this->session->userdata('uid_student');

        $data['information'] = $this->Information_model->get(array('information_publish'=>1));
        $data['bulan'] = $this->Bulan_model->get(array('status'=>0, 'period_status'=>1, 'student_id'=> $this->session->userdata('uid_student')));
        $data['bebas'] = $this->Bebas_model->get(array('period_status'=>1, 'student_id'=> $this->session->userdata('uid_student')));
        $data['period'] = $this->Period_model->get($params);
        $data['siswa'] = $this->Student_model->get(array('group'=>TRUE));
        $data['log'] = $this->Log_trx_model->get($logs);
        $data['months'] = $this->Month_model->get();
        $data['student'] = $this->Bulan_model->get($pay);
        $data['bulan'] = $this->Bulan_model->get(array('student_id'=> $this->session->userdata('uid_student')));
        $data['bill'] = $this->Bulan_model->get_total($params);
        $data['in'] = $this->Bulan_model->get_total($params);

        $data['total'] = array();
        foreach ($data['bill'] as $key) {
        if (!isset($data['total'][$key['payment_payment_id']])) {
            $data['total'][$key['payment_payment_id']] = 0;
        }
        $data['total'][$key['payment_payment_id']] += $key['bulan_bill'];
        }

        $data['pay'] = array();
        foreach ($data['in'] as $row) {
        if (!isset($data['pay'][$row['payment_payment_id']])) {
            $data['pay'][$row['payment_payment_id']] = 0;
        }
        $data['pay'][$row['payment_payment_id']] += $row['bulan_total_pay'];
        }

        $data['total_bulan'] =0;
        foreach ($data['bulan'] as $row) {
            $data['total_bulan'] += $row['bulan_bill'];
        }

        $data['total_bebas'] =0;
        foreach ($data['bebas'] as $row) {
            $data['total_bebas'] += $row['bebas_bill'];
        }

        $data['total_bebas_pay'] =0;
        foreach ($data['bebas'] as $row) {
            $data['total_bebas_pay'] += $row['bebas_total_pay'];
        }

        $data['title'] = 'Dashboard';
        $data['main'] = 'dashboard/dashboard_student';
        $this->load->view('student/layout', $data);
    }

    public function payout_bulan($id = NULL, $student_id = NULL, $bulan_id = NULL, $pay_id = NULL) {
        $data['class'] = $this->Student_model->get_class();
        $data['payment'] = $this->Payment_model->get(array('id' => $id));
        $data['bulan'] = $this->Bulan_model->get(array('payment_id' => $id, 'student_id' => $student_id));
        $data['student'] = $this->Student_model->get(array('id'=> $student_id));
        $data['bill'] = $this->Bulan_pay_model->get(array('bulan_id'=>$bulan_id, 'student_id'=>$student_id, 'payment_id'=>$id));

        $data['total'] = 0;
        foreach ($data['bulan'] as $key) {
            $data['total'] += $key['bulan_bill'];
        }

        $data['total_pay'] = 0;
        foreach ($data['bill'] as $row) {
            $data['total_pay'] += $row['bulan_pay_bill'];
        }

        $data['title'] = 'Tagihan Siswa';
        // $data['main'] = 'payout/payout_add_bulan';
        $this->load->view('dashboard/payout_add_bulan', $data);
    }

    public function payout_bebas($id = NULL, $student_id = NULL, $bebas_id = NULL, $pay_id = NULL) {
        $data['class'] = $this->Student_model->get_class();
        $data['payment'] = $this->Payment_model->get(array('id' => $id));
        $data['bebas'] = $this->Bebas_model->get(array('payment_id' => $id, 'student_id' => $student_id));
        $data['student'] = $this->Student_model->get(array('id'=> $student_id));
        $data['bill'] = $this->Bebas_pay_model->get(array('bebas_id'=>$bebas_id, 'student_id'=>$student_id, 'payment_id'=>$id));

        $data['total'] = 0;
        foreach ($data['bebas'] as $key) {
            $data['total'] += $key['bebas_bill'];
        }

        $data['total_pay'] = 0;
        foreach ($data['bill'] as $row) {
            $data['total_pay'] += $row['bebas_pay_bill'];
        }

        $data['title'] = 'Tagihan Siswa';
        // $data['main'] = 'payout/payout_add_bebas';
        $this->load->view('dashboard/payout_add_bebas', $data);
    }

}
