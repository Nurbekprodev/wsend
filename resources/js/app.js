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

const uploadStatus = document.getElementById("uploadStatus");
const settingsStatus = document.getElementById("settingsStatus");

const uploadBox = document.getElementById("uploadBox");
const settingsBox = document.getElementById("settingsBox");
const resultBox = document.getElementById("resultBox");

/* ---------------- Config ---------------- */
const MAX_TOTAL_SIZE = 200 * 1024 * 1024;
const MAX_FILES = 20;

/* ---------------- State System ---------------- */
let currentStep = uploadBox;

function setState(state) {
    const boxes = {
        upload: uploadBox,
        settings: settingsBox,
        result: resultBox
    };

    const next = boxes[state];

    if (currentStep === next) return;

    currentStep.classList.remove("step-visible");
    currentStep.classList.add("step-hidden");

    next.classList.remove("step-hidden");

    requestAnimationFrame(() => {
        next.classList.add("step-visible");
    });

    currentStep = next;
}

/* ---------------- State ---------------- */
let selectedFiles = [];

/* ---------------- Helpers ---------------- */
function updateFileList() {
    const fileList = document.getElementById("fileList");
    fileList.innerHTML = "";

    selectedFiles.forEach((file, index) => {
        const row = document.createElement("div");
        row.className = "flex justify-between items-center";

        const name = document.createElement("span");
        name.textContent = file.name;

        const removeBtn = document.createElement("button");
        removeBtn.textContent = "✕";
        removeBtn.type = "button";
        removeBtn.className = "text-red-500 text-sm ml-2";

        removeBtn.onclick = () => {
            selectedFiles.splice(index, 1);
            updateFileList();
        };

        row.appendChild(name);
        row.appendChild(removeBtn);
        fileList.appendChild(row);
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

    const filtered = newFiles.filter(f =>
        !selectedFiles.some(sf => sf.name === f.name && sf.size === f.size)
    );

    selectedFiles = [...selectedFiles, ...filtered];

    if (selectedFiles.length > MAX_FILES) {
        uploadStatus.innerHTML = "Max 20 files allowed";
        selectedFiles = selectedFiles.slice(0, MAX_FILES);
    } else {
        uploadStatus.innerHTML = "";
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
        uploadStatus.innerHTML = "Max 20 files allowed";
        selectedFiles = selectedFiles.slice(0, MAX_FILES);
    } else {
        uploadStatus.innerHTML = "";
    }

    updateFileList();
});

// Next
document.getElementById("nextBtn").addEventListener("click", () => {
    if (!fileInput.files.length) {
        uploadStatus.innerHTML = "Select at least one file";

        dropZone.style.borderColor = "red";

        setTimeout(() => {
            dropZone.style.borderColor = "";
            uploadStatus.innerHTML = "";
        }, 1500);

        return;
    }

    uploadStatus.innerHTML = "";
    settingsStatus.innerHTML = "";

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

    uploadStatus.innerHTML = "";
    settingsStatus.innerHTML = "";

    setState("upload");
});

/* ---------------- Upload ---------------- */
form.addEventListener("submit", function (e) {
    e.preventDefault();

    const files = fileInput.files;

    if (!files.length) {
        settingsStatus.innerHTML = "Please select at least one file";
        return;
    }

    const blockedExtensions = [
        "exe","bat","cmd","sh","php","js",
        "msi","dll","com","scr","vbs","jar"
    ];

    const totalSize = selectedFiles.reduce((sum, f) => sum + f.size, 0);
    if (totalSize > MAX_TOTAL_SIZE) {
        settingsStatus.innerHTML = "Total upload exceeds limit";
        return;
    }

    for (let file of files) {

        if (file.size > 10 * 1024 * 1024) {
            settingsStatus.innerHTML = `File too large: ${file.name} (max 10MB)`;
            return;
        }

        const ext = file.name.split('.').pop().toLowerCase();

        if (blockedExtensions.includes(ext)) {
            settingsStatus.innerHTML = `File type not allowed: ${file.name}`;
            return;
        }
    }

    settingsStatus.innerHTML = "";

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
            settingsStatus.innerHTML =
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

            fileInput.value = "";
            progressContainer.classList.add("hidden");
            settingsStatus.innerHTML = "";
        }
    };

    xhr.onerror = function () {
        settingsStatus.innerHTML = "Network error";
        submitBtn.disabled = false;
        submitBtn.innerText = "Upload & Get Link";
    };

    xhr.send(formData);
});

/* ---------------- INIT ---------------- */
setState("upload");