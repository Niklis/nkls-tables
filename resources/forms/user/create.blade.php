<form wire:submit="store">
    <div class="form-group">
        <label for="avatar" class="p-1">Avatar</label>{{ $this->form->avatar }}
        <input type="file" class="form-control @error('form.avatar') is-invalid @enderror" id="avatar"
            wire:model.lazy="form.avatar">
        <div class="invalid-feedback">
            @error('form.avatar')
                {{ $message }}
            @enderror
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="p-1">Name</label>
        <input type="text"
            class="form-control @error('form.name') is-invalid @else @if ($this->form->name != '') is-valid @endif @enderror"
            id="name" placeholder="Enter name" wire:model.lazy="form.name">
        <div class="invalid-feedback">
            @error('form.name')
                {{ $message }}
            @enderror
        </div>
    </div>
    <div class="form-group">
        <label for="email" class="p-1">E-mail</label>
        <input type="text"
            class="form-control @error('form.email') is-invalid @else @if ($this->form->email != '') is-valid @endif @enderror"
            id="email" placeholder="Enter e-mail" wire:model.lazy="form.email">
        <div class="invalid-feedback">
            @error('form.email')
                {{ $message }}
            @enderror
        </div>
    </div>
    <div class="form-group">
        <label for="tel" class="p-1">Phone number</label>
        <input type="text"
            class="form-control @error('form.tel') is-invalid @else @if ($this->form->tel != '') is-valid @endif @enderror"
            id="tel" placeholder="Enter phone number" wire:model.lazy="form.tel">
        <div class="invalid-feedback">
            @error('form.tel')
                {{ $message }}
            @enderror
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-4" @if($errors->any()) disabled @endif>Save</button>
    <button type="button" wire:click="closeModal" class="btn btn-secondary mt-4" data-bs-dismiss="modal"
        aria-label="Close">Close</button>
</form>
