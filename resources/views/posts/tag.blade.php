<x-app-layout>
    <div class="container py-8">
        <h1 class="uppercase text-center text-4xl font-bold mb-2 py-2">Etiqueta: {{$tag->name}}</h1>

        @foreach ($posts as $post)
            <x-card-post :post="$post"/>
        @endforeach

        <div class="mt-4">
            {{$posts->links()}}
        </div>
    </div>
</x-app-layout>