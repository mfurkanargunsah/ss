@vite(['resources/css/app.css','resources/js/app.js','resources/js/fileuploader.js'])

<!DOCTYPE html>
<html lang="en">
<head>      
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Randevu Al</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
@include('header')
<body class="bg-gray-100 flex justify-center items-center h-screen mt-8 md:mt-36 sm:mt-28" >
    <div class="mx-auto mt-8">
        <div class="max-w-md bg-white p-8 rounded-lg shadow-md">
            <h1 class="text-3xl font-semibold mb-6 text-center">Randevu Oluştur</h1>
            <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
            <dotlottie-player src="https://lottie.host/817b9ff1-4a20-4595-ba0a-f79130313a69/WXjo81RdHX.json" background="#fff" speed="1" style="width: 300px; height: 300px" direction="1" playMode="normal" loop autoplay></dotlottie-player>
           
            <form action="{{ route('randevular.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="date" class="block text-gray-700">Tarih:</label>
                    <input type="date" id="date" name="date" min="{{date('Y-m-d')}}"  required class="mt-1 p-2 border rounded-md w-full">
                </div>
                <div class="mb-4">
                    <label for="start_time" class="block text-gray-700">Başlangıç Saati:</label>
                    <select id="start_time" name="start_time" required class="mt-1 p-2 border rounded-md w-full">
                        @foreach($startTimes as $time)
                            <option value="{{ $time }}">{{ $time }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="end_time" class="block text-gray-700">Bitiş Saati:</label>
                    <select id="end_time" name="end_time" required class="mt-1 p-2 border rounded-md w-full">
                        @foreach($endTimes as $time)
                            <option value="{{ $time }}">{{ $time }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                    Dakikalık ücret: <span class="font-medium">{{$price}}€</span> (Örn: 10dk = @php echo 10*$price @endphp€)
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 w-full">Devam Et</button>
            </form>
        </div>
    </div>
    <script src="resources/js/app.js"></script>
    <script src="resources/js/fileuploader.js"></script>
    <script>
        document.getElementById('date').addEventListener('change', function() {
            var selectedDate = this.value;
            fetch('/get-available-times?date=' + selectedDate)
                .then(response => response.json())
                .then(data => {
                    if (Array.isArray(data.startTimes) && Array.isArray(data.endTimes)) {
                        // Diziler ise, saat seçeneklerini güncelle
                        updateSelectOptions(data);
                        
                        // Başlangıç saati seçildiğinde minimum 20 dakika sonrası için bitiş saati seçimini yap
                        var selectedStartTime = document.getElementById('start_time').value;
                        var minEndTime = addMinutes(selectedStartTime, 20);
                        setMinimumEndTime(minEndTime);
                    } else {
                        console.error("Başlangıç ve bitiş saatleri diziler değil!");
                    }
                })
                .catch(error => {
                    console.error("Hata:", error);
                });
        });

        function updateSelectOptions(data) {
            var startTimeSelect = document.getElementById('start_time');
            var endTimeSelect = document.getElementById('end_time');

            // Seçenekleri temizle
            startTimeSelect.innerHTML = '';
            endTimeSelect.innerHTML = '';

            // Yeni seçenekleri ekle
            data.startTimes.forEach(function(time) {
                var option = new Option(time, time);
                startTimeSelect.add(option);
            });

            data.endTimes.forEach(function(time) {
                var option = new Option(time, time);
                endTimeSelect.add(option);
            });
        }

        document.getElementById('start_time').addEventListener('change', function() {
            var selectedStartTime = this.value;
            var endTimeSelect = document.getElementById('end_time');
            var minEndTime = addMinutes(selectedStartTime, 20);

            endTimeSelect.innerHTML = '';

            var endTimes = calculateEndTimes(minEndTime);
            endTimes.forEach(function(time) {
                var option = new Option(time, time);
                endTimeSelect.add(option);
            });
        });

        document.getElementById('end_time').addEventListener('change', function() {
            var selectedStartTime = document.getElementById('start_time').value;
            var selectedEndTime = this.value;

            var startHour = parseInt(selectedStartTime.split(':')[0]);
            var startMin = parseInt(selectedStartTime.split(':')[1]);

            var endHour = parseInt(selectedEndTime.split(':')[0]);
            var endMin = parseInt(selectedEndTime.split(':')[1]);

            var diffMinutes = (endHour * 60 + endMin) - (startHour * 60 + startMin);

            if (diffMinutes < 20) {
                // Eğer fark 20 dakikadan az ise, uygun bir bitiş saatini seçin
                var minEndTime = addMinutes(selectedStartTime, 20);
                setMinimumEndTime(minEndTime);
            }
        });


        function addMinutes(time, minutes) {
            var splitTime = time.split(':');
            var hours = parseInt(splitTime[0]);
            var mins = parseInt(splitTime[1]);

            mins += minutes;
            hours += Math.floor(mins / 60);
            mins = mins % 60;

            hours = hours % 24; 

            var formattedHours = ('0' + hours).slice(-2);
            var formattedMins = ('0' + mins).slice(-2);

            return formattedHours + ':' + formattedMins;
        }

        function setMinimumEndTime(minEndTime) {
            var endTimeSelect = document.getElementById('end_time');
            endTimeSelect.innerHTML = '';

            var endTimes = calculateEndTimes(minEndTime);
            endTimes.forEach(function(time) {
                var option = new Option(time, time);
                endTimeSelect.add(option);
            });
        }

        function calculateEndTimes(minEndTime) {
            var endTimes = [];
            var endHour = parseInt(minEndTime.split(':')[0]);
            var endMin = parseInt(minEndTime.split(':')[1]);

            for (var hour = endHour; hour <= 17; hour++) {
                for (var min = 0; min < 60; min += 10) {
                    if (!(hour === endHour && min < endMin)) {
                        var formattedHour = ('0' + hour).slice(-2);
                        var formattedMin = ('0' + min).slice(-2);
                        endTimes.push(formattedHour + ':' + formattedMin);
                    }
                }
            }

            return endTimes;
        }
    </script>
</body>
</html>
