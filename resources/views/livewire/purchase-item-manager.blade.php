<div>
    <div class="row">
        @if ($showForm)
            <!-- Load the Purchase Item Form Component -->
            <livewire:purchase-item-form :purchase-item-id="$purchaseItemId" />
        @else
            <!-- Load the Purchase Item List Component -->
            <livewire:purchase-item-list />
        @endif
    </div>
</div>

