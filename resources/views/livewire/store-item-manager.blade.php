<div>
    <div class="row">

        <!-- Store Item Form -->
        @if ($showForm)
            @include('livewire.partials.store-item-form')
        @else
            <!-- Store Item List -->
            @include('livewire.partials.store-item-list')
        @endif

    </div>
</div>