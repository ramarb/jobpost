<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Job Board Jr.</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css')?>" />

    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.11.2.min.js')?>"> </script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js')?>"> </script>
    <?php echo $javascripts_header?>
</head>
<body>
<div class="container" ng-app="jobBoard" ng-controller="jobBoardCtrl">
    <div class="row container-entry-form">

        <?php
		$default = '';
		$public = array(
			'vacancies' => '',
			'registration' => ''
		);
		
		if(strlen(trim($this->uri->segment(1))) > 0){
			$public[$this->uri->segment(1)] = 'active';
		}else{
			$default = 'active';
		}
		
		?>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url('/') ?>">Home</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="<?php echo $public['vacancies']?>"><a href="<?php echo base_url('vacancies/') ?>">Vacancies</a></li>
                    </ul>
                    <?php $this->load->view('desktop/common/search_job') ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->session->userdata('login')->first_name ?><span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Edit Profile</a></li>
                                <li><a href="<?php echo base_url(strtolower($role) . '/vacancies/mylist')?>">My Vacancies</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="<?php echo base_url('logout')?>">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>