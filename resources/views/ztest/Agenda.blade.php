@extends('layouts.layouts')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="image/prea.png">
    <title>Agenda</title>
    <!-- Bootstrap Core CSS -->
    <link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Calendar CSS -->
    <link href="/assets/plugins/calendar/dist/fullcalendar.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
    <div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Agenda</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Agenda</li>
        </ol>
    </div>
    <div class="col-md-7 col-4 align-self-center">
        <div class="d-flex m-t-10 justify-content-end">
            <div class="d-flex m-r-20 m-l-10 hidden-md-down">

            </div>
            <div class="d-flex m-r-20 m-l-10 hidden-md-down">


            </div>
            <div class="">
                <button class="right-side-toggle waves-effect waves-light btn-success btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
            </div>
        </div>
    </div>
</div>
                <!-- ============================================================== -->




<div class="col-md-9">
    <div class="card">
        <div class="card-body">
            <button type="button"  class="btn waves-effect waves-light btn-rounded btn-primary">Ajouter un nouvel évèment</button>
            <button type="button"  class="btn waves-effect waves-light btn-rounded btn-primary">Voir les détails</button>
            <button type="button"  class="btn waves-effect waves-light btn-rounded btn-primary">Afficher par</button>
<div id="calendar"></div>
        </div>
    </div>
</div>
                                <!-- BEGIN MODAL -->
<div class="modal none-border" id="my-event">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">
                        <strong>Ajouter un évèment</strong>
                    </h4>
            </div>
        <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white waves-effect" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-success save-event waves-effect waves-light">Créer un évènement</button>
                <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Supprimer</button>
            </div>
        </div>
    </div>
</div>
                                <!-- Modal Add Category -->
        <div class="modal fade none-border" id="add-new-event">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">
                        <strong>Ajouter</strong>Statut</h4>
                    </div>
                <div class="modal-body">
            <form role="form">
                <div class="row">

                    <div class="col-md-6">
                        <label class="control-label">Objet </label>
                        <input class="form-control form-white" placeholder="Enter name" type="text" name="category-name">
                    </div>

                    <div class="col-md-6">
                        <label class="control-label">Lieu</label>
                        <input class="form-control form-white" placeholder="Enter name" type="text" name="category-name">
                    </div>

                    <div class="col-md-6">
                        <label class="control-label">Parties prenantes</label>
                        <input class="form-control form-white" placeholder="Enter name" type="text" name="category-name">
                    </div>


                <div class="col-md-6">
                    <label class="control-label">Statut</label>
                    <input class="form-control form-white" placeholder="Enter name" type="text" name="category-name">
                </div>
                <div class="col-md-6">
                    <label class="control-label">Type de statut</label>
                    <select class="form-control form-white" data-placeholder="Choose a color..." name="category-color">
                        <option value="danger">A venir</option>
                        <option value="info">Reporter</option>
                        <option value="primary">Annuler</option>
                        <option value="primary">Achevé</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="control-label">Commentaires</label>
                    <input class="form-control form-white" placeholder="Enter name" type="text" name="category-name">
                </div>

                </div>
            </form>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect waves-light save-category" data-dismiss="modal">Enregistrer</button>
                <button type="button" class="btn btn-white waves-effect" data-dismiss="modal">Fermer</button>
                </div>
            </div>
            </div>
        </div>
                                <!-- END MODAL -->
                                <!-- ============================================================== -->
                                <!-- End PAge Content -->
                                <!-- ============================================================== -->
                                <!-- ============================================================== -->
                                <!-- Right sidebar -->
                                <!-- ============================================================== -->
                                <!-- .right-sidebar -->

                                <!-- ============================================================== -->
                                <!-- End Right sidebar -->
                                <!-- ============================================================== -->

                            <!-- ============================================================== -->
                            <!-- End Container fluid  -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- footer -->
                            <!-- ============================================================== -->

                            <!-- ============================================================== -->
                            <!-- End footer -->
                            <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- End Page wrapper  -->
                        <!-- ============================================================== -->

                    <!-- ============================================================== -->
                    <!-- End Wrapper -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- All Jquery -->
                    <!-- ============================================================== -->
                    <script src="../assets/plugins/jquery/jquery.min.js"></script>
                    <script src="../assets/plugins/calendar/jquery-ui.min.js"></script>
                    <!-- Bootstrap tether Core JavaScript -->
                    <script src="../assets/plugins/popper/popper.min.js"></script>
                    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
                    <!-- slimscrollbar scrollbar JavaScript -->
                    <script src="js/jquery.slimscroll.js"></script>
                    <!--Wave Effects -->
                    <script src="js/waves.js"></script>
                    <!--Menu sidebar -->
                    <script src="js/sidebarmenu.js"></script>
                    <!--stickey kit -->
                    <script src="../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
                    <script src="../assets/plugins/sparkline/jquery.sparkline.min.js"></script>
                    <!--Custom JavaScript -->
                    <script src="js/custom.min.js"></script>
                    <!-- Calendar JavaScript -->
                    <script src="../assets/plugins/calendar/jquery-ui.min.js"></script>
                    <script src="../assets/plugins/moment/moment.js"></script>
                    <script src='../assets/plugins/calendar/dist/fullcalendar.min.js'></script>
                    <script src="../assets/plugins/calendar/dist/cal-init.js"></script>
                    <!-- ============================================================== -->
                    <!-- Style switcher -->
                    <!-- ============================================================== -->
                    <script src="../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
                </body>

                </html>
                @endsection
