@extends('layouts.layouts')
@section('content')

<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Evaluation</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Evaluation</li>
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

<div class="row">
    <div class="col-lg-12">
        <div class="card card-outline-info">
            <div class="card-header">
                <h4 class="m-b-0 text-white">Evaluer un chantier</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('evaluation.store')}}" class="form-horizontal">
                    @csrf
                    <div class="form-body">
                        <h3 class="box-title"></h3>
                        <hr class="m-t-0 m-b-40">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label>Nom du chantier</label>
                                    <select class="form-control" name="chantier_id" >
                                        @foreach ($chantier as $chantier)
                                            <option name="chantier_id" value="{{$chantier->id}}">{{$chantier->Nom_chantier}}</option>
                                        @endforeach
                                    </select>
                                    <div class="col-md-9">
                                        <label>Nom du activite</label>
                                        <select name="activite_id" class="form-control">
                                            @foreach ($activite as $activite)
                                                <option name="activite_id" value="{{$activite->id}}">{{$activite->Nom_activite}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>



                            <div class="col-md-6">
                                <div class="form-group row">



                                    <label class="control-label text-right col-md-3">Avencements en pourcent</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="Avancement">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Problème de financement</label>
                                    <div class="col-md-9">
                                        <label class="custom-control custom-radio">
                                            <input id="Pro1" name="Pro1" type="radio" class="custom-control-input" value="OUI">
                                            <span class="custom-control-label" value="OUI">OUI</span>
                                        </label>
                                        <label class="custom-control custom-radio">
                                            <input id="Pro1" name="Pro1" type="radio" class="custom-control-input" value="NON">
                                            <span class="custom-control-label" value="NON">NON</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Problème de coordinnation entre les acteurs</label>
                                    <div class="col-md-9">
                                        <label class="custom-control custom-radio">
                                            <input id="Pro2" name="Pro2" type="radio" class="custom-control-input" value="OUI">
                                            <span class="custom-control-label" value="OUI">OUI</span>
                                        </label>
                                        <label class="custom-control custom-radio">
                                            <input id="Pro2" name="Pro2" type="radio" class="custom-control-input" value="NON">
                                            <span class="custom-control-label" value="NON">NON</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Problème de passation de marché</label>
                                    <div class="col-md-9">
                                        <label class="custom-control custom-radio">
                                            <input id="Pro3" name="Pro3" type="radio" class="custom-control-input" value="OUI">
                                            <span class="custom-control-label" value="OUI">OUI</span>
                                        </label>
                                        <label class="custom-control custom-radio">
                                            <input id="Pro3" name="Pro3" type="radio" class="custom-control-input" value="NON">
                                            <span class="custom-control-label" value="NON">NON</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Problème d'ordre juridique</label>
                                    <div class="col-md-9">
                                        <label class="custom-control custom-radio">
                                            <input id="Pro4" name="Pro4" type="radio" class="custom-control-input" value="OUI">
                                            <span class="custom-control-label" value="OUI">OUI</span>
                                        </label>
                                        <label class="custom-control custom-radio">
                                            <input id="Pro4" name="Pro4" type="radio" class="custom-control-input" value="NON">
                                            <span class="custom-control-label" value="NON">NON</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Problème d'ordre technique</label>
                                    <div class="col-md-9">
                                        <label class="custom-control custom-radio">
                                            <input id="Pro5" name="Pro5" type="radio" class="custom-control-input" value="OUI">
                                            <span class="custom-control-label" value="OUI">OUI</span>
                                        </label>
                                        <label class="custom-control custom-radio">
                                            <input id="Pro5" name="Pro5" type="radio" class="custom-control-input" value="NON">
                                            <span class="custom-control-label" value="NON">NON</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Problème sur le remplissage de source de vérification</label>
                                    <div class="col-md-9">
                                        <label class="custom-control custom-radio">
                                            <input id="Pro6" name="Pro6" type="radio" class="custom-control-input" value="OUI">
                                            <span class="custom-control-label" value="OUI">OUI</span>
                                        </label>
                                        <label class="custom-control custom-radio">
                                            <input id="Pro6" name="Pro6" type="radio" class="custom-control-input" value="NON">
                                            <span class="custom-control-label" value="NON">NON</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">Autres</label>
                                        <div class="col-md-9">
                                            <textarea name="Autres" class="form-control" ></textarea>
                                        </div>
                                </div>
                            </div>
                        </div>
                    <hr>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-6">

                                    <div class="modal-footer">
                                        <button type="submit" class="btn waves-effect waves-light btn-rounded btn-primary">Enregistrer</button>
                                        <button type="submit" class="btn waves-effect waves-light btn-rounded btn-secondary" data-dismiss="modal">Annuler</button>
                                    </div>

                            </div>

                        </div>
                    </div>




                </form>
            </div>
        </div>
    </div>
</div>
@endsection
