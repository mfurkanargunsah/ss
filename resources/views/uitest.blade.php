@vite(['resources/css/app.css','resources/js/app.js','resources/js/fileuploader.js'])
@include('header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
    <div class=" mx-auto">
        <div class="max-w-md bg-white p-8 rounded-lg shadow-md">
            <h1 class="text-3xl font-semibold mb-6 text-center">Randevu Oluştur</h1>
            <form action="{{ route('randevular.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="tarih" class="block text-gray-700">Tarih:</label>
                    <input type="date" id="tarih" name="tarih"  required class="mt-1 p-2 border rounded-md w-full">
                </div>
                <div class="mb-4">
                    <label for="baslangic_saati" class="block text-gray-700">Başlangıç Saati:</label>
                    <select id="baslangic_saati" name="baslangic_saati" required class="mt-1 p-2 border rounded-md w-full">
                        @for ($i = 9; $i < 18; $i++)
                            @for ($j = 0; $j < 60; $j+=10)
                                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:{{ str_pad($j, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:{{ str_pad($j, 2, '0', STR_PAD_LEFT) }}</option>
                            @endfor
                        @endfor
                    </select>
                </div>
                <div class="mb-4">
                    <label for="bitis_saati" class="block text-gray-700">Bitiş Saati:</label>
                    <select id="bitis_saati" name="bitis_saati" required class="mt-1 p-2 border rounded-md w-full">
                        <!-- Başlangıç saatinin seçildiği değeri alıp sadece bu saatten sonraki saatleri göster -->
                    </select>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 w-full">Kaydet</button>
            </form>
        </div>
    </div>

    <script>
        // Başlangıç saati değiştiğinde, bitiş saati seçeneklerini güncelleyin
        document.getElementById('baslangic_saati').addEventListener('change', function() {
            var baslangicSaati = this.value;
            var bitisSaatiSelect = document.getElementById('bitis_saati');
            var selectedHour = parseInt(baslangicSaati.split(':')[0]);
            bitisSaatiSelect.innerHTML = '';
            for (var i = selectedHour; i < 18; i++) { // 18:00'den sonrası için seçenek oluşturmayın
                for (var j = 0; j < 60; j += 10) {
                    if ((i > selectedHour || j > parseInt(baslangicSaati.split(':')[1])) && !(i === 17 && j === 50)) {
                        var option = document.createElement('option');
                        option.text = ('0' + i).slice(-2) + ':' + ('0' + j).slice(-2);
                        option.value = ('0' + i).slice(-2) + ':' + ('0' + j).slice(-2);
                        bitisSaatiSelect.add(option);
                    }
                }
            }
        });
    </script>
</body>
</html>