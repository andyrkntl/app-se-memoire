@extends('layouts.layouts')
@section('content')
<!-- Language
<div class="col-lg-4 col-xlg-3 col-md-5">
    <div class="card">
        <div class="card-body">
            <center class="m-t-30"> <img src="../assets/images/users/5.jpg" class="img-circle" width="150">
                <h4 class="card-title m-t-10">Gouvernement de Hanna</h4>
                <h6 class="card-subtitle">Accute les Responsables Amix corp</h6>
                <div class="row text-center justify-content-md-center">
                    <div class="col-4"> <a href="javascript:void(0)" class="link"><i class="icon-people"></i><font class="font-medium">254</font></a></div>
                    <div class="col-4"> <a href="javascript:void(0)" class="link"><i class="icon-picture"></i><font class="font-medium">54</font></a></div>
                </div>
            </center>
        </div>
        <div>
            <hr> </div>
        <div class="card-body"> <small class="text-muted">Adresse électronique</small>
            <h6>hannagover.gmail.com</h6> <small class="text-muted p-t-30 db">Téléphone</small>
            <h6>(91 654 784 547)</h6> <small class="text-muted p-t-30 db">Adresse</small>
            <h6>71 Pilgrim Avenue Chevy Chase, MD 20815</h6>
            <div class="map-box">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470029.1604841957!2d72.29955005258641!3d23.019996818380896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1493204785508" width="100%" height="150" frameborder="0" style="border:0" allowfullscreen=""></iframe>
            </div> <small class="text-muted p-t-30 db">Profil social</small>
            <br>
            <button class="btn btn-circle btn-secondary"><i class="fa fa-facebook"></i></button>
            <button class="btn btn-circle btn-secondary"><i class="fa fa-whatsapp"></i></button>
            <button class="btn btn-circle btn-secondary"><i class="fa fa-envelope"></i></button>
        </div>
    </div>
</div>
-->

<div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

    <img src="{{ $user->avatar }}" alt="Avatar de l'utilisateur" class="rounded-circle">
    <h2>Kevin Anderson</h2>
    <h3>Web Designer</h3>
    <div class="social-links mt-2">
      <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
      <a href="#" class="facebook"><i class="bi b



      i-facebook"></i></a>
      <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
    </div>
  </div>


@endsection
