<x-app-layout>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Post') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex md:flex-row-reverse flex-wrap">
                    <div class="w-full md:w-4/4 p-4">
                        <h1 class="text-xl font-bold mb-2">{{$post->title}}</h1><small>Created At :- {{$post->created_at}}</small>

                        <img src="{{asset($post->featured_image)}}" alt="{{$post->name}}">
                        <pre>{{$post->description}}</pre>
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
    </script>
</x-app-layout>
