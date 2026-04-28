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

/* ---------------- UI Events ---------------- */
dropZone.addEventListener("click", () => fileInput.click());

fileInput.addEventListener("change", () => {
    if (fileInput.files.length > 0) {
        fileName.textContent = fileInput.files[0].name;
    }
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

    if (fileInput.files.length > 0) {
        fileName.textContent = fileInput.files[0].name;
    }
});

/* ---------------- Upload ---------------- */
form.addEventListener("submit", function (e) {
    e.preventDefault();

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
            const resultBox = document.getElementById("resultBox");
            const fileLinkInput = document.getElementById("fileLink");
            const copyBtn = document.getElementById("copyBtn");

            resultBox.classList.remove("hidden");
            fileLinkInput.value = res.url;

            copyBtn.onclick = () => {
                navigator.clipboard.writeText(res.url);
                copyBtn.innerText = "Copied!";
                setTimeout(() => (copyBtn.innerText = "Copy"), 1500);
            };

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