<div class="w-full md:w-1/4 bg-gray-400 p-4 text-center text-gray-700">
    <ul>
        @if(Auth::user()->can('list-post'))
            <li>
                <a href="{{route('posts')}}">
                    Posts
                </a>
            </li>
        @endif
    </ul>
</div>