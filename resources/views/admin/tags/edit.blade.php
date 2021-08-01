@extends('adminlte::page')

@section('title', 'Blog')

@section('content_header')
    <h1>Editar Etiqueta</h1>
@stop

@section('content')

        @if (session('info'))
            <div class="alert alert-success">
                <strong>{{session('info')}}</strong>
            </div>
        @endif

        {!! Form::model($tag,['route' => ['admin.tags.update',$tag], 'method' => 'put'])!!}
            
             @include('admin.tags.partials.from')

            {!! Form::submit('Actualizar Etiqueta', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}    

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="{{asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js')}}"> </script>    
    <script>
        $(document).ready( function() {
            $("#name").stringToSlug({
                setEvents: 'keyup keydown blur',
                getPut: '#slug',
                space: '-'
            });
        }); 
    </script>

@endsection