<div class="form-group">
    {!! Form::label('name', 'Nombre') !!}
    {!! Form::text('name', null, ['class' =>'form-control', 'placeholder' => 'Inserte el nombre del rol']) !!}
    @error('name')
        <span class="text-danger">{{$message}}</span>
    @enderror
</div>

<h2 class="h3">Lista de permisos</h2>

@foreach ($permissions as $permission)
    <div>
        <label for="">
            {!! Form::checkbox('permissions[]', $permission->id, null, ['class' => 'mr-1']) !!}
            {{$permission->description}}
        </label>
    </div>
     
@endforeach