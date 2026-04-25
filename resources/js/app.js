import './bootstrap';
import 'flowbite';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

/* ---------------- CSRF ---------------- */
const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

/* ---------------- Elements ---------------- */
const form = document.getElementById('uploadForm');
const dropZone = document.getElementById('dropZone');
const fileInput = document.getElementById('fileInput');
const fileName = document.getElementById('fileName');
const progressBar = document.getElementById('progressBar');
const status = document.getElementById('status');

/* ---------------- Click to select file ---------------- */
dropZone.addEventListener('click', () => fileInput.click());

/* ---------------- Show selected file ---------------- */
fileInput.addEventListener('change', () => {
    if (fileInput.files.length > 0) {
        fileName.textContent = fileInput.files[0].name;
    }
});

/* ---------------- Drag styling ---------------- */
dropZone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropZone.classList.add('border-primary-500');
});

dropZone.addEventListener('dragleave', () => {
    dropZone.classList.remove('border-primary-500');
});

/* ---------------- Drop file ---------------- */
dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropZone.classList.remove('border-primary-500');

    fileInput.files = e.dataTransfer.files;

    if (fileInput.files.length > 0) {
        fileName.textContent = fileInput.files[0].name;
    }
});

/* ---------------- Upload (AJAX) ---------------- */
form.addEventListener('submit', function (e) {
    e.preventDefault();

    const file = fileInput.files[0];

    if (!file) {
        status.innerHTML = "<span class='text-red-600'>Please select a file</span>";
        return;
    }

    status.innerHTML = "";

    const formData = new FormData(form);

    const xhr = new XMLHttpRequest();

    xhr.open('POST', '/upload', true);
    xhr.setRequestHeader('X-CSRF-TOKEN', token);

    /* ---------------- Progress ---------------- */
    xhr.upload.onprogress = function (e) {
        if (e.lengthComputable) {
            let percent = Math.round((e.loaded / e.total) * 100);
            progressBar.style.width = percent + '%';
            progressBar.innerText = percent + '%';
        }
    };

    /* ---------------- Response ---------------- */
    const resultBox = document.getElementById('resultBox');
    const fileLinkInput = document.getElementById('fileLink');
    const copyBtn = document.getElementById('copyBtn');

xhr.onload = function () {

    // Laravel validation error
    if (xhr.status === 422) {
        let res = JSON.parse(xhr.responseText);

        let msg = '';

        Object.keys(res.errors).forEach(key => {
            msg += res.errors[key][0] + '<br>';
        });

        status.innerHTML = `
            <div class="text-red-600">
                ${msg}
            </div>
        `;

        return;
    }

    // success
    if (xhr.status === 200) {

        let res = JSON.parse(xhr.responseText);

        resultBox.classList.remove('hidden');
        fileLinkInput.value = res.url;

        copyBtn.innerText = "Copy";

        copyBtn.onclick = function () {
            navigator.clipboard.writeText(fileLinkInput.value);
            this.innerText = "Copied!";
            setTimeout(() => this.innerText = "Copy", 1500);
        };

        // reset UI
        fileInput.value = '';
        fileName.textContent = '';
        progressBar.style.width = '0%';
        progressBar.innerText = '0%';

        status.innerHTML = '';
    }

    else {
        status.innerHTML = "<span class='text-red-600'>Upload failed!</span>";
    }
};

    xhr.onerror = function () {
        status.innerHTML = "<span class='text-red-600'>Network error</span>";
    };

    xhr.send(formData);
});