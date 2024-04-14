<div>
    <!-- FORMULARIO PARA CREAR UN PRODUCTO -->
    @if (!$dish_id)
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
                        <label for="">Precio:</label>
                        <input wire:model="price" type="text" class="form-control" placeholder="Ingrese el nombre">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group my-2">
                        <label for="">Categoria:</label>
                        <select wire:model="category_id" class="form-select">
                            @foreach ($categories as $category)
                                <option class="text-bg-dark" value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group my-2">
                        <label for="">Foto:</label>
                        <img wire:model="photo" style="width: 75px" src="{{ $photo }}" alt="{{ $photo }}">
                    </div>
                </div>

                <div class="col-md-10">
                    <div class="form-group my-2">
                        <label for="">Descripcion:</label>
                        <textarea wire:model="description" class="form-control" rows="2"></textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-2">Crear</button>
        </form>
    @endif
    <!-- FORMULARIO PARA CREAR UN PRODUCTO -->


    <!-- FORMULARIO PARA ACTUALIZAR UN PRODUCTO -->
    @if ($dish_id)
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
                        <label for="">Precio:</label>
                        <input wire:model="price" type="text" class="form-control" placeholder="Ingrese el nombre">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group my-2">
                        <label for="">Categoria:</label>
                        <select wire:model="category_id" class="form-select">
                            @foreach ($categories as $category)
                                <option class="text-bg-dark" value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group my-2">
                        <label for="">Foto:</label>
                        <img wire:model="photo" style="width: 75px" src="{{ $photo }}" alt="{{ $photo }}">
                    </div>
                </div>

                <div class="col-md-10">
                    <div class="form-group my-2">
                        <label for="">Descripcion:</label>
                        <textarea wire:model="description" class="form-control" rows="2"></textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Categoria</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dishes as $dish)
                    <tr>
                        <td>{{ $dish->name }}</td>
                        <td>{{ $dish->price }}</td>
                        <td>{{ $dish->category->name }}</td>
                        <td>
                            <button class="btn btn-primary" wire:click="edit({{ $dish->id }})">Editar</button>
                            <button class="btn btn-danger" wire:click="delete({{ $dish->id }})">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>



</div>
