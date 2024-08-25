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
              <div
                class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0"
              >
                <div class="rounded-t bg-white mb-0 px-6 py-6">
                  <div class="text-center flex justify-center">
                    <h6 class="text-blueGray-700 text-xl font-bold">
                      Edit Alternatif
                    </h6>
                  </div>
                </div>
                <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                  <form method="POST" action="{{ route('alternatif.update', $alternatif->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-wrap">
                      <div class="w-full lg:w-12/12 px-4">
                        <div class="relative w-full mb-3">
                          <label
                            class="block uppercase text-blueGray-600 text-xs font-bold my-4"
                            for="nama"
                          >
                            Nama
                          </label>
                          <input
                            type="text"
                            name="nama"
                            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                            placeholder="Masukkan nama"
                            value="{{ $alternatif->nama }}"
                          />
                        </div>
                      </div>
                    </div>
                    <div class="flex justify-center">
                      <button
                        class="mt-6 bg-e4a01b active:bg-9a652f text-white font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                        type="submit"
                      >
                        Simpan Perubahan
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

@endsection
