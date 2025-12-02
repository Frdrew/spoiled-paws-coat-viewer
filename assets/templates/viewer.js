/**
 * Spoiled Paws Coat Viewer
 * Rotation + Dynamic Silhouettes + Dynamic Coat Overlays
 */

document.addEventListener("DOMContentLoaded", async () => {

    const silSelect = document.getElementById("spcv-silhouette-select");
    const coatSelect = document.getElementById("spcv-coat-select");

    const silImg = document.getElementById("spcv-silhouette");
    const coatImg = document.getElementById("spcv-coat");

    // Rotation: front, left, right
    let currentRotation = "front";

    // -------------------------------------------------------------------------
    // LOAD LISTS FROM API
    // -------------------------------------------------------------------------

    const silhouettes = await fetch(SPCV_DATA.api.silhouettes).then(r => r.json());
    const coats       = await fetch(SPCV_DATA.api.coats).then(r => r.json());

    // -------------------------------------------------------------------------
    // POPULATE SELECTS
    // -------------------------------------------------------------------------

    silhouettes.forEach(name => {
        const opt = document.createElement("option");
        opt.value = name.replace(".svg", "");
        opt.textContent = opt.value;
        silSelect.appendChild(opt);
    });

    coats.forEach(name => {
        const opt = document.createElement("option");
        opt.value = name;
        opt.textContent = name.replace(".png", "");
        coatSelect.appendChild(opt);
    });

    // -------------------------------------------------------------------------
    // HELPER: UPDATE VIEW
    // rotation-aware silhouette filenames:
    //    dog-01-front.svg
    //    dog-01-left.svg
    //    dog-01-right.svg
    // -------------------------------------------------------------------------

    function updateViewer() {
        const silBase = silSelect.value;
        const coatFile = coatSelect.value;

        if (silBase) {
            silImg.src =
                `${SPCV_DATA.assets.silhouettes}${silBase}-${currentRotation}.svg`;
        }

        if (coatFile) {
            // coat files stored as:
            //    coat01-front.png
            //    coat01-left.png
            //    coat01-right.png
            let coatBase = coatFile.replace(".png", "");
            coatImg.src =
                `${SPCV_DATA.assets.coats}${coatBase}-${currentRotation}.png`;
        }
    }

    // -------------------------------------------------------------------------
    // SELECT LISTENERS
    // -------------------------------------------------------------------------

    silSelect.addEventListener("change", updateViewer);
    coatSelect.addEventListener("change", updateViewer);

    // -------------------------------------------------------------------------
    // ROTATION BUTTONS
    // -------------------------------------------------------------------------

    function createRotationButtons() {

        const controls = document.querySelector(".spcv-controls");

        const wrap = document.createElement("div");
        wrap.className = "spcv-rotation-buttons";

        ["front", "left", "right"].forEach(pos => {
            const btn = document.createElement("button");
            btn.textContent = pos.toUpperCase();
            btn.dataset.rot = pos;

            btn.addEventListener("click", () => {
                currentRotation = pos;
                updateViewer();
            });

            wrap.appendChild(btn);
        });

        controls.appendChild(wrap);
    }

    createRotationButtons();

    // Initial load
    updateViewer();
});
