document.addEventListener('DOMContentLoaded', function () {
    const startRecordingBtn = document.getElementById('startRecording');
    const stopRecordingBtn = document.getElementById('stopRecording');
    const playRecordingBtn = document.getElementById('playRecording');
    const audioPlayer = document.getElementById('audioPlayer');
    const recordingStatus = document.getElementById('recordingStatus');
    let mediaRecorder;
    let chunks = [];
    let startTime;
    let selectedAMethod;

    const openModal = () => document.getElementById('loadingModal').classList.remove('hidden');
    const closeModal = () => document.getElementById('loadingModal').classList.add('hidden');
    const clearChunks = () => chunks = [];

    const formatTime = (seconds) => {
        const minutes = Math.floor(seconds / 60);
        seconds = seconds % 60;
        return pad(minutes) + ':' + pad(seconds);
    }

    const pad = (num) => (num < 10 ? '0' : '') + num;

    const startRecording = () => {
        clearChunks();
        selectedAMethod = 'record';

        navigator.mediaDevices.getUserMedia({ audio: true })
            .then(stream => {
                mediaRecorder = new MediaRecorder(stream);
                startTime = Date.now();

                mediaRecorder.ondataavailable = (e) => {
                    if (e.data.size > 0) {
                        chunks.push(e.data);
                    }
                };

                mediaRecorder.onstop = () => {
                    const blob = new Blob(chunks, { type: 'audio/wav' });
                    const audioURL = URL.createObjectURL(blob);
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

                const intervalId = setInterval(() => {
                    const elapsedTime = Math.floor((Date.now() - startTime) / 1000);
                    recordingStatus.textContent = 'Kayıt Süresi: ' + formatTime(elapsedTime);
                }, 1000);

                stopRecordingBtn.addEventListener('click', () => clearInterval(intervalId));
            })
            .catch(err => console.error('Error accessing microphone:', err));
    };

    const stopRecording = () => mediaRecorder.stop();

    const playRecording = () => {
        clearChunks();
        audioPlayer.play();
    };

    startRecordingBtn.addEventListener('click', startRecording);
    stopRecordingBtn.addEventListener('click', stopRecording);
    playRecordingBtn.addEventListener('click', playRecording);

    // Dosya yükleme işlemi
    const uploadFiles = async (formData) => {
        return new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();
            
            xhr.upload.addEventListener("progress", (event) => {
                const progressBar = document.getElementById("progressBar");
                const log = document.getElementById("progressText");
    
                if (event.lengthComputable) {
                    progressBar.value = event.loaded;
                    log.textContent = `Yükleniyor (${((event.loaded / event.total) * 100).toFixed(2)}%)…`;
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
    };

    const sendToVController = async () => {
        if (selectedVMethod === 'vrecord') {
            const blob = new Blob(recordedChunks, { type: 'video/webm' });
            const videoData = new FormData();
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
            const fileInput = document.getElementById('video_input'); 
            const file = fileInput.files[0];
            const videoData = new FormData();
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
    };

    const sendToController = async () => {
        if (selectedAMethod === 'record') {
            const blob = new Blob(chunks, { type: 'audio/wav' });
            const audioData = new FormData();
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
            const fileInput = document.getElementById('audio_input');
            const file = fileInput.files[0];
            const audioData = new FormData();
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
    };

    const selectReturn = () => {
        const step4 = document.getElementById('step4');
        const step5 = document.getElementById('step5');
    
        step4.classList.add('hidden');
        step5.classList.remove('hidden');
    };

    const fileInput = document.getElementById('audio_input');
    fileInput.addEventListener('change', () => {
        clearChunks();
        selectedAMethod = 'file';
    });

    const vfileInput = document.getElementById('video_input');
    vfileInput.addEventListener('change', () => {
        clearChunks();
        selectedVMethod = 'vfile';
    });

    document.getElementById("sendAllFiles").onclick = async () => {
        openModal();
        try {
            await Promise.all([sendToController(), sendToVController()]);

            const formData = new FormData();
            const files = Object.values(FILES);
    
            files.forEach(file => {
                formData.append("files[]", file);
            });
            formData.append("textarea", document.getElementById("textarea").value);
    
            const response = await uploadFiles(formData);
            closeModal();
            selectReturn();
            console.log(response); 
        } catch (error) {
            console.error('Hata:', error);
            closeModal();
        }
    };
});
