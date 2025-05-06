<form action="{{ route('store.category') }}" method="POST" class="mt-4 p-4">
    @csrf
    <div class="form-group m-3">
        <label for="name">category Title</label>
        <input type="text" class="form-control" name="name">
    </div>
    <div class="form-group m-3">
        <input type="submit" class="btn btn-primary float-end" value="Submit">
    </div>
</form>