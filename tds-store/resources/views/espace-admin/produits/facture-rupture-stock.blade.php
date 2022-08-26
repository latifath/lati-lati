<div class="">
    <div id='rupture_stock'>
        <h3  class="text-center">Produits en rupture de stock</h3>
        <table class="table table-striped table-bordered dt-responsive nowrap " style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
            <thead>
            <tr>
                <th>N°</th>
                <th>Nom</th>
                <th>Quantite</th>
                <th>Prix</th>
                <th>Sous-catégorie</th>
            </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp


                <tr>
                    <td>{{ $i }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @php
                $i++;
            @endphp

            </tbody>
        </table>
    </div>
</div>

@section('js')
<script>
    function imprimer(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        window.location.reload();
    }
</script>
@endsection
