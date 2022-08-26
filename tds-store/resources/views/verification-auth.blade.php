@php

if( Auth::user()->role == "admin" || Auth::user()->role == "comptable" || Auth::user()->role == "gestionnaire" ) {
    return redirect()->to('/espace-admin')->send();

}else if(Auth::user()->role == "client"){
    return redirect()->to('/espace-client')->send();

}

@endphp
