@extends('layouts.frontend')
@section('content')
    <!-- START: BREADCRUMB -->
    <section class="bg-gray-100 py-8 px-4">
        <div class="container mx-auto">
          <ul class="breadcrumb">
            <li>
              <a href="/">Home</a>
            </li>
            <li>
              <a href="#" aria-label="current-page">Keranjang Belanja</a>
            </li>
          </ul>
        </div>
      </section>
      <!-- END: BREADCRUMB -->
  
      <!-- START: COMPLETE YOUR ROOM -->
      <section class="md:py-16">
        <div class="container mx-auto px-4">
          <div class="flex -mx-4 flex-wrap">
            <div class="w-full px-4 mb-4 md:w-8/12 md:mb-0" id="shopping-cart">
              <div
                class="flex flex-start mb-4 mt-8 pb-3 border-b border-gray-200 md:border-b-0"
              >
                <h3 class="text-2xl">Keranjang Anda</h3>
              </div>
  
              <div class="border-b border-gray-200 mb-4 hidden md:block">
                <div class="flex flex-start items-center pb-2 -mx-4">
                  <div class="px-4 flex-none">
                    <div class="" style="width: 90px">
                      <h6>Photo</h6>
                    </div>
                  </div>
                  <div class="px-4 w-5/12">
                    <div class="">
                      <h6>Kue</h6>
                    </div>
                  </div>
                  <div class="px-4 w-5/12">
                    <div class="">
                      <h6>Harga</h6>
                    </div>
                  </div>
                  <div class="px-4 w-5/12">
                    <div class="">
                      <h6>Jumlah</h6>
                    </div>
                  </div>
                  <div class="px-4 w-2/12">
                    <div class="text-center">
                      <h6>Action</h6>
                    </div>
                  </div>
                </div>
              </div>
              <?php
              $totalBerat = 0;
              $berat = 0;
              $result = 0;
              ?>
              @forelse ($carts as $cart)

                  <!-- START: ROW 1 -->
                <div
                  class="flex flex-start flex-wrap items-center mb-4 -mx-4"
                  data-row="1">
                    <div class="px-4 flex-none">
                      <div class="" style="width: 90px; height: 90px">
                        <img
                          src="{{ $cart->product->galleries()->exists() ? Storage::url($cart->product->galleries->first()->url) : "data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" }}"
                          alt=""
                          class="object-cover rounded-xl w-full h-full"
                        />
                      </div>
                    </div>
                    <div class="px-4 w-auto flex-1 md:w-5/12">
                      <div class="">
                        <h6 class="font-semibold text-lg md:text-xl leading-8">
                          {{ $cart->product->name }}
                        </h6>
                        <span class="text-sm md:text-lg"></span>
                        <h6
                          class="font-semibold text-base md:text-lg block md:hidden"
                        >
                          IDR {{ number_format($cart->product->price) }}
                        </h6>
                      </div>
                    </div>
                    <div
                      class="px-4 w-auto flex-none md:flex-1 md:w-5/12 hidden md:block"
                    >
                      <div class="">
                        <h6 class="font-semibold text-lg">IDR {{ number_format($cart->product->price) }}</h6>
                      </div>
                    </div>
                    <div
                      class="px-4 w-auto flex-none md:flex-1 md:w-5/12 hidden md:block"
                    >
                      <div class="">
                        <h6 class="font-semibold text-lg">{{ $cart->quantity }}</h6>
                      </div>
                    </div>
                    <div class="px-4 w-2/12">
                      <div class="text-center">
                        <form action="{{ route('cart-delete',$cart->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button
                          class="text-red-600 border-none focus:outline-none px-3 py-1"
                          >
                          X
                          </button>
                        </form>
                      </div>
                    </div>
                </div>
            <!-- END: ROW 1 -->
              @empty    
                <p id="cart-empty" class="text-center py-8">
                  Ooops... Keranjang kosong
                  <a href="{{ route('index') }}" class="underline">Ayo Belanja</a>
                </p>  
              @endforelse

              
              
            </div>
            <div class="w-full md:px-4 md:w-4/12" id="shipping-detail">
              <div class="bg-gray-100 px-4 py-6 md:p-8 md:rounded-3xl">
                <form action="{{ route('checkout') }}" method="POST">
                  @csrf
                    <div class="flex flex-start mb-6">
                      <h3 class="text-2xl">Form Pemesanan</h3>
                    </div>
    
                    <div class="flex flex-col mb-4">
                      <label for="complete-name" class="text-sm mb-2"
                        >Nama Penerima</label
                      >
                      <input
                        data-input
                        name="name"
                        type="text"
                        id="complete-name"
                        class="border-gray-200 border rounded-lg px-4 py-2 bg-white text-sm focus:border-blue-200 focus:outline-none"
                        placeholder="Input your name" value="{{ Auth::user()->name }}"
                      />
                    </div>
    
                    <div class="flex flex-col mb-4">
                      <label for="email" class="text-sm mb-2">Alamat Email</label>
                      <input
                        data-input
                        name="email"
                        type="email"
                        id="email"
                        class="border-gray-200 border rounded-lg px-4 py-2 bg-white text-sm focus:border-blue-200 focus:outline-none"
                        placeholder="Input your email address" value="{{ Auth::user()->email }}"
                      />
                    </div>
    
                    <div class="flex flex-col mb-4">
                      <label for="address" class="text-sm mb-2">Alamat Penerima</label>
                      <input
                        data-input
                        name="address"
                        type="text"
                        id="address"
                        class="border-gray-200 border rounded-lg px-4 py-2 bg-white text-sm focus:border-blue-200 focus:outline-none"
                        placeholder="Input your address"
                      />
                    </div>
                    <div class="flex flex-col mb-4">
                      <label for="phone-number" class="text-sm mb-2"
                        >Telepon</label
                      >
                      <input
                        data-input
                        name="phone"
                        type="tel"
                        id="phone-number"
                        class="border-gray-200 border rounded-lg px-4 py-2 bg-white text-sm focus:border-blue-200 focus:outline-none"
                        placeholder="Input your phone number"
                      />
                    </div>
                    <div class="flex flex-col mb-4">
                      <label for="ongkir" class="text-sm mb-2">Jenis Paket</label>
                        <select class="border-gray-200 border rounded-lg px-2 py-2 bg-white text-sm focus:border-blue-200 focus:outline-none" name="ongkir" id="ongkir">
                          <option value="">-- pilih Paket --</option>
                          <option value="10000">diantar</option>
                          <option value="0">jemput sendiri</option>
                        </select>
                    </div>
                    <div class="flex flex-col mb-4">
                      <label for="complete-name" class="text-sm mb-2"
                        >Pembayaran</label
                      >
                      <div class="flex -mx-2 flex-wrap">
                        <div class="px-2 w-6/12 h-24 mb-4">
                          <button
                            type="button"
                            data-value="midtrans"
                            data-name="payment"
                            class="border border-gray-200 focus:border-red-200 flex items-center justify-center rounded-xl bg-white w-full h-full focus:outline-none"
                          >
                            <img
                              src="/frontend/images/content/logo-midtrans.png"
                              alt="Logo midtrans"
                              class="object-contain max-h-full"
                            />
                          </button>
                        </div>
                      </div>
                    </div>
                    <div class="text-center">
                      <button
                        type="submit"
                        class="bg-pink-400 text-black hover:bg-black hover:text-pink-400 focus:outline-none w-full py-3 rounded-full text-lg focus:text-black transition-all duration-200 px-6"
                      >
                        Checkout
                      </button>
                      
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>  
        <!-- END: COMPLETE YOUR ROOM -->
    @endsection