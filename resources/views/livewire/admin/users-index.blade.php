<div>
    <div class="card">

        <div class="card-header">
            <input wire:model = 'search' class="form-control" placeholder="Ingrese el nombre o correo de un usuario">
        </div>

        
        @if($users->count())
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th>{{$user->id}}</th>
                            <th>{{$user->name}}</th>
                            <th>{{$user->email}}</th>
                            <th width = '10px' >
                                <a  class="btn btn-primary" href="{{route('admin.users.edit',$user)}}">Editar</a>    
                            </th>    
                        </tr>    

                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="card-footer">
            {{$users->links()}}
        </div>

        @else
        <div class="card-body">
            <strong>No hay registros</strong>
        </div>
        @endif
    </div>
</div>
