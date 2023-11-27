<div class="modal-header">
    @if ($action != '')
        <h5 class="modal-title">{{ ucfirst($action) . ' ' . $this->getEntityName() }}</h5>
    @endif
    <button type="button" wire:click="closeModal" class="btn-close" data-bs-dismiss="modal"
        aria-label="Close"></button>
</div>
<div class="modal-body">
    @if ($action == 'create' || $action == 'edit')
        @include('nkls::forms.' . $this->getEntityName() . '.' . $action)
    @endif
</div>