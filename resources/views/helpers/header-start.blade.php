  <!-- App header starts -->
  <div class="app-header d-flex align-items-center">

      <!-- Container starts -->
      <div class="container">

          <!-- Row starts -->
          <div class="row">
              <div class="col-md-3 col-2">

                  <!-- App brand starts -->
                  <div class="app-brand">
                      <a href="#" class="d-lg-block d-none">
                          <img src="{{ asset('img/logo.png') }}" class="logo" alt="Bootstrap Gallery" />
                      </a>
                      <a href="#" class="d-lg-none d-md-block">
                          <img src="{{ asset('img/logo.png') }}" class="logo" alt="Bootstrap Gallery" />
                      </a>
                  </div>
                  <!-- App brand ends -->

              </div>

              <div class="col-md-9 col-10">
                  <!-- App header actions start -->
                  <div class="header-actions d-flex align-items-center justify-content-end">

                      <!-- Search container start -->
                      <div class="search-container d-none d-lg-block">
                          <input type="text" class="form-control" placeholder="Search" />
                          <i class="icon-search"></i>
                      </div>
                      <!-- Search container end -->


                      {{-- <div class="dropdown d-sm-block d-none">
                          <a class="dropdown-toggle d-flex p-3 position-relative" href="#!" role="button"
                              data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="icon-mail fs-4 lh-1"></i>
                              <span class="count rounded-circle bg-danger">1</span>
                          </a>
                          <div class="dropdown-menu dropdown-menu-end dropdown-menu-md shadow-sm">
                              <h5 class="fw-semibold px-3 py-2 m-0">Messages</h5>
                              <a href="javascript:void(0)" class="dropdown-item">
                                  <div class="d-flex align-items-start py-2">
                                      <div class="p-3 bg-danger rounded-circle me-3">
                                          MS
                                      </div>
                                      <div class="m-0">
                                          <h6 class="mb-1 fw-semibold">Moory Sammy</h6>
                                          <p class="mb-1">Sent a mail.</p>
                                          <p class="small m-0 opacity-50">3 Mins Ago</p>
                                      </div>
                                  </div>
                              </a>

                              <div class="d-grid p-3 border-top">
                                  <a href="javascript:void(0)" class="btn btn-outline-primary">View all</a>
                              </div>
                          </div>
                      </div>
                      <div class="dropdown d-sm-block d-none">
                          <a class="dropdown-toggle d-flex p-3 position-relative" href="#!" role="button"
                              data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="icon-twitch fs-4 lh-1"></i>
                              <span class="count rounded-circle bg-danger">1</span>
                          </a>
                          <div class="dropdown-menu dropdown-menu-end dropdown-menu-md shadow-sm">
                              <h5 class="fw-semibold px-3 py-2 m-0">Notifications</h5>
                              <a href="javascript:void(0)" class="dropdown-item">
                                  <div class="d-flex align-items-start py-2">
                                      <img src="{{ asset('assets/images/user.png') }}" class="img-3x me-3 rounded-3"
                                          alt="Admin Themes" />
                                      <div class="m-0">
                                          <h6 class="mb-1 fw-semibold">Sophie Michiels</h6>
                                          <p class="mb-1">Membership has been ended.</p>
                                          <p class="small m-0 opacity-50">Today, 07:30pm</p>
                                      </div>
                                  </div>
                              </a>

                              <div class="d-grid p-3 border-top">
                                  <a href="javascript:void(0)" class="btn btn-outline-primary">View all</a>
                              </div>
                          </div>
                      </div> --}}
                      <div class="dropdown ms-2">
                          <a class="dropdown-toggle d-flex align-items-center user-settings" href="#!"
                              role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              <span class="d-none d-md-block">{{ auth()->user()->name }}</span>
                              <img src="https://cdn-icons-png.flaticon.com/512/3126/3126589.png"
                                  class="img-3x m-2 me-0 rounded-5" alt="Bootstrap Gallery" />
                          </a>
                          <div class="dropdown-menu dropdown-menu-end dropdown-menu-sm shadow-sm gap-3" style="">
                              {{--<a class="dropdown-item d-flex align-items-center py-2"><i
                                      class="icon-smile fs-4 me-3"></i>User
                                  Profile</a>
                              <a class="dropdown-item d-flex align-items-center py-2"><i
                                      class="icon-settings fs-4 me-3"></i>Configuraciones</a>--}}

                              <form action="{{ route('logout') }}" class="dropdown-item d-flex align-items-center py-2"
                                  method="POST">
                                  @csrf
                                  <button class="btn btn-outline-danger w-100" type="submit"><i
                                          class="icon-log-out fs-4 me-3"></i>Salir</button>
                              </form>
                          </div>
                      </div>

                      <!-- Toggle Menu starts -->
                      <button class="btn btn-success btn-sm ms-3 d-lg-none d-md-block" type="button"
                          data-bs-toggle="offcanvas" data-bs-target="#MobileMenu">
                          <i class="icon-menu"></i>
                      </button>
                      <!-- Toggle Menu ends -->

                  </div>
                  <!-- App header actions end -->

              </div>
          </div>
          <!-- Row ends -->

      </div>
      <!-- Container ends -->

  </div>
  <!-- App header ends -->
