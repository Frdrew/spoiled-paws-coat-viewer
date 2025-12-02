/**
 * Coat Viewer — Master Controller
 */

window.CoatViewer = {
    async init(cfg) {
        this.cfg = cfg;

        // Load JSON config
        const coats   = await CVLoader.loadJSON(this._attr("data-coats"));
        const breeds  = await CVLoader.loadJSON(this._attr("data-breeds"));
        const sizes   = await CVLoader.loadJSON(this._attr("data-sizes"));
        const stitches = await CVLoader.loadJSON(this._attr("data-stitches"));
        const manifest = await CVLoader.loadJSON(this._attr("data-images"));

        // Store data
        this.data = { coats, breeds, sizes, stitches, manifest };

        // Populate selectors
        CVLoader.populateSelect(document.querySelector(cfg.selectors.breed), breeds);
        CVLoader.populateSelect(document.querySelector(cfg.selectors.size), sizes);
        CVLoader.populateSelect(document.querySelector(cfg.selectors.coat), coats);

        // Init 3D engine
        CoatViewer3D.init({
            layers: cfg.layers,
            angleButtons: cfg.angleButtons,
            manifest: this._attr("data-images")
        });

        // Bind UI events
        this.bindUI();
    },

    bindUI() {
        const breedEl = document.querySelector(this.cfg.selectors.breed);
        const sizeEl  = document.querySelector(this.cfg.selectors.size);
        const coatEl  = document.querySelector(this.cfg.selectors.coat);

        breedEl.addEventListener("change", () => {
            CoatViewer3D.setBreed(breedEl.value);
        });

        sizeEl.addEventListener("change", () => {
            CoatViewer3D.setSize(sizeEl.value);
        });

        coatEl.addEventListener("change", () => {
            CoatViewer3D.setCoat(coatEl.value);
        });
    },

    _attr(name) {
        return document.querySelector(this.cfg.root).getAttribute(name);
    }
};
