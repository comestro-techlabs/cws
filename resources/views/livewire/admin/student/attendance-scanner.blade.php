<div class="container">
    <h2>Scan Student Barcode</h2>

    <input type="text" wire:model="barcode" wire:keydown.enter="scanBarcode" class="form-control" placeholder="Scan Barcode">
    <button wire:click="scanBarcode" class="btn btn-primary mt-2">Submit</button>

    @if($message)
        <div class="alert alert-info mt-2">{{ $message }}</div>
    @endif

    @if($student)
        <div class="card mt-3">
            <div class="card-body">
                <h4 class="card-title">Student Details</h4>
                <p><strong>Name:</strong> {{ $student->name }}</p>
                <p><strong>Email:</strong> {{ $student->email }}</p>
                <p><strong>Barcode:</strong> {{ $student->barcode }}</p>
            </div>
        </div>
    @endif
</div>
