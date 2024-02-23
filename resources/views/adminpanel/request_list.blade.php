@extends('adminpanel.dashboard')
@section('basvurular')

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    No
                </th>
                <th scope="col" class="px-6 py-3">
                    Başvuran Adı
                </th>
                <th scope="col" class="px-6 py-3">
                    Başvuru Tipi
                </th>
                <th scope="col" class="px-6 py-3">
                    Durum
                </th>
                <th scope="col" class="px-6 py-3">
                    Eklenme Tarihi
                </th>
                <th scope="col" class="px-6 py-3">
                </th>
            </tr>
        </thead>
        <tbody>
          @foreach($requests as $request)
            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                   {{ $request->id }}
                </th>
                <td class="px-6 py-4">
                  {{ $request->creator->name }}
                </td>
                <td class="px-6 py-4">
                  {{ $request->type }}
                </td>
                <td class="px-6 py-4">
                  {{ $request->status }}
                </td>
                
                <td class="px-6 py-4">
                  {{ $request->created_at }}
                </td>
  
                <td class="px-6 py-4">
                    <a href="{{ route('requests.show', $request) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Görüntüle</a>
                </td>
            </tr>
          @endforeach
        </tbody>
    </table>
</div>
  
{{ $requests->links() }}

@include('adminpanel.footer')
@endsection
