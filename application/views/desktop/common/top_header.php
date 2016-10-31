<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Job Board Jr.</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css')?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css')?>" />
    <?php echo $css_header?>



    <?php if($jquery_switch):?>
        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.11.2.min.js')?>"> </script>
    <?php endif;?>

    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js')?>"> </script>
    <?php echo $javascripts_header?>
</head>
<body>

<?php if($main_ng_switch){?>
    <div class="container" ng-app="jobBoard" ng-controller="jobBoardCtrl">
<?php }else{ ?>
    <div class="container">
<?php } ?>

