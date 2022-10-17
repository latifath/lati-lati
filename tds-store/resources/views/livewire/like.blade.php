<div>
    <button class="btn" wire:click='addLike'>
        <svg xmlns="http://www.w3.org/2000/svg" width="33" height="25" fill="{{ $produit->isLiked() ? '#ea0513' : '#fff' }}" class="bi bi-heart-fill" viewBox="0 0 18 18" stroke="#000">
            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
        </svg>
    </button>
</div>
