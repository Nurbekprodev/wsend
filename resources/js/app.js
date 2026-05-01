import "./bootstrap";
import "flowbite";
import Alpine from "alpinejs";

window.Alpine = Alpine;
Alpine.start();

/* ---------------- CSRF ---------------- */
const token = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");

/* ---------------- Elements ---------------- */
const form = document.getElementById("uploadForm");
const dropZone = document.getElementById("dropZone");
const fileInput = document.getElementById("fileInput");
const progressBar = document.getElementById("progressBar");
const progressContainer = document.getElementById("progressContainer");
const status = document.getElementById("status");

const uploadBox = document.getElementById("uploadBox");
const settingsBox = document.getElementById("settingsBox");
const resultBox = document.getElementById("resultBox");

/* ---------------- Config ---------------- */
const MAX_TOTAL_SIZE = 200 * 1024 * 1024; // matches backend max
const MAX_FILES = 20;

/* ---------------- State System ---------------- */
function setState(state) {
    uploadBox.classList.add("hidden");
    settingsBox.classList.add("hidden");
    resultBox.classList.add("hidden");

    if (state === "upload") uploadBox.classList.remove("hidden");
    if (state === "settings") settingsBox.classList.remove("hidden");
    if (state === "result") resultBox.classList.remove("hidden");
}

/* ---------------- State ---------------- */
let selectedFiles = [];

/* ---------------- Helpers ---------------- */
function updateFileList() {
    const fileList = document.getElementById("fileList");
    fileList.innerHTML = "";

    selectedFiles.forEach(file => {
        const p = document.createElement("p");
        p.textContent = file.name;
        fileList.appendChild(p);
    });

    const dt = new DataTransfer();
    selectedFiles.forEach(f => dt.items.add(f));
    fileInput.files = dt.files;
}

/* ---------------- UI Events ---------------- */

// Click dropzone
dropZone.addEventListener("click", () => fileInput.click());

// File select
fileInput.addEventListener("change", () => {
    const newFiles = Array.from(fileInput.files);

    // prevent duplicates
    const filtered = newFiles.filter(f =>
        !selectedFiles.some(sf => sf.name === f.name && sf.size === f.size)
    );

    selectedFiles = [...selectedFiles, ...filtered];

    if (selectedFiles.length > MAX_FILES) {
        status.innerHTML = "Max 20 files allowed";
        selectedFiles = selectedFiles.slice(0, MAX_FILES);
    }

    updateFileList();
});

// Add more
document.getElementById("addMoreBtn").addEventListener("click", (e) => {
    e.stopPropagation();
    fileInput.click();
});

// Drag & drop
dropZone.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropZone.classList.add("border-primary-500");
});

dropZone.addEventListener("dragleave", () => {
    dropZone.classList.remove("border-primary-500");
});

dropZone.addEventListener("drop", (e) => {
    e.preventDefault();
    dropZone.classList.remove("border-primary-500");

    const dropped = Array.from(e.dataTransfer.files);

    const filtered = dropped.filter(f =>
        !selectedFiles.some(sf => sf.name === f.name && sf.size === f.size)
    );

    selectedFiles = [...selectedFiles, ...filtered];

    if (selectedFiles.length > MAX_FILES) {
        status.innerHTML = "Max 20 files allowed";
        selectedFiles = selectedFiles.slice(0, MAX_FILES);
    }

    updateFileList();
});

// Next
document.getElementById("nextBtn").addEventListener("click", () => {
    if (!fileInput.files.length) {
        status.innerHTML = "Select at least one file";

        dropZone.style.borderColor = "red";
        // dropZone.style.boxShadow = "0 0 0 3px rgba(239, 68, 68, 0.3)";

        setTimeout(() => {
            dropZone.style.borderColor = "";
            dropZone.style.boxShadow = "";
        }, 1500);

        return;
    }

    status.innerHTML = "";
    setState("settings");
});

// Back
document.getElementById("backBtn").addEventListener("click", () => {
    setState("upload");
});

// New transfer
document.getElementById("newTransferBtn")?.addEventListener("click", () => {
    form.reset();
    selectedFiles = [];
    updateFileList();

    fileInput.value = "";
    progressContainer.classList.add("hidden");
    status.innerHTML = "";

    setState("upload");
});

/* ---------------- Upload ---------------- */
form.addEventListener("submit", function (e) {
    e.preventDefault();

    const files = fileInput.files;

    if (!files.length) {
        status.innerHTML = "Please select at least one file";
        return;
    }

    const blockedExtensions = [
        "exe","bat","cmd","sh","php","js",
        "msi","dll","com","scr","vbs","jar"
    ];

    // total size
    const totalSize = selectedFiles.reduce((sum, f) => sum + f.size, 0);
    if (totalSize > MAX_TOTAL_SIZE) {
        status.innerHTML = "Total upload exceeds limit";
        return;
    }

    for (let file of files) {

        if (file.size > 10 * 1024 * 1024) {
            status.innerHTML = `File too large: ${file.name} (max 10MB)`;
            return;
        }

        const ext = file.name.split('.').pop().toLowerCase();

        if (blockedExtensions.includes(ext)) {
            status.innerHTML = `File type not allowed: ${file.name}`;
            return;
        }
    }

    status.innerHTML = "";

    const submitBtn = form.querySelector('button[type="submit"]');
    submitBtn.disabled = true;
    submitBtn.innerText = "Uploading...";

    progressContainer.classList.remove("hidden");

    const formData = new FormData(form);
    const xhr = new XMLHttpRequest();

    xhr.open("POST", form.action, true);
    xhr.setRequestHeader("X-CSRF-TOKEN", token);

    xhr.upload.onprogress = function (e) {
        if (e.lengthComputable) {
            const percent = Math.round((e.loaded / e.total) * 100);
            progressBar.style.width = percent + "%";
            progressBar.innerText = percent + "%";
        }
    };

    xhr.onload = function () {
        submitBtn.disabled = false;
        submitBtn.innerText = "Upload & Get Link";

        let res = {};
        try {
            res = JSON.parse(xhr.responseText);
        } catch (e) {}

        if (xhr.status === 401) {
            window.location.href = "/login";
            return;
        }

        if (xhr.status === 422) {
            status.innerHTML =
                Object.values(res.errors || {}).flat().join("<br>");
            return;
        }

        if (xhr.status === 200) {

            const fileLinkInput = document.getElementById("fileLink");
            const copyBtn = document.getElementById("copyBtn");

            fileLinkInput.value = res.url;

            setState("result");

            copyBtn.onclick = () => {
                navigator.clipboard.writeText(res.url);
                copyBtn.innerText = "Copied!";
                setTimeout(() => (copyBtn.innerText = "Copy"), 1500);
            };

            // reset
            fileInput.value = "";
            progressContainer.classList.add("hidden");
            status.innerHTML = "";
        }
    };

    xhr.onerror = function () {
        status.innerHTML = "Network error";
        submitBtn.disabled = false;
        submitBtn.innerText = "Upload & Get Link";
    };

    xhr.send(formData);
});

/* ---------------- INIT ---------------- */
setState("upload");