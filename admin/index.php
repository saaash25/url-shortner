<?php
session_start();
include('../conf.php');
if (!isset($_SESSION['US_Username']) && !isset($_SESSION['US_Id'])) {
    header('Location: ' . BASEPATH);
} else {
    $textButton = "Logout";
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>URL Shortner</title>
        <link rel="shortcut icon" href="<?=BASEPATH?>assets/images/favicon.ico">
        <link rel="stylesheet" href="<?=BASEPATH?>assets/bootstrap/css/bootstrap.min.css" />
         <link rel="stylesheet" href="<?=BASEPATH?>assets/bootstrap/css/datatables.min.css" />
        <link rel="stylesheet" href="<?=BASEPATH?>assets/bootstrap/css/dataTables.bootstrap4.min.css" />
        <link rel="stylesheet" href="<?=BASEPATH?>Styles/custom-style.css" />

    </head>

    <body class="bg-light">
        <?php
        include('../includes/header.php');
        ?>
        <main>
            <div class="container-fluid bg-light">
                <section class="form-section">
                    <div class="row mt-10">
                        <div class="col-12 col-md-12">
                            <div class="shadow-sm  p-3  m-2 bg-white rounded" >
                                <table id="urlListingTable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Long URL</th>
                                            <th scope="col">Short URL</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
        <script src="<?=BASEPATH?>assets/jquery/jquery.min.js"></script>
        <script src="<?=BASEPATH?>assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?=BASEPATH?>assets/bootstrap/js/datatables.min.js"></script>
        <script src="<?=BASEPATH?>scripts/URL.Shortner.js"></script>
        <script>
            var basepath = '<?php echo BASEPATH ?>';
            $(document).ready(function () {
                URL.Shortner.urlListTable();
                URL.Shortner.adminLogin();
            })
        </script>
    </body>

</html>

