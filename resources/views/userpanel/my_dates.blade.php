@extends('userpanel.account')
@section('randevularım')

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
  
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    No
                </th>
                <th scope="col" class="px-6 py-3">
                   Randevu Tarihi
                </th>
                <th scope="col" class="px-6 py-3">
                    Başlangıç Saati
                </th>
                <th scope="col" class="px-6 py-3">
                 Bitiş Saati
                </th>
                <th scope="col" class="px-6 py-3">
                    Durum
                </th>
                <th scope="col" class="px-6 py-3">
                    Oluşturulma Tarihi
                </th>
                <th scope="col" class="px-6 py-3">
                    
                </th>
            </tr>
        </thead>
        <tbody>
          @foreach($dates as $date)
            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                   {{ $date->id }}
                </th>

                <td class="px-6 py-4">
                  {{ $date->date }}
                </td>
             
                <td class="px-6 py-4">
                  {{ $date->start_time }}
                </td>
                
                <td class="px-6 py-4">
                  {{ $date->end_time }}
                </td>
                @foreach($dates as $date)
                  
                    <td class="px-6 py-4">
                        @if($date->status === 1)
                            Randevu Oluşturuldu
                        @elseif($date->status === 2)
                            Randevu Tamamlandı
                        @elseif($date->status === 3)
                            İptal Edildi
                        @endif
                    </td>
            
          
            @endforeach

                  <td class="px-6 py-4">
                    {{ $date->created_at }}
                  </td>
                  @if($date->status === 1)
                <td class="px-6 py-4">
                    <button id="actionModalButton" data-modal-target="actionModal" data-modal-toggle="actionModal" data-date-id="{{ $date->id }}" class="cancel-button block text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                        İptal Et
                    </button>
                </td>
                @endif
            </tr>
          @endforeach
        </tbody>
    </table>
<!-- Action modal -->
<div id="actionModal" tabindex="-1" aria-hidden="true" class="flex hidden justify-center items-center overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="actionModal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Randevunuzu iptal etmek istediğinizden emin misiniz?</h3>
                <button data-modal-hide="actionModal" id="confirmCancel" type="button" class="text-white bg-red-500 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Evet, İptal Et
                </button>
                <button data-modal-hide="actionModal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Hayır</button>
            </div>
        </div>
    </div>
</div>

    
</div>
{{ $dates->links() }}
<script>
  
    document.getElementById('confirmCancel').addEventListener('click', function() {
  
        document.getElementById('actionModal').classList.add('hidden');

  
        const dateId = this.dataset.dateId;
        console.log(dateId);

        fetch('/cancel-date', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ dateId: dateId })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log(data);

         
            // window.location.reload();
        })
        .catch(error => {
            console.error('There has been a problem with fetch operation:', error);
        });
    });
    document.querySelectorAll('.cancel-button').forEach(item => {
        item.addEventListener('click', event => {
            const dateId = event.target.dataset.dateId;
            console.log(dateId);
            document.getElementById('actionModal').classList.remove('hidden');
            document.getElementById('confirmCancel').dataset.dateId = dateId;
        });
    });
</script>


@include('adminpanel.footer')

@endsection