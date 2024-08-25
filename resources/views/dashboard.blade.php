@extends('layouts.main')
@section('content')

<div class="relative bg-e4a01b md:pt-32 pb-32 pt-12">
          <div class="px-4 md:px-10 mx-auto w-full">
            <div>
                <!-- <h1 class="font-semibold text-xl text-white">Kriteria</h1> -->
            </div>
          </div>
        </div>
<div class="px-4 md:px-10 mx-auto w-full -m-24">
  <div class="px-4 md:px-10 mx-auto w-full">
    <div>
      <!-- Card stats -->
      <div class="flex flex-wrap">
        <!-- Traffic Card -->
        <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
          <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
            <div class="flex-auto p-4">
              <div class="flex flex-wrap">
                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                  <h5 class="text-blueGray-400 uppercase font-bold text-xs">
                    Data Users
                  </h5>
                  <span class="font-semibold text-xl text-blueGray-700">
                    {{ $jumlahUsers }}
                  </span>
                </div>
                <div class="relative w-auto pl-4 flex-initial">
                  <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-red-500">
                    <i class="far fa-chart-bar"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- New Users Card -->
        <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
          <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
            <div class="flex-auto p-4">
              <div class="flex flex-wrap">
                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                  <h5 class="text-blueGray-400 uppercase font-bold text-xs">
                    Data Kriteria
                  </h5>
                  <span class="font-semibold text-xl text-blueGray-700">
                    {{ $jumlahKriteria }}
                  </span>
                </div>
                <div class="relative w-auto pl-4 flex-initial">
                  <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-orange-500">
                    <i class="fas fa-chart-pie"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Sales Card -->
        <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
          <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
            <div class="flex-auto p-4">
              <div class="flex flex-wrap">
                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                  <h5 class="text-blueGray-400 uppercase font-bold text-xs">
                    Data Alternatif
                  </h5>
                  <span class="font-semibold text-xl text-blueGray-700">
                    {{ $jumlahAlternatif }}
                  </span>
                </div>
                <div class="relative w-auto pl-4 flex-initial">
                  <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-fbb316">
                    <i class="fas fa-users"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Performance Card -->
        <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
          <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
            <div class="flex-auto p-4">
              <div class="flex flex-wrap">
                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                  <h5 class="text-blueGray-400 uppercase font-bold text-xs">
                    Data Penilaian
                  </h5>
                  <span class="font-semibold text-xl text-blueGray-700">
                    {{$jumlahPenilaian}}
                  </span>
                </div>
                <div class="relative w-auto pl-4 flex-initial">
                  <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-lightBlue-500">
                    <i class="fas fa-percent"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="px-4 md:px-10 mx-auto w-full -m-24">

</div>

@endsection
