<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts List') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex md:flex-row-reverse flex-wrap">
                	@if(Auth::user()->can('create-post'))
            			<a href="{{route('posts.create')}}" class="shadow bg-green-500 hover:bg-green-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
            			Create Post</a>
            		@endif
                    <div class="w-full md:w-4/4 p-4 text-center">
                		@include('include.alerts')
                		<form action="{{route('posts')}}" method="GET">
	                		<div class="flex flex-wrap -mx-3 mb-2">
	                    		<div class="w-full md:w-2/3 px-3 mb-6 md:mb-0">
	                				<input type="text" name="search" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" placeholder="Filter by tags" value="{{$_GET['search']??''}}">
	                			</div>
	                    		<div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
			        				<button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
			        					Search
			        				</button>
	                			</div>
                		</form>
                        <table class="table-auto">
                    		<thead>
                    			<tr>
                    				<td colspan="5">
	                    				{{$posts->appends(['search' => $_GET['search']??''])->links()}}
	                    			</td>
                    			</tr>
                    			<tr>
                    				<th class="px-4 py-2">Image</th>
                    				<th class="px-4 py-2">Title</th>
                    				<th class="px-4 py-2">Author</th>
                    				<th class="px-4 py-2">Tags</th>
                    				<th class="px-4 py-2">Action</th>
                    			</tr>
                    		</thead>
                    		<tbody>
                    			@if($posts)
                    				@php
                    					if(isset($_GET['search']) && !empty($_GET['search'])) {
                    						$posts = $posts->pluck('posts');
	                    				}
                    				@endphp
                    				@foreach($posts as $post)
		                    			<tr>
		                    				<td class="border px-4 py-2">
		                    					@if(empty($post->featured_image))
		                    						Image Not Found
		                    					@else
			                    					<a href="{{route('posts.show', $post->slug)}}">
			                    						<img src="{{asset($post->featured_image)}}" alt="{{$post->name}}" style="width: 150px; height: 150px;">
			                    					</a>
		                    					@endif
		                    				</td>
		                    				<td class="border px-4 py-2">{{$post->title}}</td>
		                    				<td class="border px-4 py-2">{{$post->user->name}}</td>
		                    				<td class="border px-4 py-2">{{$post->tags->pluck('name')->implode(", ")}}</td>
		                    				<td class="border px-4 py-2">
		                    					@if(Auth::user()->can('update-post'))
		                    						<a href="{{route('posts.edit', $post->id)}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">Edit</a>
		                    					@endif
		                    					@if(Auth::user()->can('delete-post'))
		                    						<form action="{{route('posts.destroy', $post->id)}}" method="POST">
		                    							@csrf
		                    							@method('DELETE')
		                    							<button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 border border-red-700 rounded">Delete</a>
		                    						</form>
		                    					@endif
		                    				</td>
		                    			</tr>
                    				@endforeach
                    			@endif
                    		</tbody>
                    	</table>
                    </div>
                </div>
                <!-- <x-jet-welcome /> -->
            </div>
        </div>
    </div>
</x-app-layout>
