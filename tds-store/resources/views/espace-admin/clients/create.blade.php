@extends('layouts.master-dashboard')
@section('creation-client')
@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Clients',
    'infos2' => 'Clients',
    'infos3' => 'Ajout client',
])
<br>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card m-b-30">
            <div class="card-header bg-light">
                <h4 class="mt-2 header-title text-dark" style="font-size: 24px">Ajouter un nouveau client</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('root_espace_admin_cliens_create') }}" method="POST">
                    @csrf
                        <div class=" form-group">
                            <label>Nom</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"  style="height:50px;" type="text" placeholder="" name="name" >
                            {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}

                        </div>
                        <div class=" form-group">
                            <label>E-mail</label>
                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" style="height:50px;" type="text" placeholder="" name="email">
                            {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
                        </div>
                        <div class=" form-group">
                            <label>Rôle</label>
                            <input class="form-control {{ $errors->has('role') ? 'is-invalid' : '' }}"  style="height:50px;" type="text" placeholder="" name="role">
                            {!! $errors->first('role', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class=" form-group">
                            <label>Mot de Passe</label>
                            <div class="d-flex form-group" >
                                <input class="form-control  {{ $errors->has('password') ? 'is-invalid' : '' }}" style="height:50px;" type="password" placeholder="" name="password" class="masked" id="pwd">
                                <a class="border bg-white border-1" onclick="showHide()" id="eye"><i class="fa fa-eye mt-3"></i> </a>
                            </div>

                            {!! $errors->first('password', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class=" form-group">
                            <label>Confirmation mot de passe</label>
                            <div class="d-flex form-group">
                                <input class="form-control {{ $errors->has('password_confirm') ? 'is-invalid' : '' }}" style="height:50px;" type="password" placeholder="" name="password_confirm" class="masked" id="pwd_confirm">
                                <a class="border bg-white border-1" onclick="showHide()" id="eye_confrm"><i class="fa fa-eye mt-3"></i></a>
                            </div>
                            {!! $errors->first('password_confirm', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="float-right">
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    document.getElementById("eye").addEventListener("click", function(e){
        var pwd = document.getElementById("pwd");
        if(pwd.getAttribute("type")=="password"){
            pwd.setAttribute("type","text");
        } else {
            pwd.setAttribute("type","password");
        }
    });
</script>

<script>
    document.getElementById("eye_confirm").addEventListener("click", function(e){
        var pwd = document.getElementById("pwd_confirm");
        if(pwd.getAttribute("type")=="password"){
            pwd.setAttribute("type","text");
        } else {
            pwd.setAttribute("type","password");
        }
    });
</script>

@endsection
