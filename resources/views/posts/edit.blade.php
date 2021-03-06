<x-app-layout>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex md:flex-row-reverse flex-wrap">
                    <div class="w-full md:w-4/4 p-4 text-center">
                        <form class="w-full" method="POST" action="{{route('posts.update', $post->id)}}" enctype="multipart/form-data">
                    		@csrf
                    		@method('PATCH')
                    		<div class="flex flex-wrap -mx-3 mb-6">
                    			<div class="w-full px-3 mb-6 md:mb-0">
                    				<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    					Post Title
                    				</label>
                    				<input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="Post Name" name="title" value="{{$post->title}}">
                    				@error('title')
                    					<p class="text-red-700">{{$message}}</p>
                    				@enderror
                    			</div>
                    		</div>
                    		<div class="flex flex-wrap -mx-3 mb-6">
                    			<div class="w-full px-3">
                    				<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                    					Post Description
                    				</label>
                    				<textarea name="description" cols="30" rows="10" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">{{$post->description}}</textarea>
                    				@error('description')
                    					<p class="text-red-700">{{$message}}</p>
                    				@enderror
                    			</div>
                    		</div>
                    		<div class="flex flex-wrap -mx-3 mb-2">
                    			<div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    				<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="image">
                    					Image
                    				</label>
                    				@if($post->featured_image)
                    					<img src="{{asset($post->featured_image)}}" alt="{{$post->name}}" style="width: 150px; height: 150px;">
                    					<a href="javascript:void(0)" class="delete-image" data-destroyimage="{{ route('delete-post-image', $post->id) }}">
											<button class="shadow bg-red-500 hover:bg-red-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
					        					Delete
					        				</button>
										</a>
                    				@else
                    				<input id="image" name="image" type="file">
                    				@endif
                    			</div>
                    			<div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    				<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="image">
                    					Tags
                    				</label>
                    				<select class="form-control js-example-tags w-full" name="tags[]" multiple="multiple">
                    					@if($tags)
	                    					@foreach($tags as $tag)
	                    						<option value="{{$tag->name}}" selected="selected">{{$tag->name}}</option>
	                    					@endforeach
                    					@endif
									</select>
                    			</div>
                    		</div>
                    		<div class="md:flex md:items-center">
                    			<div class="md:w-2/3">
                    				<button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                    					Submit
                    				</button>
                    			</div>
                    		</div>
                    	</form>
                    </div>
                </div>
                <!-- <x-jet-welcome /> -->
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script type="text/javascript">
    	$(".js-example-tags").select2({
			tags: true
		});
		$("body").on("click",".delete-image",function(){
    		console.log('clicked');
    		let url = $(this).data('destroyimage');
    		console.log(url);
    		let that = this;
    		if(confirm('Really want to delete this image?')) {
	    		$.post(url, {'_method': 'DELETE'}, function(result) {
	    			if (result == 1) {
	    				location.reload();
	    			} else {
	    				alert('Something went wrong!!');
	    			}
	    		});
	    	}
    	});
    </script>
</x-app-layout>
