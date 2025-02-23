@extends('layouts.layouts')
@section('content')

<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Utilisateur</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Utilisateur</li>
        </ol>
    </div>
    <div class="col-md-7 col-4 align-self-center">
        <div class="d-flex m-t-10 justify-content-end">
            <div class="d-flex m-r-20 m-l-10 hidden-md-down">

            </div>
            <div class="d-flex m-r-20 m-l-10 hidden-md-down">


            </div>

        </div>
    </div>
</div>


            <!-- Nav tabs -->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex no-block">
                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-primary" data-toggle="modal" data-target="#exampleModal">
                            <i class=""></i> Ajouter un nouvel utilisateur
                        </button>


                    </div>
                    <div class="table-responsive m-t-20">
                        <table id="example23" class="tablesaw table-striped table-hover table-bordered table tablesaw-columntoggle" cellspacing="0" width="100%" role="grid" aria-describedby="example23_info" style="width: 100%;">



                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example23" rowspan="1" colspan="1" style="width: 66px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Image</th>
                                    <th class="sorting" tabindex="0" aria-controls="example23" rowspan="1" colspan="1" style="width: 135px;" aria-label="Office: activate to sort column ascending">Nom</th>
                                    <th class="sorting" tabindex="0" aria-controls="example23" rowspan="1" colspan="1" style="width: 174px;" aria-label="Age: activate to sort column ascending">Email</th>
                                    <th class="sorting" tabindex="0" aria-controls="example23" rowspan="1" colspan="1" style="width: 117px;" aria-label="Start date: activate to sort column ascending">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $user)
                                    <tr class=" align-items-center">

                                        <td><img src="{{$user->image}}" style="width: 40px; height:40;" class="img-circle"></td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td></td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">

                                                    <form class=""  action="{{route('Utilisateur.destroy',$user->id)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                            <button type="submit" class="bt btn-danger mx-2">
                                                                <i type="submit" class="ti-trash"></i>
                                                            </button>
                                                        </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


@include('Utilisateur.ajoutUtilisateur')


@endsection
