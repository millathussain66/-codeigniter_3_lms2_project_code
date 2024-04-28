<?php

$this->load->view('includes/header');
$this->load->view('includes/body');
$this->load->view('includes/menu');

$this->load->view($pages,$tdate=NULL);

$this->load->view('includes/footer');
?>