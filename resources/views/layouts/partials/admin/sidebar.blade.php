<nav
        class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6"
      >
        <div
          class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto"
        >
          <button
            class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
            type="button"
            onclick="toggleNavbar('example-collapse-sidebar')"
          >
            <i class="fas fa-bars"></i>
          </button>
          @if (Route::has('dashboard'))
          <a
            class="hidden md:block text-left pb-2 text-e4a01b mr-0 break-words text-sm uppercase font-bold p-4 px-0"
            href="{{ url('dashboard') }}"
          >
            Sistem Pendukung Keputusan
          </a>
          @endif
          <ul class="md:hidden items-center flex flex-wrap list-none">
            <li class="inline-block relative">
              <a
                class="text-blueGray-500 block"
                href="#pablo"
                onclick="openDropdown(event,'user-responsive-dropdown')"
                ><div class="items-center flex">
                <a class="text-e4a01b block" href="#pablo" onclick="openDropdown(event,'user-responsive-dropdown')">
                    <div class="items-center flex">
                        <span class="w-14 h-14 text-sm font-semibold text-e4a01b inline-flex items-center justify-center">{{ Auth::user()->name }}</span>
                    </div>
                </a>
                <div class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48" id="user-responsive-dropdown">
                    <a href="#pablo" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Logout</a>
                    </form>
                </div>
                </div>
              </a>
            </li>
          </ul>
          <div
            class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded hidden"
            id="example-collapse-sidebar"
          >
            <div
              class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-blueGray-200"
            >
              <div class="flex flex-wrap">
                <div class="w-6/12">
                  <a
                    class="md:block text-left md:pb-2 text-e4a01b mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0"
                    href="../../index.html"
                  >
                    Sistem Pendukung Keputusan
                  </a>
                </div>
                <div class="w-6/12 flex justify-end">
                  <button
                    type="button"
                    class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                    onclick="toggleNavbar('example-collapse-sidebar')"
                  >
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </div>
            <form class="mt-6 mb-4 md:hidden">
              <div class="mb-3 pt-0">
                <input
                  type="text"
                  placeholder="Search"
                  class="border-0 px-3 py-2 h-12 border border-solid border-blueGray-500 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-base leading-snug shadow-none outline-none focus:outline-none w-full font-normal"
                />
              </div>
            </form>
            <!-- Divider -->
            <hr class="mt-0 mb-4 md:min-w-full" />
            <!-- Heading -->
            <h6
              class="md:min-w-full text-blueGray-500 text-xs uppercase font-bold block pt-1 pb-4 no-underline"
            >
              Admin Layout Pages
            </h6>
            <!-- Navigation -->

            <ul class="md:flex-col md:min-w-full flex flex-col list-none">
              <li class="items-center">
              @if (Route::has('dashboard'))
                <a
                  href="{{ url('dashboard') }}"
                  class="text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-e4a01b"
                >
                  <i class="fas fa-tv mr-2 text-sm opacity-75"></i>
                  Dashboard
                </a>
              @endif  
              </li>

              <li class="items-center">
              @if (Route::has('kriteria.index'))
                <a href="{{ url('kriteria') }}" class="text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-e4a01b">
                  <i class="fas fa-cogs mr-2 text-sm text-blueGray-300"></i>
                  Kriteria
                </a>
              @endif
              </li>

              <li class="items-center">
              @if (Route::has('alternatif.index'))
                <a href="{{ url('alternatif') }}" class="text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-e4a01b">
                  <i class="fas fa-list-alt mr-2 text-sm text-blueGray-300"></i>
                  Alternatif
                </a>
              @endif
              </li>


              <li class="items-center">
              @if (Route::has('penilaian.index'))
                <a href="{{ url('penilaian') }}" class="text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-e4a01b">
                  <i class="fas fa-poll-h mr-2 text-sm text-blueGray-300"></i>
                  Penilaian
                </a>
              @endif
              </li>

              <li class="items-center">
                <a href="javascript:void(0);" class="text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-e4a01b" onclick="openDropdown(event, 'calculation-dropdown')">
                  <i class="fas fa-calculator mr-2 text-sm text-blueGray-300"></i>
                  Perhitungan
                </a>
                <div class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48" id="calculation-dropdown">
                  @if (Route::has('aras'))
                  <a href="{{ url('aras') }}" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700 hover:text-e4a01b">
                    <i class="fas fa-chart-line mr-2 text-sm text-blueGray-300"></i>ARAS
                  </a>
                  @endif
                  @if (Route::has('codas'))
                  <a href="{{ url('codas') }}" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700 hover:text-e4a01b">
                    <i class="fas fa-calculator mr-2 text-sm text-blueGray-300"></i>CODAS
                  </a>
                  @endif
                  @if (Route::has('uji'))
                  <a href="{{ url('uji') }}" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700 hover:text-e4a01b">
                    <i class="fas fa-flask mr-2 text-sm text-blueGray-300"></i>Uji Sensitivitas
                  </a>
                  @endif
                </div>

              </li>
            </ul>

            <!-- Divider -->
            <hr class="my-4 md:min-w-full" />
          </div>
        </div>
      </nav>