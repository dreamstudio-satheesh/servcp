<div>
    <div class="row">

        <!-- User Form -->
        @if ($showForm)
            @include('livewire.partials.user-form')
        @else
            <!-- User List -->
            @include('livewire.partials.user-list')
        @endif


    </div>
</div>
