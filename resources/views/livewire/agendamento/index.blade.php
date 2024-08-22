@extends('layouts.app')

@section('content')
 {{--   <section class="px-0 py-12 mx-auto max-w-7xl sm:px-4">
        <div class="grid items-center grid-cols-1 gap-10 px-4 py-6 overflow-hidden text-pink-900 bg-pink-100 border-pink-100 rounded-none card card-body sm:rounded-lg md:px-10 md:grid-cols-5 lg:gap-0">
            <div class="col-span-1 md:col-span-3">
                <h2 class="mb-3 font-serif text-2xl font-normal leading-tight lg:text-3xl">Sleep peacefully knowing that your website is performing at it’s best.</h2>
                <p class="mb-6 text-sm font-semibold lg:text-base">We deliver a guaranteed number of high-quality new leads every month. Combined with the sales tools to convert them into paying clients.</p>
                <a href="#" class="w-full text-pink-900 shadow btn btn-white btn-lg sm:w-auto">Start for free</a>
            </div>
            <div class="col-span-1 md:col-span-2">
                <img src="/mac.png" class="w-full ml-0 select-none lg:ml-48" alt="Mac App" />
            </div>
        </div>
    </section>--}}


 <section class="">


     <div class="hidden md:block absolute z-20 w-full">
         <div class="w-full flex justify-center">
             <img src="img/logo-alerj-grande.png" class="w-1/5">
         </div>

         <div class="w-full text-center mt-3">
             <h1 class="text-2xl lg:text-4xl font-bold text-brand-900">
                 Agendamentos de visitas
             </h1>
             <div class=" flex justify-center mt-3">
                 <div class="w-4/6 lg:w-3/5 2xl:w-1/2 text-sm lg:text-base">
                     Interdum et malesuada fames ac ante ipsum primis in faucibus. Nullam fermentum a erat sed laoreet. Pellentesque in diam convallis, blandit ante in, accumsan sem. Integer nulla lectus.
                 </div>
             </div>
         </div>
     </div>



     <div class="flex items-center justify-center h-screen relative z-10">
         <div class="w-10/12 2xl:w-3/4 mx-auto sm:mx-auto my-4 sm:my-0 ">
             <div class="flex flex-col sm:flex-row gap-x-8">

                 <div class="w-full lg:w-1/2 p-2">
                     <div class="relative p-5 bg-white rounded-lg shadow mt-4 transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 hover:shadow-xl duration-300">
                         <div class="relative z-10">
                             <div class="w-10/12">
                                 <h3 class="font-medium text-2xl text-gray-800">
                                     Agende sua visita.
                                 </h3>

                                 <div class="mt-6">
                                     <input type="text" id="name" class="px-4 py-3 w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm opacity-80" name="name" placeholder="Seu nome">
                                 </div>

                                 <div class="mt-6 md:mt-8">
                                     <button class="w-full md:w-auto text-sm bg-brand-800 hover:bg-brand-950 px-4 py-2 text-white rounded-3xl font-medium">
                                         Agende sua visita agora
                                     </button>
                                 </div>
                             </div>
                         </div>
                         <div class="block absolute z-0 bottom-0 right-0">
                             <img src="/img/booking.svg" class="h-64">
                         </div>
                     </div>
                 </div>

                 <div class="w-full lg:w-1/2">
                     <div class="relative p-5 bg-white rounded-lg shadow mt-4 transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 hover:shadow-xl duration-300">
                         <div class="relative z-10">
                             <div class="w-full">
                                 <h3 class="font-medium text-2xl text-gray-800">
                                     Consulte seu agendamento.
                                 </h3>
                                 <div class="mt-6">
                                     <input type="text" id="name" class="px-4 py-3 w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm opacity-80" name="name" placeholder="Seu nome">
                                 </div>
                                 <div class="mt-6 md:mt-8">
                                     <button class="w-full md:w-auto text-sm bg-brand-800 hover:bg-brand-950 px-4 py-2 text-white rounded-3xl font-medium">
                                         Consultar Agendamento
                                     </button>
                                 </div>
                             </div>
                         </div>

                         <div class="block absolute z-0 bottom-0 right-0">
                             <img src="img/conference2.svg" class="h-64">
                         </div>
                     </div>
                 </div>
             </div>

         </div>
     </div>

     <div class="hidden md:block absolute z-0 bottom-0 right-5">
         <img src="img/fundo_alerj.jpg" class="w-full h-full object-cover opacity-35">
     </div>


 </section>




{{--



 <div class="relative p-5 bg-white rounded-lg shadow mt-4">
        <div class="absolute top-0 right-0 m-4 p-3 rounded-full bg-gray-100">
            <svg class="w-4 h-4" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.9095 9.00028L16.6786 3.2311L17.8684 2.04138C18.0439 1.86587 18.0439 1.58067 17.8684 1.40517L16.5954 0.132192C16.4199 -0.0433137 16.1347 -0.0433137 15.9592 0.132192L9.00028 7.0911L2.04138 0.131629C1.86587 -0.0438764 1.58067 -0.0438764 1.40517 0.131629L0.131629 1.40461C-0.0438764 1.58011 -0.0438764 1.86531 0.131629 2.04081L7.0911 9.00028L0.131629 15.9592C-0.0438764 16.1347 -0.0438764 16.4199 0.131629 16.5954L1.40461 17.8684C1.58011 18.0439 1.86531 18.0439 2.04081 17.8684L9.00028 10.9095L14.7695 16.6786L15.9592 17.8684C16.1347 18.0439 16.4199 18.0439 16.5954 17.8684L17.8684 16.5954C18.0439 16.4199 18.0439 16.1347 17.8684 15.9592L10.9095 9.00028Z" fill="#383838"></path>
            </svg>
        </div>

        <div class="relative z-10">
            <div class="w-10/12">
                <h3 class="font-medium text-gray-800">
                    Do you have house that you want to sell or rent? Advertise it with us for free.
                </h3>

                <div class="mt-6">
                    <input type="text" id="name" class="px-4 py-3 w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm" name="name" placeholder="Property name">
                </div>

                <div class="mt-6 md:mt-8">
                    <button class="w-full md:w-auto text-sm bg-gray-500 px-4 py-2 text-white rounded-3xl font-medium">
                        Create Property
                    </button>
                </div>
            </div>

            <div class="mt-8 w-full md:w-7/12">
                <p class="text-xs text-gray-600">
                    By clicking Create property, you agree to our Privacy Policy to create a new property listing.
                </p>
            </div>
        </div>

        <div class="hidden md:inline-block absolute z-0 bottom-0 right-5">
            <svg width="266" height="150" viewBox="0 0 266 150" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21.7459 149.159L21.1953 149.035C27.3348 121.732 42.7639 96.9379 64.6404 79.2208C81.1798 65.8469 100.851 56.9023 121.801 53.2293C142.752 49.5564 164.292 51.2758 184.395 58.2258C204.497 65.1758 222.5 77.1276 236.709 92.9559C250.917 108.784 260.863 127.968 265.611 148.702L265.061 148.827C252.064 91.7633 202.053 51.9093 143.441 51.9093C85.5972 51.9093 34.4171 92.8086 21.7459 149.159Z" fill="#3F3D56"></path>
                <path d="M69.4789 50.0713H66.9666V149.308H69.4789V50.0713Z" fill="#3F3D56"></path>
                <path d="M92.6648 62.7179C92.8247 97.4185 68.411 125.662 68.411 125.662C68.411 125.662 43.738 97.6448 43.578 62.9442C43.4181 28.2435 67.8318 0 67.8318 0C67.8318 0 92.5048 28.0173 92.6648 62.7179Z" fill="#2d6bcf"></path>
                <path d="M244.29 108.224H49.8536V149.425H244.29V108.224Z" fill="#F2F2F2"></path>
                <path d="M43.6452 112.739L64.8102 68.4336H233.848L249.652 112.739H43.6452Z" fill="#3F3D56"></path>
                <path d="M174.868 71.2556H96.4167V97.2181H174.868V71.2556Z" fill="#F2F2F2"></path>
                <path d="M101.496 50.0907L89.0795 76.0531H182.206L174.868 50.0907H101.496Z" fill="#3F3D56"></path>
                <path d="M165.274 116.408H103.331V149.425H165.274V116.408Z" fill="#CCCCCC"></path>
                <path d="M90.4905 117.537H57.473V149.425H90.4905V117.537Z" fill="#CCCCCC"></path>
                <path d="M193.07 119.512H175.997V149.425H193.07V119.512Z" fill="#3F3D56"></path>
                <path d="M38.6445 83.8302H36.9866V149.316H38.6445V83.8302Z" fill="#3F3D56"></path>
                <path d="M53.9447 92.1755C54.0503 115.074 37.9398 133.712 37.9398 133.712C37.9398 133.712 21.6583 115.224 21.5527 92.3248C21.4472 69.4262 37.5576 50.7885 37.5576 50.7885C37.5576 50.7885 53.8392 69.2769 53.9447 92.1755Z" fill="#2d6bcf"></path>
                <path opacity="0.1" d="M53.9447 92.1755C54.0503 115.074 37.9398 133.712 37.9398 133.712C37.9398 133.712 21.6583 115.224 21.5527 92.3248C21.4472 69.4262 37.5576 50.7885 37.5576 50.7885C37.5576 50.7885 53.8392 69.2769 53.9447 92.1755Z" fill="black"></path>
                <path d="M17.0923 83.8302H15.4344V149.316H17.0923V83.8302Z" fill="#3F3D56"></path>
                <path d="M32.3925 92.1755C32.498 115.074 16.3876 133.712 16.3876 133.712C16.3876 133.712 0.106042 115.224 0.000516156 92.3248C-0.10501 69.4262 16.0054 50.7885 16.0054 50.7885C16.0054 50.7885 32.287 69.2769 32.3925 92.1755Z" fill="#2d6bcf"></path>
                <path d="M219.879 121.205H211.554V128.966H219.879V121.205Z" fill="#3F3D56"></path>
                <path d="M231.026 121.205H222.701V128.966H231.026V121.205Z" fill="#3F3D56"></path>
                <path d="M219.879 131.788H211.554V139.83H219.879V131.788Z" fill="#3F3D56"></path>
                <path d="M231.026 131.788H222.701V139.83H231.026V131.788Z" fill="#3F3D56"></path>
                <path d="M110.128 78.3597H103.613V84.4332H110.128V78.3597Z" fill="#3F3D56"></path>
                <path d="M118.852 78.3597H112.336V84.4332H118.852V78.3597Z" fill="#3F3D56"></path>
                <path d="M110.128 86.6417H103.613V92.936H110.128V86.6417Z" fill="#3F3D56"></path>
                <path d="M118.852 86.6417H112.336V92.936H118.852V86.6417Z" fill="#3F3D56"></path>
                <path d="M158.949 78.3597H152.433V84.4332H158.949V78.3597Z" fill="#3F3D56"></path>
                <path d="M167.672 78.3597H161.157V84.4332H167.672V78.3597Z" fill="#3F3D56"></path>
                <path d="M158.949 86.6417H152.433V92.936H158.949V86.6417Z" fill="#3F3D56"></path>
                <path d="M167.672 86.6417H161.157V92.936H167.672V86.6417Z" fill="#3F3D56"></path>
                <path d="M134.679 78.3597H128.164V84.4332H134.679V78.3597Z" fill="#3F3D56"></path>
                <path d="M143.403 78.3597H136.888V84.4332H143.403V78.3597Z" fill="#3F3D56"></path>
                <path d="M134.679 86.6417H128.164V92.936H134.679V86.6417Z" fill="#3F3D56"></path>
                <path d="M143.403 86.6417H136.888V92.936H143.403V86.6417Z" fill="#3F3D56"></path>
                <path d="M183.909 122.543H179.807V126.367H183.909V122.543Z" fill="#F2F2F2"></path>
                <path d="M189.402 122.543H185.3V126.367H189.402V122.543Z" fill="#F2F2F2"></path>
                <path d="M183.909 127.757H179.807V131.72H183.909V127.757Z" fill="#F2F2F2"></path>
                <path d="M189.402 127.757H185.3V131.72H189.402V127.757Z" fill="#F2F2F2"></path>
                <path d="M190.813 137.714C191.436 137.714 191.942 137.209 191.942 136.585C191.942 135.962 191.436 135.456 190.813 135.456C190.189 135.456 189.684 135.962 189.684 136.585C189.684 137.209 190.189 137.714 190.813 137.714Z" fill="#F2F2F2"></path>
                <path d="M165.415 119.935H103.331V120.5H165.415V119.935Z" fill="#F2F2F2"></path>
                <path d="M165.415 122.475H103.331V123.039H165.415V122.475Z" fill="#F2F2F2"></path>
                <path d="M165.415 125.015H103.331V125.579H165.415V125.015Z" fill="#F2F2F2"></path>
                <path d="M165.415 127.555H103.331V128.119H165.415V127.555Z" fill="#F2F2F2"></path>
                <path d="M165.415 130.094H103.331V130.659H165.415V130.094Z" fill="#F2F2F2"></path>
                <path d="M165.415 132.634H103.331V133.199H165.415V132.634Z" fill="#F2F2F2"></path>
                <path d="M165.415 135.174H103.331V135.738H165.415V135.174Z" fill="#F2F2F2"></path>
                <path d="M165.415 137.714H103.331V138.278H165.415V137.714Z" fill="#F2F2F2"></path>
                <path d="M165.415 140.254H103.331V140.818H165.415V140.254Z" fill="#F2F2F2"></path>
                <path d="M165.415 142.793H103.331V143.358H165.415V142.793Z" fill="#F2F2F2"></path>
                <path d="M165.415 145.333H103.331V145.898H165.415V145.333Z" fill="#F2F2F2"></path>
                <path d="M90.4905 119.935H57.473V120.5H90.4905V119.935Z" fill="#F2F2F2"></path>
                <path d="M90.4905 122.475H57.473V123.039H90.4905V122.475Z" fill="#F2F2F2"></path>
                <path d="M90.4905 125.015H57.473V125.579H90.4905V125.015Z" fill="#F2F2F2"></path>
                <path d="M90.4905 127.555H57.473V128.119H90.4905V127.555Z" fill="#F2F2F2"></path>
                <path d="M90.4905 130.094H57.473V130.659H90.4905V130.094Z" fill="#F2F2F2"></path>
                <path d="M90.4905 132.634H57.473V133.199H90.4905V132.634Z" fill="#F2F2F2"></path>
                <path d="M90.4905 135.174H57.473V135.738H90.4905V135.174Z" fill="#F2F2F2"></path>
                <path d="M90.4905 137.714H57.473V138.278H90.4905V137.714Z" fill="#F2F2F2"></path>
                <path d="M90.4905 140.254H57.473V140.818H90.4905V140.254Z" fill="#F2F2F2"></path>
                <path d="M90.4905 142.793H57.473V143.358H90.4905V142.793Z" fill="#F2F2F2"></path>
                <path d="M90.4905 145.333H57.473V145.898H90.4905V145.333Z" fill="#F2F2F2"></path>
                <path d="M233.707 91.1508C246.331 91.1508 256.565 80.9168 256.565 68.2926C256.565 55.6683 246.331 45.4343 233.707 45.4343C221.083 45.4343 210.849 55.6683 210.849 68.2926C210.849 80.9168 221.083 91.1508 233.707 91.1508Z" fill="#2d6bcf"></path>
                <path d="M248.099 66.035H235.965V53.9004H231.45V66.035H219.315V70.5502H231.45V82.6848H235.965V70.5502H248.099V66.035Z" fill="white"></path>
            </svg>
        </div>
    </div>
--}}

    {{--



    <div>
        O que deseja Realizar?
        <ul>
            <li>
                <a href="{{route('agendamento.form-tailwind')}}" >Realizar um agendamento </a>
            </li>
            <li>
                <a href="{{route('agendamento.form-group')}}" > Realizar um agendamento em Grupo </a>
            </li>
            <li>
                Consultar Agendamentos
            </li>
        </ul>


    </div>
    --}}






@endsection



