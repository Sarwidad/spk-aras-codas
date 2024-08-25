    <nav class="absolute top-0 left-0 w-full z-10 bg-white md:flex-row md:flex-nowrap md:justify-start flex items-center p-4 border-b-2">
        <div class="w-full mx-auto items-center flex justify-between md:flex-nowrap flex-wrap md:px-10 px-4">
            <!-- Branding or Dashboard link -->
            <!-- <a class="text-white text-sm uppercase hidden lg:inline-block font-semibold" href="./index.html">Dashboard</a> -->

            <!-- Search bar -->
            <form class="md:flex hidden flex-row flex-wrap items-center lg:ml-auto mr-3">
                <div class="relative flex w-full flex-wrap items-stretch">
                    <span class="z-10 h-full leading-snug font-normal absolute text-center text-blueGray-500 bg-transparent rounded-lg text-base items-center justify-center w-8 pl-3 py-3">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" placeholder="Search here..." class="border-0 px-3 py-3 placeholder-blueGray-500 text-blueGray-500 relative bg-white rounded text-sm shadow outline-none focus:outline-none focus:ring w-full pl-10" />
                </div>
            </form>

            <!-- User dropdown -->
            <ul
              class="flex-col md:flex-row list-none items-center hidden md:flex"
            >
              <a
                class="text-blueGray-500 block"
                href="#pablo"
                onclick="openDropdown(event,'user-dropdown')"
              >
                <div class="items-center flex">
                  <span
                    class="w-14 h-14 text-sm font-semibold text-e4a01b inline-flex items-center justify-center"
                    >{{ Auth::user()->name }}</span>
                </div>
              </a>
                <div class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48" id="user-dropdown">
                    @if (Route::has('profile'))
                    <a href="{{ url('profile') }}" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Profile</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Logout</a>
                    </form>
                </div>
            </ul>
        </div>
    </nav>
