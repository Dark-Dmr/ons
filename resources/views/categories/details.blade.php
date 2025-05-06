<div class="container">
    <h2>Category Details</h2>

    {{-- Display Mode --}}
    <div id="view-mode">
        <h4>name: {{ $categories->name }}</h4>

        <button class="btn btn-warning" onclick="toggleEdit(true)">Edit</button>
        <form action="{{ route('category.delete', $categories->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this content?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger mt-3">Delete</button>
        </form>
    </div>

    {{-- Edit Form (hidden by default) --}}
    <div id="edit-mode" style="display: none;">
        <form method="POST" action="{{ route('category.update', $categories->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>name</label>
                <input type="text" name="name" value="{{ $categories->name }}" class="form-control">
            </div>

            <button type="submit" class="btn btn-success mt-2">Save</button>
            <button type="button" class="btn btn-secondary mt-2" onclick="toggleEdit(false)">Cancel</button>
        </form>
    </div>
</div>

<script>
    function toggleEdit(show) {
        document.getElementById('view-mode').style.display = show ? 'none' : 'block';
        document.getElementById('edit-mode').style.display = show ? 'block' : 'none';
    }
</script>