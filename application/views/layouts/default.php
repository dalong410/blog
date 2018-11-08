<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Saebom's Travel Blog">
    <meta name="author" content="SAEBOMKIM">
    <title>Saebom's Travel Blog</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="css/clean-blog.min.css" rel="stylesheet">

    <link rel="shortcut icon" href="img/favicon.png?1">
</head>
<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Custom scripts for this template -->
<script src="js/clean-blog.min.js"></script>
<body>
        <!-- header -->
        <header>
            <?php include VIEWPATH . "layouts/header.php"; ?>
        </header>
        <!-- //header -->
        <!-- main_container -->
        <section class="container">
            {yield}
        </section>
        <!-- //main_container -->
        <footer id="footer">
            <?php include VIEWPATH .  "layouts/footer.php"; ?>
        </footer>

    </section>
    <!-- //container -->

</div>
</body>
</html>