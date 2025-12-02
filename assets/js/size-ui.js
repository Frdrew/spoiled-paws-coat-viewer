document.addEventListener("DOMContentLoaded", () => {

    const sizeItems = document.querySelectorAll(".spcv-size-item");
    const coatLayer = document.getElementById("spcv-active-coat");

    if (!coatLayer || sizeItems.length === 0) return;

    sizeItems.forEach(item => {
        item.addEventListener("click", () => {

            // remove current active
            sizeItems.forEach(i => i.classList.remove("active"));
            item.classList.add("active");

            const size = item.dataset.size;

            // adjust coat scale
            applySizeToCoat(size);
        });
    });

    function applySizeToCoat(size) {
        const scaleMap = spcv_config.size_scale;

        if (!scaleMap[size]) return;

        const scale = scaleMap[size];

        coatLayer.style.transform = `scale(${scale})`;
        coatLayer.style.transformOrigin = "center center";
    }
});
