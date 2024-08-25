@extends('layouts.main')

@section('content')
<div class="relative bg-e4a01b md:pt-32 pb-32 pt-12">
    <div class="px-4 md:px-10 mx-auto w-full">
        <div></div>
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
                                Uji Sensitivitas
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-x-auto">
                    <!-- Sensitivity Analysis Table -->
                    <table class="items-center w-full bg-transparent border-collapse">
                        <thead>
                            <tr>
                                <th class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 border-b border-b-solid whitespace-nowrap font-semibold text-center bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                                    Kriteria
                                </th>
                                <th class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 border-b border-b-solid whitespace-nowrap font-semibold text-center bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                                    ARAS
                                </th>
                                <th class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 border-b border-b-solid whitespace-nowrap font-semibold text-center bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                                    CODAS
                                </th>
                                <th class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 border-b border-b-solid whitespace-nowrap font-semibold text-center bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                                    Perubahan ARAS
                                </th>
                                <th class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 border-b border-b-solid whitespace-nowrap font-semibold text-center bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                                    Perubahan CODAS
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Row for original weights -->
                            <tr>
                                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 border-b border-b-solid text-sm whitespace-nowrap p-4 text-center">
                                    Data Awal
                                </td>
                                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 border-b border-b-solid text-sm whitespace-nowrap p-4 text-center">
                                    {{ number_format($maxAras['original_Aksesibilitas'] ?? 0, 4) }}
                                </td>
                                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 border-b border-b-solid text-sm whitespace-nowrap p-4 text-center">
                                    {{ number_format($maxCodas['original_Aksesibilitas'] ?? 0, 4) }}
                                </td>
                                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 border-b border-b-solid text-sm whitespace-nowrap p-4 text-center">
                                    -
                                </td>
                                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 border-b border-b-solid text-sm whitespace-nowrap p-4 text-center">
                                    -
                                </td>
                            </tr>
                            @foreach ($kriterias as $index => $kriteria)
                            <!-- Row for weight_0_5 -->
                            <tr>
                                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 border-b border-b-solid text-sm whitespace-nowrap p-4 text-center">
                                    {{ $kriteria->nama }} (Bobot +0.5)
                                </td>
                                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 border-b border-b-solid text-sm whitespace-nowrap p-4 text-center">
                                    {{ number_format($maxAras['kriteria_' . $kriteria->nama . '_0_5_' . $kriteria->nama] ?? 0, 4) }}
                                </td>
                                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 border-b border-b-solid text-sm whitespace-nowrap p-4 text-center">
                                    {{ number_format($maxCodas['kriteria_' . $kriteria->nama . '_0_5_' . $kriteria->nama] ?? 0, 4) }}
                                </td>
                                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 border-b border-b-solid text-sm whitespace-nowrap p-4 text-center">
                                    {{ number_format($perubahanAras[$index * 2] ?? 0, 4) }}
                                </td>
                                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 border-b border-b-solid text-sm whitespace-nowrap p-4 text-center">
                                    {{ number_format($perubahanCodas[$index * 2] ?? 0, 4) }}
                                </td>
                            </tr>

                            <!-- Row for weight_1 -->
                            <tr>
                                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 border-b border-b-solid text-sm whitespace-nowrap p-4 text-center">
                                    {{ $kriteria->nama }} (Bobot +1)
                                </td>
                                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 border-b border-b-solid text-sm whitespace-nowrap p-4 text-center">
                                    {{ number_format($maxAras['kriteria_' . $kriteria->nama . '_1_' . $kriteria->nama] ?? 0, 4) }}
                                </td>
                                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 border-b border-b-solid text-sm whitespace-nowrap p-4 text-center">
                                    {{ number_format($maxCodas['kriteria_' . $kriteria->nama . '_1_' . $kriteria->nama] ?? 0, 4) }}
                                </td>
                                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 border-b border-b-solid text-sm whitespace-nowrap p-4 text-center">
                                    {{ number_format($perubahanAras[$index * 2 + 1] ?? 0, 4) }}
                                </td>
                                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 border-b border-b-solid text-sm whitespace-nowrap p-4 text-center">
                                    {{ number_format($perubahanCodas[$index * 2 + 1] ?? 0, 4) }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 border-b border-b-solid whitespace-nowrap font-semibold text-center bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                                    Total
                                </th>
                                <th class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 border-b border-b-solid whitespace-nowrap font-semibold text-center bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                                    -
                                </th>
                                <th class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 border-b border-b-solid whitespace-nowrap font-semibold text-center bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                                    -
                                </th>
                                <th class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 border-b border-b-solid whitespace-nowrap font-semibold text-center bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                                    {{ number_format($totalPerubahanAras, 4) }}
                                </th>
                                <th class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 border-b border-b-solid whitespace-nowrap font-semibold text-center bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                                    {{ number_format($totalPerubahanCodas, 4) }}
                                </th>   
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
