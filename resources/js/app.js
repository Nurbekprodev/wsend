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
const progressContainer = document.getElementById('progressContainer');
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

    // clien-side validation before upload
    const allowedTypes = [
        "image/jpeg",
        "image/png",
        "application/pdf",
        "application/zip",
        "application/x-zip-compressed",
        "application/octet-stream",
        "text/plain"
    ];

    if (!file) {
        status.innerHTML = "<span class='text-red-600'>Please select a file</span>";
        return;
    }


    if (!allowedTypes.includes(file.type)) {
        status.innerHTML = "Invalid file type";
        return;
    }

    if (file.size > 10 * 1024 * 1024) {
        status.innerHTML = "File too large (max 10MB)";
        return;
    }


    status.innerHTML = "";

    const submitBtn = form.querySelector('button[type="submit"]');
    submitBtn.disabled = true;
    submitBtn.innerText = "Uploading...";

    progressContainer.classList.remove('hidden');

    const formData = new FormData(form);

    const xhr = new XMLHttpRequest();

    xhr.open('POST', form.action, true);
    xhr.setRequestHeader('X-CSRF-TOKEN', token);

    /* ---------------- Progress ---------------- */
    xhr.upload.onprogress = function (e) {
        if (e.lengthComputable) {
            const percent = Math.round((e.loaded / e.total) * 100);
            progressBar.style.width = percent + '%';
            progressBar.innerText = percent + '%';
        }
    };


    /* ---------------- Response ---------------- */
    xhr.onload = function () {

        submitBtn.disabled = false;
        submitBtn.innerText = "Upload & Get Link";

        let res;
        try {
            res = JSON.parse(xhr.responseText);
        } catch (e) {
            status.innerHTML = "<span class='text-red-600'>Server error</span>";
            return;
        }

        // unauthenticated
        if (xhr.status === 401) {
            window.location.href = "/login";
            return;
        }

        // too many requests
        if (xhr.status === 429) {
            status.innerHTML = "<span class='text-red-600'>Too many uploads. Try again later.</span>";
            return;
        }

        // validation errors
        if (xhr.status === 422) {
            status.innerHTML =
                "<span class='text-red-600'>" +
                Object.values(res.errors).flat().join("<br>") +
                "</span>";
            return;
        }

        // success
        if (xhr.status === 200) {

            const resultBox = document.getElementById('resultBox');
            const fileLinkInput = document.getElementById('fileLink');
            const copyBtn = document.getElementById('copyBtn');

            resultBox.classList.remove('hidden');
            fileLinkInput.value = res.url;

            copyBtn.innerText = "Copy";

            copyBtn.onclick = function () {
                navigator.clipboard.writeText(fileLinkInput.value);
                this.innerText = "Copied!";
                setTimeout(() => this.innerText = "Copy", 1500);
            };

            fileInput.value = '';
            fileName.textContent = '';

            progressBar.style.width = '0%';
            progressBar.innerText = '0%';

            progressContainer.classList.add('hidden');

            status.innerHTML = '';
            return;
        }

        status.innerHTML = "<span class='text-red-600'>Upload failed!</span>";
    };

    xhr.onerror = function () {
        submitBtn.disabled = false;
        submitBtn.innerText = "Upload & Get Link";
        status.innerHTML = "<span class='text-red-600'>Network error</span>";
    };

    xhr.send(formData);
});

