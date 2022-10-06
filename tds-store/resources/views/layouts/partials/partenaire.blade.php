@foreach (partenaires_logo() as $pl)
@if($pl == null)
@else
   @section('partenaire')
        <!-- Vendor Start -->
        <div class="container-fluid py-5">
            <div class="row px-xl-5">
                <div class="col">
                    <div class="owl-carousel vendor-carousel">
                        @foreach (partenaires_logo() as $pl)
                            <div class="vendor-item border p-4">
                                <img src="{{ path_image($pl->image) ? asset(path_image_partenaire() . path_image($pl->image)->filename) : '' }}" alt="" width="50" height="90">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- Vendor End -->
    @endsection
 @endif
@endforeach
