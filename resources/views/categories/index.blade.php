<div>
    <a href="{{route('category.create')}}">Create new category</a>
</div>
<div class="row mt-3">
    <div class="col-12 align-self-center">
        <ul class="list-group">
            @foreach($categories as $category)
            <li class="list-group-item">
                <a href="{{ route('category.details', [$category->id]) }}" style="color: cornflowerblue">
                    {{ $category->name }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>