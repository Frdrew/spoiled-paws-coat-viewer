/**
 * SPOILED PAWS – Coat UI Controller
 * Handles:
 *  - Breed loading
 *  - Size scaling
 *  - Coat placeholder loading
 *  - Silhouette switching
 *  - Talking to viewer-3d.js
 */

console.log("%c[SPOILED-PAWS] coat-ui.js loaded", "color:#00cfff;font-weight:bold;");

const SPCV = {
    activeBreed: null,
    activeSize: null,
    activeCoat: null,
    silhouettes: {},
    coatImages: [],
    viewer: null
};

document.addEventListener("DOMContentLoaded", initCoatUI);

async function initCoatUI() {
    console.log("🐾 Coat UI initializing…");

    await loadBreeds();
    await loadSilhouettes();
    await loadCoats();

    setupBreedSelector();
    setupSizeSelector();
    setupCoatSelector();

    await startViewer();
}

/* ---------------------------------------------------------
   LOADERS
------------------------------------------------------------ */

async function loadBreeds() {
    const res = await fetch(spcv_vars.plugin_url + "assets/images/breeds.json");
    SPCV.breeds = await res.json();
}

async function loadSilhouettes() {
    const res = await fetch(spcv_vars.plugin_url + "assets/images/manifest.json");
    const json = await res.json();
    SPCV.silhouettes = json.silhouettes;
}

async function loadCoats() {
    const res = await fetch(spcv_vars.plugin_url + "assets/images/placeholder/coat-placeholder-list.json")
        .catch(() => null);

    if (res) {
        SPCV.coatImages = await res.json();
    } else {
        // fallback auto-scan
        SPCV.coatImages = [
            "coat-placeholder-01.svg",
            "coat-placeholder-02.svg",
            "coat-placeholder-03.svg",
            "coat-placeholder-04.svg",
            "coat-placeholder-05.svg",
            "coat-placeholder-06.svg",
            "coat-placeholder-07.svg",
            "coat-placeholder-08.svg",
            "coat-placeholder-09.svg",
            "coat-placeholder-10.svg"
        ];
    }
}

/* ---------------------------------------------------------
   SETUP UI HANDLERS
------------------------------------------------------------ */

function setupBreedSelector() {
    const select = document.querySelector(".spcv-breed-select");
    if (!select) return;

    Object.keys(SPCV.breeds).forEach(breed => {
        const opt = document.createElement("option");
        opt.value = breed;
        opt.textContent = SPCV.breeds[breed].label;
        select.appendChild(opt);
    });

    select.addEventListener("change", e => {
        SPCV.activeBreed = e.target.value;
        updateSilhouette();
        updateViewer();
    });
}

function setupSizeSelector() {
    const select = document.querySelector(".spcv-size-select");
    if (!select) return;

    ["XS", "S", "M", "L", "XL"].forEach(size => {
        const opt = document.createElement("option");
        opt.value = size;
        opt.textContent = size;
        select.appendChild(opt);
    });

    select.addEventListener("change", e => {
        SPCV.activeSize = e.target.value;
        updateViewer();
    });
}

function setupCoatSelector() {
    const grid = document.querySelector(".spcv-coat-grid");
    if (!grid) return;

    SPCV.coatImages.forEach(file => {
        const el = document.createElement("div");
        el.className = "spcv-coat-swatch";
        el.dataset.coat = file;

        el.innerHTML = `
            <img src="${spcv_vars.plugin_url}assets/images/placeholder/${file}" />
        `;

        el.addEventListener("click", () => {
            SPCV.activeCoat = file;
            updateViewer();
        });

        grid.appendChild(el);
    });
}

/* ---------------------------------------------------------
   VIEWER INITIALIZATION
------------------------------------------------------------ */

async function startViewer() {
    console.log("🎥 Starting 3D viewer…");

    const el = document.getElementById("spcv-3d-viewer");
    SPCV.viewer = new SPCV_ThreeViewer(el);

    // Load initial neutral dog
    updateViewer();
}

/* ---------------------------------------------------------
   UPDATE VIEWER
------------------------------------------------------------ */

function updateSilhouette() {
    if (!SPCV.activeBreed) return;

    const data = SPCV.silhouettes[SPCV.activeBreed];
    if (!data) return;

    SPCV.viewer.setSilhouette({
        front: spcv_vars.plugin_url + "assets/images/silhouettes/svg/" + data.front,
        left: spcv_vars.plugin_url + "assets/images/silhouettes/svg/" + data.left,
        right: spcv_vars.plugin_url + "assets/images/silhouettes/svg/" + data.right
    });
}

function updateViewer() {
    if (!SPCV.viewer) return;

    const breed = SPCV.activeBreed || "default";
    const size  = SPCV.activeSize  || "M";

    SPCV.viewer.updateDog({
        breed,
        size,
        coat: SPCV.activeCoat ? spcv_vars.plugin_url + "assets/images/placeholder/" + SPCV.activeCoat : null
    });
}
