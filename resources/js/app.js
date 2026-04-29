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
const fileName = document.getElementById("fileName");
const progressBar = document.getElementById("progressBar");
const progressContainer = document.getElementById("progressContainer");
const status = document.getElementById("status");

const uploadBox = document.getElementById("uploadBox");
const settingsBox = document.getElementById("settingsBox");
const resultBox = document.getElementById("resultBox");


/* ---------------- State System ---------------- */
function setState(state) {
    uploadBox.classList.add("hidden");
    settingsBox.classList.add("hidden");
    resultBox.classList.add("hidden");

    if (state === "upload") uploadBox.classList.remove("hidden");
    if (state === "settings") settingsBox.classList.remove("hidden");
    if (state === "result") resultBox.classList.remove("hidden");
}

/* ---------------- UI Events ---------------- */
dropZone.addEventListener("click", () => fileInput.click());

let selectedFiles = [];

fileInput.addEventListener("change", () => {
    selectedFiles = [...selectedFiles, ...fileInput.files];

    updateFileList();
});

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


// add more
const addMoreBtn = document.getElementById("addMoreBtn");

addMoreBtn.addEventListener("click", (e) => {
    e.stopPropagation();
    fileInput.click();
});

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

    fileInput.files = e.dataTransfer.files;

    const fileList = document.getElementById("fileList");
    fileList.innerHTML = "";

    Array.from(fileInput.files).forEach(file => {
        const p = document.createElement("p");
        p.textContent = file.name;
        fileList.appendChild(p);
    });
});

/* ---------------- NEXT BUTTON (FIXED) ---------------- */
document.getElementById("nextBtn").addEventListener("click", () => {
    if (!fileInput.files.length) {
        alert("Select a file first");
        return;
    }

    setState("settings");
});

/* ---------------- BACK BUTTON (FIXED) ---------------- */
document.getElementById("backBtn").addEventListener("click", () => {
    setState("upload");
});

/* ---------------- Upload ---------------- */
form.addEventListener("submit", function (e) {
    e.preventDefault();


// New Transfer
document.getElementById("newTransferBtn")?.addEventListener("click", () => {
    form.reset();

    selectedFiles = [];          
    updateFileList();            // clear UI

    fileInput.value = "";
    progressContainer.classList.add("hidden");
    status.innerHTML = "";

    setState("upload");
});


    const file = fileInput.files[0];

    const allowedTypes = [
        "image/jpeg",
        "image/png",
        "application/pdf",
        "application/zip",
        "application/x-zip-compressed",
        "text/plain",
    ];

    if (!file) {
        status.innerHTML = "Please select a file";
        return;
    }

    const isValid =
        allowedTypes.includes(file.type) || file.name.endsWith(".zip");

    if (!isValid) {
        status.innerHTML = "Invalid file type";
        return;
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
                Object.values(res.errors).flat().join("<br>");
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

            // reset UI
            fileInput.value = "";
            fileName.textContent = "";
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

