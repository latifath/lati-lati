<div class="modal fade" id="DeleteModalCenter" aria-labelledby="DeleteModalCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Suppression </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ $route }}"  method="POST">
                @csrf
                @method('delete')
                <div class="modal-body">
                    <input  class="form-control"  type="hidden" id="item_id" placeholder="" name="id" >
                    <h5 class="text-center">Etes-vous sûr de vouloir supprimer {{ $nom }}?</h5>
                </div>
                <div class="modal-footer" style="display:block;">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Non</button>
                    <button type="submit" class="btn btn-danger float-right">Oui, Supprimer</button>
                </div>
            </form>
       </div>
    </div>
</div>
