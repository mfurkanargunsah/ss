
@extends('userpanel.account')
@section('request')


<div id="doc">
    
<div class="bg-white mx-auto max-w-4xl shadow overflow-hidden sm:rounded-lg relative">

    <!-- toast -->
    @if(session('status') == 'success')
    <div id="toast-success" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
            </svg>
            <span class="sr-only">Check icon</span>
        </div>
        <div class="ms-3 text-sm font-normal">Dosya başarıyla eklendi</div>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
    @elseif(session('status') == 'error')
    <div id="toast-warning" class="flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-orange-500 bg-orange-100 rounded-lg dark:bg-orange-700 dark:text-orange-200">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
            </svg>
            <span class="sr-only">Warning icon</span>
        </div>
        <div class="ms-3 text-sm font-normal">Bir hata oluştu. Lütfen sistem yöneticisine bildirin.</div>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-warning" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
    @endif
    <div class="px-4 py-5 sm:px-6">
        <div class="absolute top-4 right-4">
            @if($request->status === "Ödeme Bekleniyor")
            <button onclick="goToPayment()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded hide-on-print">
                Ödeme Yap
            </button>
            @endif
            <button onclick="printDiv('doc')" class="print-button  bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded hide-on-print">
                Yazdır
            </button>
            @if($request->status !== "Ödeme Bekleniyor")
            <button id="actionModalButton" data-modal-target="actionModal" data-modal-toggle="actionModal"  class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Belge Ekle
            </button>
            @endif
        </div>
            

        <h3 class="text-lg leading-6 font-medium text-gray-900">
            {{$request->creator->name.' '.$request->creator->surname}}
        </h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">
            ID:{{$request->creator_uuid}}
        </p>

        <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">{{$request->status}}</span>
    </div>

 
    <div  class="border-t border-gray-200">
        <dl>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Başvuru Tarihi
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{$request->created_at}}
                </dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                   TC Kimlik No
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                   {{$request->creator->country_id}}
                </dd>
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                  E-Posta
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{$request->creator->email}}
                </dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Telefon
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{$request->creator->phone}}
                </dd>
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Adres
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{$request->creator->adress}} {{$request->creator->city}}/{{$request->creator->country}}
                </dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                   Geri Dönüş Tercihi
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <div class="mb-4"> <!-- Grup 1 -->
                        <label class="inline-flex items-center cursor-not-allowed">
                            <input type="checkbox" class="form-checkbox text-primary-500" disabled {{$request->is_return_written == 1 ? 'checked' : ''}}>
                            <span class="ml-4">Yazılı İletişim</span>
                        </label>
                    </div>
                    <div class="mb-4"> <!-- Grup 2 -->
                        <label class="inline-flex items-center cursor-not-allowed">
                            <input type="checkbox" class="form-checkbox text-primary-500" disabled {{$request->is_return_called == 1 ? 'checked' : ''}}>
                            <span class="ml-4">Sesli Arama</span>
                        </label>
                    </div>
                    <div> <!-- Grup 3 -->
                        <label class="inline-flex items-center cursor-not-allowed">
                            <input type="checkbox" class="form-checkbox text-primary-500" disabled {{$request->is_return_video == 1 ? 'checked' : ''}}>
                            <span class="ml-4">Görüntülü Arama</span>
                        </label>
                    </div>
                </dd>
            </div>
            @if($request->type === "company")
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                  Şirket Ünvanı
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{$user->company->email}}
                </dd>
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                 Şirket Telefonu
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{$user->company->phone}}
                </dd>
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                  Şirket Sabit Telefonu
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{$user->company->tel}}
                </dd>
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                  Yetkilinin Ünvanı
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{$user->company->auth_user_position}}
                </dd>
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                  Yetki Belgesi
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <span>{{ $authFile }}</span>
                    <a href="{{ route('download', ['filename' => $authFile]) }}" target="_blank" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">İndir</a>
                </dd>
            </div>

            @endif
            
        
        </dl>
    </div>
    
</div>

<div class="bg-white mx-auto max-w-4xl mt-8 shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
           Başvuru Detayları
        </h3>
    
    </div>
    <div class="border-t border-gray-200">
        <dl>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Soru    
            </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{$request->question}}
                </dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                  Dosyalar
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                 <!-- Tüm dosya grupları -->
<div>
    
        @if(count($files) > 0)
            <div>
                <ul>
                    @foreach($files as $file)
                    @if($file->visibility === 1)
                        <li class="flex items-center justify-between mb-2">
                            <span>{{ $file->filename }}</span>
                            <a href="{{ route('download', ['filename' => $file->filename]) }}" target="_blank" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">İndir</a>
                        </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        @endif
 
</div>

                </dd>
            </div>
         
           
        
        </dl>
    </div>
</div>

<!-- answers -->

<div class="bg-white mx-auto max-w-4xl mt-8 shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
           Avukat Cevapları
        </h3>
    
    </div>
    <div class="border-t border-gray-200">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Cevaplayan Avukat
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Başlık
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Eklenme Tarihi
                    </th>
                   
                </tr>
            </thead>
            <tbody>
              @foreach($answers as $answer)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                       {{ $answer->id }}
                    </th>
                    <td class="px-6 py-4">
                      {{ $answer->creator }}
                    </td>
                    <td class="px-6 py-4">
                      {{ $answer->title }}
                    </td> 
                    <td class="px-6 py-4">
                      {{ $answer->created_at }}
                    </td>
      
                    <td class="px-6 py-4">
                     
            
                            <button type="button" id="updateProductButton" data-modal-target="updateProductModal" data-modal-toggle="updateProductModal" class="font-medium text-blue-600 dark:text-blue-500 hover:underline view-button"
                            data-answer-id="{{ $answer->id }}" data-answer-creator="{{ $answer->creator }}"
                            data-answer-title="{{ $answer->title }}" data-answer-category="{{ $answer->category }}"
                            data-answer-message="{{ $answer->message }}">Görüntüle</button>

                    </td>
                </tr>
              @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Show Answer Modal -->
<div id="updateProductModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl md:h-auto  "> 
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                   Avukat Cevabı
                </h3>
            
            </div>
            <!-- Modal body -->
          
                <div class="grid-cols-1 gap-4 mb-6 sm:grid-cols-1">
                    <div class="mb-4">
                        <label for="modal-answer-title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Başlık</label>
                        <input disabled type="text" name="title" id="modal-answer-title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Konu başlığı girin">
                    </div>
                    <div class="mb-4">
                        <label for="modal-answer-category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                        <input disabled type="text" name="category" id="modal-answer-category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Konu başlığı girin">
                    </div>
                  
                    <div class="sm:col-span-2">
                        <label for="modal-answer-message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mesaj</label>
                        <textarea disabled id="modal-answer-message" name="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Kullanıcıya göndereceğiniz mesajı girin."></textarea>                    
                    </div>
                    <div class="mt-4 mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="multi_file_upload">Dosyalar</label>
                        
                    </div>
                    

                </div>
                <div class="flex items-center space-x-4">
                 
   
                   
                </div>
   
        </div>
    </div>
</div>
<!-- Action modal -->
<div id="actionModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl md:h-auto  "> 
       
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Belge Ekle
                </h3>
             
            </div>
            <!-- Modal body -->
            <form action="{{ route('addNewDocuments') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="request_id" value="{{ $request->id }}"> 
   
                <div class="grid-cols-1 gap-4 mb-6 sm:grid-cols-1">
                  
                
                    
                    <div class="mt-4 mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="multi_file_upload">Dosya Ekle</label>
                        <input class="block w-full mb-5 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="files[]" id="files" type="file" multiple>
                    </div>
                    
                    <div class="p-4 mb-4 mt-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                      Tek seferde birden fazla dosya yükleyebilirsiniz. Dosya adeti başına <span class="font-medium">€15</span> ödemeniz gerekmektedir.
                      </div>

                </div>
                <button type="submit" class="mt-4 text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                   Ödeme Yap
                </button>
            </form>
   
        </div>
    </div>
</div>
</div>
<script>
    
    function printDiv(doc) {
    var printContents = document.getElementById(doc).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}

</script>    
<script>
    document.querySelectorAll('.view-button').forEach(button => {
        button.addEventListener('click', function() {
            var id = this.getAttribute('data-answer-id');
            var title = this.getAttribute('data-answer-title');
            var category = this.getAttribute('data-answer-category');
            var message = this.getAttribute('data-answer-message');

            document.getElementById('modal-answer-title').value = title;
            document.getElementById('modal-answer-category').value = category;
            document.getElementById('modal-answer-message').textContent = message;

           
            document.getElementById("deleteAnswerButton").addEventListener("click", function() {
                if (confirm("Bu cevabı silmek istediğinize emin misiniz?")) {
                    fetch('/answer/delete/' + id, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Silme işlemi başarısız.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Cevap başarıyla silindi.');
                        window.location.reload();
                    })
                    .catch(error => {
                        console.error('Hata:', error);
                    });
                }
            });

            var modal = new bootstrap.Modal(document.getElementById('updateProductModal'));
            modal.show();
        });
    });

    function goToPayment() {
        // İsteğe bağlı parametre değerleri
        var req_id = '{{$request->id}}';

        // Yönlendirme işlemi
        window.location.href = "{{ route('payment', ':req_id') }}"
            .replace(':req_id', req_id);
    }

    


</script>


@include('adminpanel.footer')
@endsection