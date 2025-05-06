<form action="{{ route('logout.admin') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-danger">Logout</button>
</form>
<div class="container text-center">
    <div class="username-container">
        <h2 class="username-typing">Weclcom, {{auth('admin')->user()->name}}
        </h2>
    </div>
<div>
    <a href="{{route('contents.create')}}">Create new content</a>
</div>
<div>
    <a href="{{route('category.index')}}">go to category</a>
</div>
<div class="row mt-3">
    <div class="col-12 align-self-center">
        <ul class="list-group">
            @foreach($contents as $content)
            <li class="list-group-item">
                <a href="{{ route('content.details', [$content->id]) }}" style="color: cornflowerblue">
                    {{ $content->tittle }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
</div>