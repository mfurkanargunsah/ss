
@extends('adminpanel.dashboard')
@section('request')
@vite(['resources/css/app.css','resources/js/app.js','resources/js/fileuploader.js'])
<div class="max-w-4xl mx-auto p-6 bg-white rounded-md shadow-md">
    <!-- Kullanıcı bilgileri -->
    <div class="flex justify-between items-start mb-4">
        <div>
            <h2 class="text-xl font-bold">{{$request->creator->name.' '.$request->creator->surname}}</h2>
            <p class="text-gray-500">ID: {{$request->creator_uuid}}</p>
    
        <!-- Kişisel Bilgiler -->
<div class="mt-4">
    <h3 class="text-lg font-semibold">Kişisel Bilgiler:</h3>
    <div class="mt-2">
        <p><span class="font-bold">E-posta: </span>{{$request->creator->email}}</p>
     
        <p><span class="font-bold">Telefon: </span>{{$request->creator->phone}}</p>

        <p><span class="font-bold">Adres: </span>{{$request->creator->adress}} {{$request->creator->city}}/{{$request->creator->country}}</p>

    </div>
</div>

    
    <!-- İletişim Tercihleri -->
    <div class="mt-4">
        <h3 class="text-lg font-semibold">İletişim Tercihleri:</h3>
        <label class="inline-flex items-center cursor-not-allowed">
            <input type="checkbox" class="form-checkbox text-primary-500" disabled {{$request->is_return_written == 1 ? 'checked' : ''}}>
            <span class="ml-2">Yazılı İletişim</span>
        </label>
        <label class="inline-flex items-center cursor-not-allowed">
            <input type="checkbox" class="form-checkbox text-primary-500" disabled {{$request->is_return_called == 1 ? 'checked' : ''}}>
            <span class="ml-2">Sesli Arama</span>
        </label>
        <label class="inline-flex items-center cursor-not-allowed">
            <input type="checkbox" class="form-checkbox text-primary-500" disabled {{$request->is_return_video == 1 ? 'checked' : ''}}>
            <span class="ml-2">Görüntülü Arama</span>
        </label>
</div>
        </div>
        <div class="mt-4"><p class="text-gray-500 mt-4">{{$request->created_at}}</p></div>
       
        
    </div>
    
    
    <!-- Kullanıcı mesajı -->
    <div class="mb-4">
        <h3 class="text-lg font-semibold mb-2">Kullanıcının Sorusu:</h3>
        <p>{{$request->question}}</p>
    </div>

    <!-- Yüklenen belgeler -->
    @if(count($fileGroups['document']) > 0)
    <div>
        <h3 class="text-lg font-semibold mb-2"> Belgeler:</h3>
        <ul>
            @foreach($fileGroups['document'] as $file)
                <li class="flex items-center justify-between mb-2">
                    <span>{{ $file->filename }}</span>
                    <a href="{{ route('download', ['filename' => $file->filename]) }}" target="_blank" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">İndir</a>
                </li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Yüklenen videolar -->
@if(count($fileGroups['Video']) > 0)
    <div>
        <h3 class="text-lg font-semibold mb-2"> Videolar:</h3>
        <ul>
            @foreach($fileGroups['Video'] as $file)
                <li class="flex items-center justify-between mb-2">
                    <span>{{ $file->filename }}</span>
                    <a href="{{ route('download', ['filename' => $file->filename]) }}" target="_blank" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">İndir</a>
                </li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Yüklenen ses kayıtları -->
@if(count($fileGroups['Audio']) > 0)
    <div>
        <h3 class="text-lg font-semibold mb-2"> Ses Dosyaları:</h3>
        <ul>
            @foreach($fileGroups['Audio'] as $file)
                <li class="flex items-center justify-between mb-2">
                    <span>{{ $file->filename }}</span>
                    <a href="{{ route('download', ['filename' => $file->filename]) }}" target="_blank" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">İndir</a>
                </li>
            @endforeach
        </ul>
    </div>
@endif

@if(count($fileGroups['photo']) > 0)
    <!-- Yüklenen diğer fotoğraflar -->
    <div>
        <h3 class="text-lg font-semibold mb-2"> Fotoğraflar:</h3>
        <ul>
            @foreach($fileGroups['photo'] as $file)
                <li class="flex items-center justify-between mb-2">
                    <span>{{ $file->filename }}</span>
                    <a href="{{ route('download', ['filename' => $file->filename]) }}" target="_blank" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">İndir</a>
                </li>
            @endforeach
        </ul>
    </div>
@endif


</div>
@endsection