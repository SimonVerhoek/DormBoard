<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="<?= WEBSITEROOT ?>/css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
        <link href="<?= WEBSITEROOT ?>/css/bootstrap-theme.min.css" type="text/css" rel="stylesheet"/>
        <link href="<?= WEBSITEROOT ?>/css/bootstrapValidator.min.css" type="text/css" rel="stylesheet"/>
        <link href="<?= WEBSITEROOT ?>/css/styles.css" type="text/css" rel="stylesheet"/>
        <link href='http://fonts.googleapis.com/css?family=Raleway:200' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Londrina+Sketch' rel='stylesheet' type='text/css'>

        <?php if (isset($title)): ?>
            <title>DormBoard: <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>DormBoard</title>
        <?php endif ?>

        <script src="<?= WEBSITEROOT ?>/js/jquery-1.10.2.min.js" type="text/javascript"></script>
        <script src="<?= WEBSITEROOT ?>/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?= WEBSITEROOT ?>/js/scripts.js" type="text/javascript"></script>
        <script src="<?= WEBSITEROOT ?>/js/bootstrapValidator.min.js" type="text/javascript"></script>
    </head>

    <body>
        
        <div id="header">
            
            <nav class="navbar navbar-default navbar-static-top" role="navigation">

                    <div class="container-fluid" id="header-container">
                    
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <a class="navbar-brand" href="dinner.php">
                                <img id="logo" src="<?= WEBSITEROOT ?>/img/DormBoardlogo-small.png"/>
                            </a>
                            <a class="navbar-brand" href="dinner.php" id="header-title">
                                DormBoard
                            </a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">