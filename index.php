<?php
session_start();
include('conf.php');
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>URL Shortner</title>
        <link rel="shortcut icon" href="<?= BASEPATH ?>assets/images/favicon.ico">
        <link rel="stylesheet" href="<?= BASEPATH ?>assets/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?= BASEPATH ?>Styles/custom-style.css" />
    </head>

    <body class="bg-light">
        <?php
        include('includes/header.php');
        ?>
        <main>
            <div class="container-fluid bg-light">
                <section class="form-section">
                    <div class="row mt-10">
                        <div class="col-12 col-md-7">
                            <div class="shadow-sm  p-3  m-2 bg-white rounded" >
                                <form id="urlShortenForm" action="Controllers/urlShortner.php" method="POST" autocomplete="off">
                                    <div class="col-12 col-md-12">
                                        <div class="form-group">
                                            <label for="orginalUrl">Long URL</label>
                                            <textarea  type="text" name="longUrl" class="form-control longUrl" id="longUrl"  placeholder="Example: www.youtube.com"></textarea >
                                            <div class="alert alert-danger mt-2 pt-1 pb-1 errorMessage" role="alert" style="display:none">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-10 col-md-12">
                                        <div class="form-group text-center">
                                            <button type="submit" class="btn  url-shorten-button font-weight-bold" >Shorten</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 col-md-5">
                            <div class="shadow-sm  p-3  m-2 bg-white rounded" >
                                <form id="urlShortenForm" action="Controllers/urlShortner.php" method="POST" autocomplete="off">
                                    <div class="col-12 col-md-12">
                                        <div class="form-group">
                                            <label for="orginalUrl">Short URL</label>
                                            <input type="text" name="shortUrl" class="form-control shortUrl"  id="shortUrl"  placeholder="">
                                            <small class="form-text text-muted successNoteMessage">Note: After generating Short URL, it will be visible in above box!</small>
                                        </div>
                                    </div>
                                    <div class="col-10 col-md-12">
                                        <div class="form-group text-center">
                                            <button type="button" class="btn  url-copy-button font-weight-bold" >Copy</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
        <section class="modal-section">
            <!-- Modal -->
            <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Login</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="admin-login" action="#" method="POST" autocomplete="off">
                                <div class="col-12 col-md-12">
                                    <div class="form-group">
                                        <label for="username">Usename</label>
                                        <input type="text" name="username" class="form-control username"  id="username"  placeholder="enter username" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control password"  id="password"  placeholder="enter password" autocomplete="off">
                                    </div>
                                </div>
                                <div class="alert alert-danger mt-2 pt-1 pb-1 errorLoginMessage" role="alert" style="display:none">
                                    Note: Please fill username and password before submiting!
                                </div>
                                <div class="col-10 col-md-12">
                                    <div class="form-group text-center">
                                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-sm btn-success adminLogin" >Login</button>
                                    </div>
                                </div>
                                <div class="col-10 col-md-12">
                                    <div class="form-group text-center">
                                        <small class="form-text text-muted"> Note: This is for Admin only!</small>
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </section>
        <script>
            var basepath = '<?php echo BASEPATH ?>';
        </script>
        <script src="<?= BASEPATH ?>assets/jquery/jquery.min.js"></script>
        <script src="<?= BASEPATH ?>assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?= BASEPATH ?>scripts/URL.Shortner.js"></script>

        <!-- put all other script links above this line -->
        <script>
            var basepath = '<?php echo BASEPATH ?>';
            $(document).ready(function () {
                URL.Shortner.LoadAllFunctions();
            })
        </script>
    </body>

</html>