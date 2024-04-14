<div class="form-group mb-3">
    {!! Form::label('name', 'Nombre del rol', ['class' => 'mb-2']) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Escriba el nombre']) !!}

    @error('name')
        <span class="text-danger"><strong>{{ $message }}</strong></span>
    @enderror
</div>

<div class="form-group">
    <strong>Permisos</strong>
    <br>
    @error('permissions')
        <span class="text-danger"><strong>{{ $message }}</strong></span>
    @enderror

    @foreach ($permissions as $permission)
        <div>
            <label>
                {!! Form::checkbox('permissions[]', $permission->id, null, ['class' => 'mr-1']) !!}
                {{ $permission->name }}
            </label>
        </div>
    @endforeach
</div>
