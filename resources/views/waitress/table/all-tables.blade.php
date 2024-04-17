<div class="row">
    @foreach ($tables as $table)
        <div class="col-sm-4 col-6">
            <div class="card px-3 py-2 mb-2 d-flex flex-row align-items-center">
                <div class="position-relative shape-block">
                    <img src="{{ asset('assets/images/shape1.png') }}" class="img-fluid img-4x" alt="Bootstrap Themes" />
                    <i class="icon-book-open"></i>
                </div>
                <div class="ms-2">
                    <h3 class="m-0 fw-semibold">{{ $table->name }}</h3>
                    @if ($table->state == 'ACTIVO')
                        <h6 class="badge bg-primary">{{ $table->state }}</h6>
                    @else
                        <h6 class="badge bg-danger">{{ $table->state }}</h6>
                    @endif

                </div>
            </div>
        </div>
    @endforeach
</div>
