<div>
    <h2>WhatsApp Settings</h2>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="save">
        @foreach ($settings as $key => $value)
            <div class="mb-3">
                <label for="{{ $key }}" class="form-label">{{ ucwords(str_replace('_', ' ', $key)) }}</label>
                <input type="text" id="{{ $key }}" wire:model="settings.{{ $key }}" class="form-control">
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Save Settings</button>
    </form>
</div>
