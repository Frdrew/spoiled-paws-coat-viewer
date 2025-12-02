/**
 * Coat Viewer 3D Rendering Engine
 * Handles silhouette switching, coat overlays, stitch overlays,
 * and angle rotation.
 */

window.CoatViewer3D = {
    state: {
        angle: "front",
        dogBase: null,
        coatLayer: null,
        stitchLayer: null,
        manifest: {},
        currentBreed: "",
        currentSize: "",
        currentCoat: "",
    },

    init(config) {
        this.state.dogBase     = document.querySelector(config.layers.dogBase);
        this.state.coatLayer   = document.querySelector(config.layers.coat);
        this.state.stitchLayer = document.querySelector(config.layers.stitches);
        this.state.manifestUrl = config.manifest;

        // Load manifest JSON for silhouettes & angles
        fetch(this.state.manifestUrl)
            .then(res => res.json())
            .then(json => {
                this.state.manifest = json;
            });

        // Bind angle buttons
        document.querySelectorAll(config.angleButtons).forEach(btn => {
            btn.addEventListener("click", () => {
                this.setAngle(btn.dataset.angle);
            });
        });
    },

    setBreed(breed) {
        this.state.currentBreed = breed;
        this.updateLayers();
    },

    setSize(size) {
        this.state.currentSize = size;
        this.updateLayers();
    },

    setCoat(coat) {
        this.state.currentCoat = coat;
        this.updateLayers();
    },

    setAngle(angle) {
        this.state.angle = angle;
        this.updateLayers();
    },

    updateLayers() {
        const { currentBreed, currentSize, currentCoat, angle } = this.state;

        if (!currentBreed || !currentSize) return;

        // **DOG LAYER**
        const dogPath =
            this.state.manifest?.silhouettes?.[currentBreed]?.[currentSize]?.[angle] || "";

        this.state.dogBase.src = dogPath;

        // **COAT LAYER**
        if (currentCoat) {
            const coatPath =
                this.state.manifest?.coats?.[currentCoat]?.[angle] || "";
            this.state.coatLayer.src = coatPath;
        }

        // **STITCH LAYER**
        const stitchPath =
            this.state.manifest?.stitches?.[currentCoat]?.[angle] || "";
        this.state.stitchLayer.src = stitchPath;
    }
};
