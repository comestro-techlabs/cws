<div>
    <input type="text" wire:model="barcode" wire:keydown.enter="scanBarcode" class="form-control" placeholder="Scan Barcode">
    <button wire:click="scanBarcode" class="btn btn-primary mt-2">Submit</button>

    @if(session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
</div>

