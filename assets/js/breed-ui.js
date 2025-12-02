document.addEventListener("DOMContentLoaded", () => {

    const breedList = document.getElementById("spcv-breed-list");
    const silhouetteImage = document.getElementById("spcv-silhouette");

    if (!breedList) return;

    fetch(spcv_config.breed_manifest)
        .then(res => res.json())
        .then(data => {

            const breeds = data.breeds || [];

            breeds.forEach((breed, index) => {

                const item = document.createElement("div");
                item.classList.add("spcv-breed-item");
                item.textContent = breed.label;

                // Default first breed is active
                if (index === 0) item.classList.add("active");

                breedList.appendChild(item);

                item.addEventListener("click", () => {

                    // Clear active
                    document.querySelectorAll(".spcv-breed-item")
                        .forEach(b => b.classList.remove("active"));

                    item.classList.add("active");

                    // Swap silhouette
                    silhouetteImage.src = spcv_config.base_url + breed.silhouette;

                    // Optional: resize coat layer to match breed
                    if (window.spcvAdjustCoatToBreed) {
                        window.spcvAdjustCoatToBreed(breed);
                    }
                });
            });
        });
});
