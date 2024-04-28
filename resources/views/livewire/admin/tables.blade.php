<div>
    <!-- FORMULARIO PARA CREAR UN PRODUCTO -->
    @if (!$table_id)
        <form wire:submit.prevent="create">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group my-2">
                        <label for="">Nombre:</label>
                        <input wire:model="name" type="text" class="form-control" placeholder="Ingrese el nombre">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group my-2">
                        <label for="">Ubicación:</label>
                        <input wire:model="location" type="text" class="form-control" placeholder="Ingrese el piso">
                        @error('location')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group my-2">
                        <label for="">Estado:</label>
                        <select wire:model="state" class="form-select">
                            <option class="text-bg-dark" value="ACTIVO">ACTIVO</option>
                            <option class="text-bg-dark" value="INACTIVO">INACTIVO</option>
                            <option class="text-bg-dark" value="PRECUENTA">PRECUENTA</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-2">Crear</button>
        </form>
    @endif
    <!-- FORMULARIO PARA CREAR UN PRODUCTO -->


    <!-- FORMULARIO PARA ACTUALIZAR UN PRODUCTO -->
    @if ($table_id)
        <form wire:submit.prevent="update">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group my-2">
                        <label for="">Nombre:</label>
                        <input wire:model="name" type="text" class="form-control" placeholder="Ingrese el nombre">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group my-2">
                        <label for="">Ubicación:</label>
                        <input wire:model="location" type="text" class="form-control" placeholder="Ingrese el piso">
                        @error('location')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group my-2">
                        <label for="">Estado:</label>
                        <select wire:model="state" class="form-select">
                            <option class="text-bg-dark" value="ACTIVO">ACTIVO</option>
                            <option class="text-bg-dark" value="INACTIVO">INACTIVO</option>
                            <option class="text-bg-dark" value="PRECUENTA">PRECUENTA</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-2">Actualizar</button>
        </form>
    @endif
    <!-- FORMULARIO PARA ACTUALIZAR UN PRODUCTO -->


    {{-- TABLA DE DATOS --}}
    <div class="table-responsive mt-4">
        <table class="table table-striped table-bordered align-middle m-0">
            <thead>
                <tr>
                    <th>id</th>
                    <th>mesa</th>
                    <th>ubicación</th>
                    <th>estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tables as $table)
                    <tr>
                        <td>{{ $table->id }}</td>
                        <td>{{ $table->name }}</td>
                        <td>{{ $table->location }}</td>
                        <td>{{ $table->state }}</td>
                        <td>
                            <button class="btn btn-primary" wire:click="edit({{ $table->id }})">Editar</button>
                            <button class="btn btn-danger" wire:click="delete({{ $table->id }})">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>



</div>
