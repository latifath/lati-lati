@section('partenaire')
    <!-- Vendor Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
                    @foreach (partenaires_logo() as $pl)
                        <div class="vendor-item border p-4">
                            <img src="{{ asset(path_image_partenaire() . path_image($pl->image)->filename) }}" alt="" width="60" height="100">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor End -->
@endsection
