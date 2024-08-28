@extends('layouts.landing')
@section('landing')
<section
      class="header relative pt-16 items-center flex h-screen max-h-860-px"
    >
      <div class="container mx-auto items-center flex flex-wrap">
        <div class="w-full md:w-8/12 lg:w-6/12 xl:w-6/12 px-4">
          <div class="pt-32 sm:pt-0">
            <h2 class="font-semibold text-4xl text-blueGray-600">
            Selamat Datang di Sistem Pendukung Keputusan Penentuan Lokasi Tempat Tinggal Terbaik di Kota Pontianak!
            </h2>
            <div class="mt-12">
              <a
                href="{{ route('login') }}"
                target="_blank"
                class="get-started text-white font-bold px-6 py-4 rounded outline-none focus:outline-none mr-1 mb-1 bg-e4a01b active:bg-9a652f text-sm shadow hover:shadow-lg ease-linear transition-all duration-150"
              >
                Pelajari Lebih Lanjut
              </a>
            </div>
          </div>
        </div>
      </div>

      <img class="absolute top-0 right-0 pt-16 sm:block hidden sm:w-6/12 -mt-48 sm:mt-0 w-10/12 h-full object-cover" src="./assets/img/landingpnk.png" alt="...">
    </section>

    <section class="pt-20 pb-48">
        <div class="container mx-auto px-4">
          <div class="flex flex-wrap justify-center text-center mb-24">
            <div class="w-full lg:w-6/12 px-4">
              <h2 class="text-e4a01b text-4xl font-semibold">Mengapa Memilih Sistem Ini?</h2>
              <p class="mt-4 text-lg leading-relaxed text-black">
              Kami menyediakan solusi yang memadukan Metode ARAS (Additive Ratio Assessment) dan CODAS (Complex Proportional Assessment) untuk membantu Anda menentukan lokasi tempat tinggal ideal di Kota Pontianak. Metode ini tidak hanya mempertimbangkan faktor-faktor utama seperti aksesibilitas dan infrastruktur, tetapi juga memperhitungkan keunikan dari setiap kriteria untuk memberikan rekomendasi yang tepat.
              </p>
            </div>
          </div>
        </div>
      </section>

@endsection