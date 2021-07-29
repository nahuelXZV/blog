<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-6">
            @foreach ($posts as $post)
                <article >
                    
                    <img src="{{Storage::url($post->image->url)}}" alt="" class="w-full h-80 bg-cover bg-center @if($loop->first) md:col-span-2 @endif">
                    <div class="w-full h-full px-8 flex flex-col justify-center">
                        
                        <div>
                            @foreach ($post->tags as $tag)
                                <a href="" class="inline-block px-3 h-6 bg-{{$tag->color}}-600 text-black rounded-full">
                                    {{$tag->name}}
                                </a>
                            @endforeach    
                        </div>
                        <h1 class="text-4xl text-black leading-8 font-bold">
                            <a href="">
                                {{$post->name}}
                            </a>
                        </h1>

                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-4">
            {{$posts->links()}}
        </div>

    </div>
</x-app-layout>
