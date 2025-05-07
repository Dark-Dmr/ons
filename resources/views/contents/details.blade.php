<div class="container">
    <h2>Content Details</h2>

    {{-- Display Mode --}}
    <div id="view-mode">
        <h4>title: {{ $contents->tittle }}</h4>
        <p>{{ $contents->text }}</p>

        <button class="btn btn-warning" onclick="toggleEdit(true)">Edit</button>
        <form action="{{ route('content.delete', $contents->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this content?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger mt-3">Delete</button>
        </form>
    </div>

    {{-- Edit Form (hidden by default) --}}
    <div id="edit-mode" style="display: none;">
        <form method="POST" action="{{ route('content.update', $contents->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>title</label>
                <input type="text" name="tittle" value="{{ $contents->tittle }}" class="form-control">
            </div>

            <div class="form-group">
                <label>Text</label>
                <textarea name="text" class="form-control" rows="4">{{ $contents->text }}</textarea>
            </div>

            <label>Select Categories:</label>
            <div>
                @foreach ($categories as $category)
                    <div>
                        <label>
                            <input type="checkbox" name="categories_id[]" value="{{ $category->id }}"
                                {{ in_array($category->id, $contents->categories->pluck('id')->toArray()) ? 'checked' : '' }}>
                            {{ $category->name }}
                        </label>
                    </div>
                @endforeach
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