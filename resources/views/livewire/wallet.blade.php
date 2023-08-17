<div>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-4 mt-5">
            <div class="col-md-12">
                @include('livewire.create')
            </div>
            <div class="col-md-12 mt-4">
                @include('livewire.amount')
            </div>
        </div>
        <div class="col-md-8 mt-5">
            @include('livewire.list')
        </div>
    </div>

</div>
