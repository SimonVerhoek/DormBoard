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
            <title><?= htmlspecialchars($title) ?> | Dormboard</title>
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
            
            <nav class="navbar navbar-static-top" role="navigation" id="header-navbar">

                    <div class="container-fluid" id="header-container">
                    
                        <a class="navbar-brand" href="dinner.php">
                            <img id="logo" src="<?= WEBSITEROOT ?>/img/DormBoardlogo-small.png"/>
                        </a>
                        <a class="navbar-brand" href="dinner.php" id="header-title">
                            DormBoard
                        </a>