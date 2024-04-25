<div>
    <form wire:submit.prevent="create">
        <div class="create-invoice-wrapper">
            <!-- Row start -->
            <div class="row">

                <div class="col-md-3 col-12">
                    <div class="mb-3">
                        <label for="" class="form-label">Mesa</label>
                        <div class="input-group">
                            <input type="text" class="form-control" wire:model="table_id">
                            <span class="input-group-text">
                                <i class="icon-calendar"></i>
                            </span>
                        </div>
                        @error('table_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3 col-12">
                    <div class="mb-3">
                        <label for="" class="form-label">Categorias</label>
                        <div class="input-group">
                            <select wire:model="category_id" wire:change="filterProductsByCategory" class="form-select">
                                <option value="" class="text-bg-dark">Seleccionar categoría</option>
                                @foreach ($categories as $category)
                                    <option value=" {{ $category->id }}" class="text-bg-dark">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="input-group-text">
                                <i class="icon-calendar"></i>
                            </span>
                        </div>
                        @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3 col-12">
                    <div class="mb-3">
                        <label for="" class="form-label">Producto</label>
                        <div class="input-group">
                            <select wire:model="product_id" class="form-select">
                                <option value="" class="text-bg-dark">Seleccionar producto</option>
                                @if ($products->count() > 0)
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}" class="text-bg-dark">{{ $product->name }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="" disabled>No hay productos disponibles</option>
                                @endif
                            </select>
                            <span class="input-group-text">
                                <i class="icon-calendar"></i>
                            </span>
                        </div>
                        @error('product_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-sm-2 col-12">
                    <div class="mb-3">
                        <label for="" class="form-label">Agregar</label>
                        <button type="submit" class="btn btn-primary w-100">
                            añadir
                        </button>
                    </div>
                </div>
            </div>
            <!-- Row end -->
        </div>
    </form>

    <!-- Row start -->
    <div class="row">
        <div class="col-12">
            <div class="table-responsive w-100">
                <table class="table table-striped table-bordered align-middle m-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>
                                <div class="d-flex align-items-center">
                                    <span class="icon-add_task me-2 fs-4"></span>
                                    Plato
                                </div>
                            </th>
                            <th>
                                <div class="d-flex align-items-center">
                                    <span class="icon-published_with_changes me-2 fs-4"></span>
                                    Cantidad
                                </div>
                            </th>
                            <th>
                                <div class="d-flex align-items-center">
                                    <span class="icon-playlist_add_check me-2 fs-4"></span>
                                    Precio
                                </div>
                            </th>
                            <th>
                                <div class="d-flex align-items-center">
                                    <span class="icon-calendar me-2 fs-4"></span>
                                    Monto
                                </div>
                            </th>
                            <th>
                                <div class="d-flex align-items-center">
                                    <span class="icon-settings me-2 fs-4"></span>
                                    Acciones
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderDetails as $key => $detail)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <input type="text" class="form-control" value="{{ $detail->dish->name }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control" value="{{ $detail->quantity }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control" value="{{ $detail->dish->price }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control"
                                        value="{{ $detail->quantity * $detail->dish->price }}">
                                </td>
                                <td>
                                    <button class="btn btn-primary" wire:click="plus({{ $detail->id }})"><span
                                            class="icon-plus"></span></button>
                                    <button class="btn btn-secondary" wire:click="minus({{ $detail->id }})"><span
                                            class="icon-minus"></span></button>
                                    <button class="btn btn-danger" wire:click="trash({{ $detail->id }})"><span
                                            class="icon-trash"></span></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if (session()->has('message'))
                    <div class="alert border border-info alert-dismissible fade show" role="alert">
                        <b>Info!</b> {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Row end -->

    <div class="col-12">
        <div class="d-flex justify-content-between mt-3">
            <div class="d-flex align-items-center gap-2">
                <label for="" class="">TOTAL: </label>
                <input type="text" class="form-control" value="{{ $totalAmount }}">
            </div>
        </div>
    </div>
</div>
