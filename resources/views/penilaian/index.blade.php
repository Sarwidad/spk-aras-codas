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
  <div class="flex flex-wrap justify-center">
    <div class="w-full lg:w-8/12 px-4">
      <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
        <div class="rounded-t bg-white mb-0 px-6 py-6">
          <div class="text-center flex justify-center">
            <h6 class="text-blueGray-700 text-xl font-bold">
              Tambah Penilaian
            </h6>
          </div>
        </div>
        <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
          <form method="POST" action="{{ route('penilaian.store') }}">
            @csrf
            <div class="flex flex-wrap">
              <div class="w-full lg:w-12/12 px-4">
                <div class="relative w-full mb-3">
                  <label class="block uppercase text-blueGray-600 text-xs font-bold my-4" for="alternatif_id">
                      Alternatif
                  </label>
                  <select id="alternatif_id" name="alternatif_id"
                      class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                      <option value="" disabled selected>Pilih lokasi</option>
                      @foreach ($alternatifs as $alternatif)
                      <option value="{{ $alternatif->id }}">{{ $alternatif->nama }}</option>
                      @endforeach
                  </select>
                </div>
                @foreach ($kriterias as $kriteria)
                <div class="relative w-full mb-3">
                  <label class="block uppercase text-blueGray-600 text-xs font-bold my-4" for="nilai_{{ $kriteria->id }}">
                    Kriteria: {{ $kriteria->nama }}
                  </label>
                  <select id="nilai_{{ $kriteria->id }}" name="nilai[{{ $kriteria->id }}]"
                      class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                    <option value="" disabled selected>Pilih Nilai</option>
                    <option value="5">Sangat Baik</option>
                    <option value="4">Baik</option>
                    <option value="3">Cukup</option>
                    <option value="2">Kurang</option>
                    <option value="1">Sangat Kurang</option>
                  </select>
                </div>
                @endforeach
              </div>
            </div>
            <div class="flex justify-center">
              <button class="mt-6 bg-e4a01b active:bg-9a652f text-white font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                  type="submit">
                Simpan
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="flex flex-wrap mt-4">
    <div class="w-full mb-12 px-4">
      <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white">
        <div class="rounded-t mb-0 px-4 py-3 border-0">
          <div class="flex flex-wrap items-center">
            <div class="relative w-full px-4 max-w-full flex-grow flex-1">
              <h3 class="font-semibold text-lg text-blueGray-700">
                Matriks Penilaian
              </h3>
            </div>
          </div>
        </div>
        <div class="block w-full overflow-x-auto">
          <!-- Projects table -->
          <table class="items-center w-full bg-transparent border-collapse">
            <thead>
              <tr>
                <th class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 border-b border-b-solid whitespace-nowrap font-semibold text-center bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                  Matriks Keputusan
                </th>
                @foreach ($kriterias as $kriteria)
                <th class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 border-b border-b-solid whitespace-nowrap font-semibold text-center bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                  {{$kriteria->nama}}
                </th>
                @endforeach
                <th class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-center bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                  Tindakan
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($alternatifs as $alternatif)
              <tr>
                <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 border-b border-b-solid text-sm whitespace-nowrap p-4 text-center bg-gray-100">
                  <span class="ml-3 font-bold text-blueGray-700">
                    {{ $alternatif->nama }}
                  </span>
                </th>
                @foreach ($kriterias as $kriteria)
                @php
                $penilaian = $penilaians->where('alternatif_id', $alternatif->id)->where('kriteria_id', $kriteria->id)->first();
                @endphp
                <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 border-b border-b-solid text-sm whitespace-nowrap p-4 text-center">
                  <span class="ml-3 font-bold text-blueGray-600">
                    {{ $penilaian ? $penilaian->nilai : 'N/A' }}
                  </span>
                </th>
                @endforeach
                <td class="border-t-0 px-0 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4 text-center">
                  <div class="flex items-center">
                    <div class="relative w-full flex space-x-2 justify-center">
                      @if($penilaian)
                      <form action="{{ route('penilaian.edit', $penilaian->id) }}" method="GET">
                        <button class="bg-blueGray-700 text-white active:bg-9a652f font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                            type="submit">
                          <i class="fas fa-edit text-white hover:text-white"></i>
                        </button>
                      </form>

                      <form action="{{ route('penilaian.destroy', $penilaian->alternatif_id) }}" method="POST" onsubmit="return confirm('Apakah Anda Yakin Menghapus Data?');">
                        @csrf
                        @method('DELETE')
                        <button class="bg-e4a01b active:bg-9a652f text-white font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                            type="submit">
                          <i class="fas fa-trash text-white hover:text-white"></i>
                        </button>
                      </form>
                      @endif
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
