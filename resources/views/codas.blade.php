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
                <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 border-b border-b-solid text-sm whitespace-nowrap p-4 text-center">
                  <span class="ml-3 font-bold text-blueGray-600">
                    {{ $penilaians->where('alternatif_id', $alternatif->id)->where('kriteria_id', $kriteria->id)->first()->nilai ?? 'N/A' }}
                  </span>
                </th>
                @endforeach
              </tr>
              @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 border-b border-b-solid whitespace-nowrap font-semibold text-center bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                        Min/Max
                    </th>
                    @foreach ($kriterias as $kriteria)
                    @php
                    $values = $penilaians->where('kriteria_id', $kriteria->id)->pluck('nilai');
                    $minMaxValue = $kriteria->jenis == 'Benefit' ? $values->max() : $values->min();
                    @endphp
                    <th class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 border-b border-b-solid whitespace-nowrap font-semibold text-center bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                        {{ $minMaxValue }}
                    </th>
                    @endforeach
                </tr>
                <tr>
                    <th class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 border-b border-b-solid whitespace-nowrap font-semibold text-center bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                        Total
                    </th>
                    @foreach ($kriterias as $kriteria)
                    @php
                    $totalNilai = $penilaians->where('kriteria_id', $kriteria->id)->sum('nilai');
                    @endphp
                    <th class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 border-b border-b-solid whitespace-nowrap font-semibold text-center bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                        {{ $totalNilai }}
                    </th>
                    @endforeach
                </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
    <div class="w-full mb-12 px-4">
      <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white">
        <div class="rounded-t mb-0 px-4 py-3 border-0">
          <div class="flex flex-wrap items-center">
            <div class="relative w-full px-4 max-w-full flex-grow flex-1">
              <h3 class="font-semibold text-lg text-blueGray-700">
                Normalisasi Matriks Penilaian
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
                <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 border-b border-b-solid text-sm whitespace-nowrap p-4 text-center">
                  <span class="ml-3 font-bold text-blueGray-600">
                    {{ number_format($normalizedData[$alternatif->id][$kriteria->id]['normalized'], 4) }}
                  </span>
                </th>
                @endforeach
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="w-full mb-12 px-4">
      <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white">
          <div class="rounded-t mb-0 px-4 py-3 border-0">
              <div class="flex flex-wrap items-center">
                  <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                      <h3 class="font-semibold text-lg text-blueGray-700">
                          Bobot Normalisasi Matriks Penilaian
                      </h3>
                  </div>
              </div>
          </div>
          <div class="block w-full overflow-x-auto">
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
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($alternatifs as $index => $alternatif)
                      <tr>
                          <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 border-b border-b-solid text-sm whitespace-nowrap p-4 text-center bg-gray-100">
                              <span class="ml-3 font-bold text-blueGray-700">
                                  {{ $alternatif->nama }}
                              </span>
                          </th>
                          @foreach ($kriterias as $kriteria)
                          <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 border-b border-b-solid text-sm whitespace-nowrap p-4 text-center">
                              <span class="ml-3 font-bold text-blueGray-600">
                                  {{ number_format($normalizedData[$alternatif->id][$kriteria->id]['weighted_normalized'], 4) }}
                              </span>
                          </th>
                          @endforeach
                      </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
      </div>
    </div>
    <div class="w-full mb-12 px-4">
      <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white">
          <div class="rounded-t mb-0 px-4 py-3 border-0">
              <div class="flex flex-wrap items-center">
                  <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                      <h3 class="font-semibold text-lg text-blueGray-700">
                          Nilai Ideal Negatif NS
                      </h3>
                  </div>
              </div>
          </div>
          <div class="block w-full overflow-x-auto">
              <table class="items-center w-full bg-transparent border-collapse">
                  <thead>
                      <tr>
                          @foreach ($kriterias as $kriteria)
                          <th class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 border-b border-b-solid whitespace-nowrap font-semibold text-center bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                              {{$kriteria->nama}}
                          </th>
                          @endforeach
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                        @foreach($kriterias as $kriteria)
                              <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 border-b border-b-solid text-sm whitespace-nowrap p-4 text-center">
                                  <span class="ml-3 font-bold text-blueGray-600">
                                      {{ number_format($nilaiNS[$kriteria->id], 4) }}
                                  </span>
                              </th>
                          @endforeach
                      </tr>
                  </tbody>
              </table>
          </div>
      </div>
    </div>
    <div class="w-full mb-12 px-4">
      <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white">
          <div class="rounded-t mb-0 px-4 py-3 border-0">
              <div class="flex flex-wrap items-center">
                  <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                      <h3 class="font-semibold text-lg text-blueGray-700">
                          Jarak Euclidean dan Taxicab (E/T)
                      </h3>
                  </div>
              </div>
          </div>
          <div class="block w-full overflow-x-auto">
              <table class="items-center w-full bg-transparent border-collapse">
                  <thead>
                      <tr>
                          <th class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 border-b border-b-solid whitespace-nowrap font-semibold text-center bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                              Alternatif
                          </th>
                          <th class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 border-b border-b-solid whitespace-nowrap font-semibold text-center bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                              Euclidean (E)
                          </th>
                          <th class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 border-b border-b-solid whitespace-nowrap font-semibold text-center bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                              Taxicab (T)
                          </th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($alternatifs as $index => $alternatif)
                      <tr>
                          <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 border-b border-b-solid text-sm whitespace-nowrap p-4 text-center bg-gray-100">
                              <span class="ml-3 font-bold text-blueGray-700">
                                  {{ $alternatif->nama }}
                              </span>
                          </th>
                          <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 border-b border-b-solid text-sm whitespace-nowrap p-4 text-center bg-gray-100">
                              <span class="ml-3 font-bold text-blueGray-700">
                                {{ number_format($euclideanDistances[$alternatif->id], 4) }}
                              </span>
                          </th>
                          <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 border-b border-b-solid text-sm whitespace-nowrap p-4 text-center bg-gray-100">
                              <span class="ml-3 font-bold text-blueGray-700">
                                {{ number_format($taxicabDistances[$alternatif->id], 4) }}
                              </span>
                          </th>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
      </div>
    </div>
    <div class="w-full mb-12 px-4">
      <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white">
          <div class="rounded-t mb-0 px-4 py-3 border-0">
              <div class="flex flex-wrap items-center">
                  <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                      <h3 class="font-semibold text-lg text-blueGray-700">
                          Matriks Relative Assesment (RA)
                      </h3>
                  </div>
              </div>
          </div>
          <div class="block w-full overflow-x-auto">
              <table class="items-center w-full bg-transparent border-collapse">
                  <thead>
                      <tr>
                          <th class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 border-b border-b-solid whitespace-nowrap font-semibold text-center bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                              Alternatif
                          </th>
                          @foreach ($kriterias as $kriteria)
                          <th class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 border-b border-b-solid whitespace-nowrap font-semibold text-center bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                              {{$kriteria->nama}}
                          </th>
                          @endforeach
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($alternatifs as $index => $alternatif)
                      <tr>
                          <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 border-b border-b-solid text-sm whitespace-nowrap p-4 text-center bg-gray-100">
                              <span class="ml-3 font-bold text-blueGray-700">
                                  {{ $alternatif->nama }}
                              </span>
                          </th>
                          @foreach ($kriterias as $kriteria)
                              <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 border-b border-b-solid text-sm whitespace-nowrap p-4 text-center">
                                  @if (isset($relativeAssessmentMatrix[$alternatif->id][$kriteria->id]))
                                      <span class="ml-3 font-bold text-blueGray-600">
                                          {{ number_format($relativeAssessmentMatrix[$alternatif->id][$kriteria->id], 4) }}
                                      </span>
                                  @else
                                      <span class="ml-3 font-bold text-blueGray-600">N/A</span>
                                  @endif
                              </td>
                          @endforeach
                      </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
      </div>
    </div>
    <div class="w-full mb-12 px-4">
      <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white">
          <div class="rounded-t mb-0 px-4 py-3 border-0">
              <div class="flex flex-wrap items-center">
                  <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                      <h3 class="font-semibold text-lg text-blueGray-700">
                          Assesment Score H
                      </h3>
                  </div>
              </div>
          </div>
          <div class="block w-full overflow-x-auto">
              <table class="items-center w-full bg-transparent border-collapse">
                  <thead>
                      <tr>
                          <th class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 border-b border-b-solid whitespace-nowrap font-semibold text-center bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                              Alternatif
                          </th>
                          <th class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 border-b border-b-solid whitespace-nowrap font-semibold text-center bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                              Scrore H
                          </th>
                          <th class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 border-b border-b-solid whitespace-nowrap font-semibold text-center bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                              Rank
                          </th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($alternatifs as $index => $alternatif)
                      <tr>
                          <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 border-b border-b-solid text-sm whitespace-nowrap p-4 text-center bg-gray-100">
                              <span class="ml-3 font-bold text-blueGray-700">
                                  {{ $alternatif->nama }}
                              </span>
                          </th>
                          <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 border-b border-b-solid text-sm whitespace-nowrap p-4 text-center bg-gray-100">
                              <span class="ml-3 font-bold text-blueGray-700">
                                {{ number_format($assessmentScores[$alternatif->id], 4) }}
                              </span>
                          </th>
                          <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 border-b border-b-solid text-sm whitespace-nowrap p-4 text-center bg-gray-100">
                              <span class="ml-3 font-bold text-blueGray-700">
                                {{ $ranking[$alternatif->id] }}
                              </span>
                          </th>
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
