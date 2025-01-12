<div>
    <h2>WhatsApp Templates</h2>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="save">
        <div class="mb-3">
            <label for="name" class="form-label">Template Name</label>
            <input type="text" id="name" wire:model="name" class="form-control">
        </div>
        <div class="mb-3">
            <label for="template" class="form-label">Template</label>
            <textarea id="template" wire:model="template" class="form-control" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save Template</button>
    </form>

    <h3 class="mt-5">Existing Templates</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Template</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($templates as $template)
                <tr>
                    <td>{{ $template->name }}</td>
                    <td>{{ $template->template }}</td>
                    <td>
                        <button wire:click="edit({{ $template->id }})" class="btn btn-sm btn-warning">Edit</button>
                        <button wire:click="delete({{ $template->id }})" class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
