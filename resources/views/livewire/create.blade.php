<form>
    <div class="form-group">
        <label for="exampleFormControlInput1">Fullname:</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Fullname" wire:model="full_name" required>
        @error('full_name') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Fullname:</label>
        <select type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Fullname" wire:model="type">
            <option value='deposit'>Deposit</option>
            <option value='withdrawal'>Withdrawal</option>
        </select>
        @error('type') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Order ID:</label>
        <input type="text" class="form-control" id="exampleFormControlInput2" placeholder="Enter Order ID" wire:model="order_id" required>
        @error('order_id') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput2">Amount:</label>
        <input type="number" class="form-control" min='1' id="exampleFormControlInput3" placeholder="Enter Amount" wire:model="amount" required>
        @error('amount') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <br>
    <button wire:click.prevent="store()" class="btn btn-success">Save</button>
</form>
