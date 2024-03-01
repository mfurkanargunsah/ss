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
    var selectedAMethod;


    function openModal() {
       
        document.getElementById('loadingModal').classList.remove('hidden');       
       }
       
       function closeModal() {
                  // Hata durumunda da modalı gizle
                  document.getElementById('loadingModal').classList.add('hidden');
       }

    function clearChunks() {
        // chunks dizisini temizle
        chunks = [];
    }

    startRecordingBtn.addEventListener('click', function () {
        // Eski kaydı temizle
        clearChunks();
        selectedAMethod = 'record';

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
    selectedAMethod = 'file';
 
});

  // Dosyayı inputdan al (video)
  var vfileInput = document.getElementById('video_input');
  vfileInput.addEventListener('change', function () {
      clearChunks();
      selectedVMethod = 'vfile';
   
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
    var selectedVMethod;

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
                 
                    selectedVMethod = 'vrecord';

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
                   
                      // Kayıt tamamlandığında boyutu göster
                          showVideoSize();
                          
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
        
        function showVideoSize() {
            // Kaydedilen chunk'ların boyutunu topla
            var totalSize = recordedChunks.reduce(function (acc, chunk) {
                return acc + chunk.size;
            }, 0);
        
            // Boyutu hesapla (megabyte cinsinden)
            var sizeInMb = totalSize / (1024 * 1024);
        
            // Kaydedilen video boyutunu göstermek için div'i güncelle
            var videoSizeDiv = document.getElementById('videoSizeMessage');
            var videoSizeSpan = document.getElementById('videoSize');
            videoSizeSpan.textContent = sizeInMb.toFixed(2);
        
            // Div'i görünür yap
            videoSizeDiv.classList.remove('hidden');
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


       
        

// Dosya yükleme işlemi
async function uploadFiles(formData) {
    return new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();
        
           // İlerleme durumu izleyicisi
        xhr.upload.addEventListener("progress", (event) => {
            const progressBar = document.getElementById("progressBar");
            const log = document.getElementById("progressText");

            if (event.lengthComputable) {
                progressBar.value = event.loaded; // İlerleme çubuğunu güncelle
                log.textContent = `Yükleniyor (${((event.loaded / event.total) * 100).toFixed(2)}%)…`; // İlerleme mesajını güncelle
            }
            else{
                console.warn("İlerleme durumu hesaplanamıyor.");
            }
        });

        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
        

        xhr.open("POST", "/uploadFiles");
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        xhr.send(formData);
        xhr.onload = () => {
            if (xhr.status >= 200 && xhr.status < 300) {
                resolve(xhr.responseText);
            } else {
                reject(xhr.statusText);
            }
        };
        xhr.onerror = () => reject(xhr.statusText);
    });
}





   // Dosyaları yükleme işlemi
document.getElementById("sendAllFiles").onclick = async () => {
    openModal();
    try {
        await Promise.all([sendToController(), sendToVController()]);

        const formData = new FormData();
        const files = Object.values(FILES);

        // Dosyaları FormData'ya ekle
        files.forEach(file => {
            formData.append("files[]", file);
        });
        formData.append("textarea", document.getElementById("textarea").value);

   

        // Dosyaları yükleme işlemi
  
            const response = await uploadFiles(formData);
        closeModal();
        selectReturn();
        console.log(response); 
    } catch (error) {
        console.error('Hata:', error);
        closeModal();
    }
};
//end



 // Video kaydı ya da dosyasını controller'a gönder
 async function sendToVController() {

    
    if (selectedVMethod === 'vrecord') {
        var blob = new Blob(recordedChunks, { type: 'video/webm' });
        var videoData = new FormData();
        videoData.append('video', blob, 'recorded_video.webm');
        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

        try {
            const response = await fetch('/upload-video', {
                method: 'POST',
                body: videoData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
            });
            const data = await response.json();
            console.log('Success:', data);
      
        } catch (error) {
            console.error('Error:', error);
          
        }
    } else if (selectedVMethod === 'vfile') {
        // Dosya seçilmişse, fileInput elementini kullanarak dosyayı gönder
        var fileInput = document.getElementById('video_input'); 
        var file = fileInput.files[0];
        var videoData = new FormData();
        videoData.append('video', file,file.name);
        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

        try {
            const response = await fetch('/upload-video', {
                method: 'POST',
                body: videoData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
            });
            const data = await response.json();
            console.log('Success:', data);
      
        } catch (error) {
            console.error('Error:', error);
        
        }
    }
}





// Ses kaydı ya da dosyasını controller'a gönder
async function sendToController() {
    if (selectedAMethod === 'record') {
        // Kayıt yöntemi seçilmişse, chunks dizisini kullanarak ses kaydını gönder
        var blob = new Blob(chunks, { type: 'audio/wav' });
        var audioData = new FormData();
        audioData.append('audio', blob, 'recorded_audio.wav');
        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

        try {
            const response = await fetch('/upload-audio', {
                method: 'POST',
                body: audioData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
            });
            const data = await response.json();
            console.log('Success:', data);
      
        } catch (error) {
            console.error('Error:', error);
         
        }
    } else if (selectedAMethod === 'file') {
        // Dosya seçilmişse, fileInput elementini kullanarak dosyayı gönder
        var fileInput = document.getElementById('audio_input');
        var file = fileInput.files[0];
        var audioData = new FormData();
        audioData.append('audio', file);
        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

        try {
            const response = await fetch('/upload-audio', {
                method: 'POST',
                body: audioData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
            });
            const data = await response.json();
            console.log('Success:', data);
      
        } catch (error) {
            console.error('Error:', error);
           
        }
    }
}

    
    
    // Dosya Yükleme Kısmındaki İleri Butonu
    function selectReturn(){
    
        const step4 = document.getElementById('requestForms');
        const step5 = document.getElementById('step5');
    
        step4.classList.add('hidden');
        step5.classList.remove('hidden');
    }
});



