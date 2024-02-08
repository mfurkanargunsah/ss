 //Ses Kaydı
 document.addEventListener('DOMContentLoaded', function () {
    var startRecordingBtn = document.getElementById('startRecording');
    var stopRecordingBtn = document.getElementById('stopRecording');
    var playRecordingBtn = document.getElementById('playRecording');
    var audioPlayer = document.getElementById('audioPlayer');
    var recordingStatus = document.getElementById('recordingStatus');
    var mediaRecorder;
    var chunks = [];
    var startTime;
    var selectedMethod;

    function clearChunks() {
        // chunks dizisini temizle
        chunks = [];
    }

    startRecordingBtn.addEventListener('click', function () {
        // Eski kaydı temizle
        clearChunks();
        selectedMethod = 'record';

        // Kayıt başlatılıyor
        navigator.mediaDevices.getUserMedia({ audio: true })
            .then(function (stream) {
                mediaRecorder = new MediaRecorder(stream);
                startTime = Date.now();

                mediaRecorder.ondataavailable = function (e) {
                    if (e.data.size > 0) {
                        chunks.push(e.data);
                    }
                };

                mediaRecorder.onstop = function () {
                    var blob = new Blob(chunks, { type: 'audio/wav' });
                    var audioURL = URL.createObjectURL(blob);
                    audioPlayer.src = audioURL;

                    startRecordingBtn.classList.remove('hidden');
                    stopRecordingBtn.classList.add('hidden');
                    playRecordingBtn.classList.remove('hidden');
                    recordingStatus.textContent = '';

                    startRecordingBtn.disabled = false;
                    playRecordingBtn.disabled = false;
                };

                mediaRecorder.start();
                startRecordingBtn.classList.add('hidden');
                stopRecordingBtn.classList.remove('hidden');
                playRecordingBtn.classList.add('hidden');
                recordingStatus.textContent = 'Kayıt yapılıyor...';

                startRecordingBtn.disabled = true;
                playRecordingBtn.disabled = true;

                // Kayıt sırasında geçen süreyi gösteren sayaç
                var intervalId = setInterval(function () {
                    var elapsedTime = Math.floor((Date.now() - startTime) / 1000);
                    recordingStatus.textContent = 'Kayıt Süresi: ' + formatTime(elapsedTime);
                }, 1000);

                // Durdur butonuna tıklandığında setInterval'ı temizle
                stopRecordingBtn.addEventListener('click', function () {
                    clearInterval(intervalId);
                });
            })
            .catch(function (err) {
                console.error('Error accessing microphone:', err);
            });
    });

    stopRecordingBtn.addEventListener('click', function () {
        mediaRecorder.stop();
    });

    playRecordingBtn.addEventListener('click', function () {
        // Eski kaydı temizle
        clearChunks();

        audioPlayer.play();
    });

    // Dosyayı inputdan al (ses)
    var fileInput = document.getElementById('audio_input');
fileInput.addEventListener('change', function () {
    clearChunks();
    selectedMethod = 'file';
 
});

    // Zamanı biçimlendirme fonksiyonu
    function formatTime(seconds) {
        var minutes = Math.floor(seconds / 60);
        seconds = seconds % 60;
        return pad(minutes) + ':' + pad(seconds);
    }

    function pad(num) {
        return (num < 10 ? '0' : '') + num;
    }



    //Video İşlemleri

    var startVRecordingBtn = document.getElementById('startVRecording');
    var stopVRecordingBtn = document.getElementById('stopVRecording');
    var videoPlayer = document.getElementById('videoPlayer');
    var mediaVRecorder;
    var mediaVStream;
    var recordedChunks = [];
    var selectedMethod;

    function clearVChunks() {
        // chunks dizisini temizle
        recordedChunks = [];
    }

    startVRecordingBtn.addEventListener('click', startVRecording);
        stopVRecordingBtn.addEventListener('click', stopVRecording);
    
        function startVRecording() {
            navigator.mediaDevices.getUserMedia({ video: true, audio: true })
                .then(function (stream) {
                    clearVChunks();
                    mediaVStream = stream;
                    videoPlayer.srcObject = stream;
                 
                    selectedMethod = 'vrecord';

                    mediaVRecorder = new MediaRecorder(stream);
                 
    
                    mediaVRecorder.ondataavailable = function (e) {
                        if (e.data.size > 0) {
                            recordedChunks.push(e.data);
                       
                        }
                    };
    
                    mediaVRecorder.onstop = function () {
                        var blob = new Blob(recordedChunks, { type: 'video/webm' });
                        var videoURL = URL.createObjectURL(blob);
                        videoPlayer.src = videoURL;
                   
    
                        startVRecordingBtn.classList.remove('hidden');
                        stopVRecordingBtn.classList.add('hidden');
                        videoPlayer.controls = true; // Kayıt tamamlandığında controls'ü etkinleştir
                    };
    
                    mediaVRecorder.start();
                    startVRecordingBtn.classList.add('hidden');
                    stopVRecordingBtn.classList.remove('hidden');
                    videoPlayer.controls = false; // Kayıt başladığında controls'ü devre dışı bırak
                })
                .catch(function (err) {
                    console.error('Error accessing camera:', err);
                });
        }
    
        function stopVRecording() {
            if (mediaVRecorder && mediaVRecorder.state === 'recording') {
                mediaVRecorder.stop();
                mediaVStream.getTracks().forEach(function (track) {
                    track.stop();
                });
                videoPlayer.srcObject = null;
            }
        }

        







    //upload files (image/pdf)

document.getElementById("sendAllFiles").onclick = async () => {
    const formData = new FormData();
    const files = Object.values(FILES);


//Dosyaları Al
    files.forEach(file => {
        formData.append("files[]", file);
    });

    formData.append("textarea", document.getElementById("textarea").value);

    const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;


    try {
        const response = await fetch('/uploadFiles', {
            method: 'POST',
            body: formData,
            headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
        });
        
        if (response.ok) {
            selectReturn();
            console.log(response.json());

        } else {
            alert('Dosyalar yüklenirken bir hata oluştu.');
        }
    } catch (error) {
        console.error('Hata:', error);
    }
};
//end


 // Video kaydı ya da dosyasını controller'a gönder
 function sendToVController() {
    if (selectedMethod === 'vrecord') {
        var blob = new Blob(recordedChunks, { type: 'video/webm' });
        var videoData = new FormData();
        videoData.append('video', blob, 'recorded_video.webm');
        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

        fetch('/upload-video', {
            method: 'POST',
            body: videoData,
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
        })
        .then(response => response.json())
        .then(data => {
            console.log('Success:', data);
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    } else if (selectedMethod === 'vfile') {
        // Dosya seçilmişse, fileInput elementini kullanarak dosyayı gönder
        var fileInput = document.getElementById('video_input'); 
        var file = fileInput.files[0];
        var videoData = new FormData();
        videoData.append('video', file);
        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

        fetch('/upload-video', {
            method: 'POST',
            body: videoData,
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
        })
        .then(response => response.json())
        .then(data => {
            console.log('Success:', data);
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }
}





// Ses kaydı ya da dosyasını controller'a gönder
function sendToController() {
    if (selectedMethod === 'record') {
    // Kayıt yöntemi seçilmişse, chunks dizisini kullanarak ses kaydını gönder
    var blob = new Blob(chunks, { type: 'audio/wav' });
    var audioData = new FormData();
    audioData.append('audio', blob, 'recorded_audio.wav');
    const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

    fetch('/upload-audio', {
        method: 'POST',
        body: audioData,
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        },
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
    })
    .catch((error) => {
        console.error('Error:', error);
    });
    } else if (selectedMethod === 'file') {
    // Dosya seçilmişse, fileInput elementini kullanarak dosyayı gönder
    var fileInput = document.getElementById('audio_input');
    var file = fileInput.files[0];
    var audioData = new FormData();
    audioData.append('audio', file);
    const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;


    fetch('/upload-audio', {
        method: 'POST',
        body: audioData,
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        },
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
    })
    .catch((error) => {
        console.error('Error:', error);
    });
    }
    }
    

        // File upload button clicked
        var sendAllFilesButton = document.getElementById('sendAllFiles');

        if (sendAllFilesButton) {
            sendAllFilesButton.addEventListener('click', function () {
                sendToController();
                sendToVController()
            });
        }
    
    
    // Dosya Yükleme Kısmındaki İleri Butonu
    function selectReturn(){
    
        const step4 = document.getElementById('step4');
        const step5 = document.getElementById('step5');
    
        step4.classList.add('hidden');
        step5.classList.remove('hidden');
    }
});



