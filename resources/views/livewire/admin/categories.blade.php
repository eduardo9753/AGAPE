<div>
    <!-- FORMULARIO PARA CREAR UN PRODUCTO -->
    @if (!$category_id)
    <form wire:submit.prevent="create">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group my-2">
                    <label for="">Nombre:</label>
                    <input wire:model="name" type="text" class="form-control" placeholder="Ingrese el nombre de la categoria">
                    @error('name')
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
     @if ($category_id)
     <form wire:submit.prevent="update">
         <div class="row">
             <div class="col-md-12">
                 <div class="form-group my-2">
                     <label for="">Nombre:</label>
                     <input wire:model="name" type="text" class="form-control" placeholder="Ingrese el nombre">
                     @error('name')
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
                    <th>id</th>
                    <th>categoria</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <button class="btn btn-primary" wire:click="edit({{ $category->id }})">Editar</button>
                            <button class="btn btn-danger" wire:click="delete({{ $category->id }})">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>



</div>

