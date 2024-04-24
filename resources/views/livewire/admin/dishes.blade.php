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

                <div class="col-md-2">
                    <div class="form-group my-2">
                        <label for="">Precio:</label>
                        <input wire:model="price" type="text" class="form-control" placeholder="60.00">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group my-2">
                        <label for="">Categoria:</label>
                        <select wire:model="category_id" class="form-select">
                            @foreach ($categories as $category)
                                <option class="text-bg-dark" value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group my-2">
                        <label for="">Tipo producto:</label>
                        <select wire:model="type_id" class="form-select">
                            @foreach ($types as $type)
                                <option class="text-bg-dark" value="{{ $type->id }}">{{ $type->name }}</option>
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

                <div class="col-md-2">
                    <div class="form-group my-2">
                        <label for="">Precio:</label>
                        <input wire:model="price" type="text" class="form-control" placeholder="60.00">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group my-2">
                        <label for="">Categoria:</label>
                        <select wire:model="category_id" class="form-select">
                            @foreach ($categories as $category)
                                <option class="text-bg-dark" value="{{ $category->id }}">{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group my-2">
                        <label for="">Tipo producto:</label>
                        <select wire:model="type_id" class="form-select">
                            @foreach ($categories as $category)
                                <option class="text-bg-dark" value="{{ $category->id }}">{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group my-2">
                        <label for="">Foto:</label>
                        <img wire:model="photo" style="width: 75px" src="{{ $photo }}"
                            alt="{{ $photo }}">
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
    @foreach ($categories as $category)
        <div class="row gx-2">
            <div class="col-sm-12">
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="accordion" id="accordionSpecialTitle">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $category->id }}">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse{{ $category->id }}"
                                        aria-expanded="false" aria-controls="collapse{{ $category->id }}">
                                        <h5 class="m-0">{{ $category->name }}</h5>
                                    </button>
                                </h2>
                                <div id="collapse{{ $category->id }}" class="accordion-collapse collapse"
                                    aria-labelledby="heading{{ $category->id }}"
                                    data-bs-parent="#accordionSpecialTitle">
                                    <div class="accordion-body">
                                        <h5 class="mb-3 fw-light lh-lg">
                                            <strong class="fw-bold">producto.</strong>
                                            <ul>
                                                @foreach ($category->dishes as $producto)
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <li>{{ $producto->name }} - S/.{{ $producto->price }}</li>
                                                        </div>

                                                        <div>
                                                            <button class="btn btn-primary"
                                                                wire:click="edit({{ $producto->id }})">Editar</button>
                                                            <button class="btn btn-danger"
                                                                wire:click="delete({{ $producto->id }})">Eliminar</button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </ul>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


</div>
