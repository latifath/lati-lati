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
                <form action="{{ route('root_espace_admin_cliens_create') }}" method="POST" name="">
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
                        <label>Mot de Passe</label>
                        <div class="d-flex form-group" >
                            <input class="form-control password {{ $errors->has('password') ? 'is-invalid' : '' }}" style="height:50px;" type="password" placeholder="" name="password" class="masked" id="pwd">
                            <a class="border bg-white border-1" onclick="showHide()" id="eye"><i class="fa fa-eye mt-3"></i> </a>
                        </div>
                        <a class="btn btn-xs btn-info" onClick=generatePass()>Générer un mot de passe</a>

                        {!! $errors->first('password', '<p class="text-danger">:message</p>') !!}
                    </div>

                    <input type="checkbox" name="feature" id="clickme" value="1" /> Voulez vous recevoir un mail de votre nouveau compte?
                    <br>
                    <br>
                    <div class="float-right">
                        <button type="submit" class="btn btn-primary" >Ajouter</button>
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
    function generatePass() {
    var pass = '';
    var str='ABCDEFGHIJKLMNOPQRSTUVWXYZ'
    +  'abcdefghijklmnopqrstuvwxyz0123456789@#$';

   for (let i = 1; i <= 8; i++) {
      var char = Math.floor(Math.random()* str.length + 1);
            pass += str.charAt(char)
        }
  $('.password').val(pass);
    }

</script>

{{--  script pour le checkbox --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
$(document).ready(function() {
$('#clickme').click(function()
{
    if($(this).is(':checked'))
    {
        var checkedVal='';
        checkedVal=$(this).val('1');
    }
    else
    {
        $(this).val('0');
    }
});

});
</script>

@endsection
