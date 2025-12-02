/**
 * Utility Loader for Coat Viewer
 */

window.CVLoader = {
    loadJSON(url) {
        return fetch(url)
            .then(r => r.json())
            .catch(e => {
                console.error("Error loading JSON:", url, e);
                return {};
            });
    },

    populateSelect(selectEl, data, labelKey = "label", valueKey = "id") {
        selectEl.innerHTML = "";

        for (const key in data) {
            const item = data[key];

            const opt = document.createElement("option");
            opt.value = key;
            opt.textContent = item[labelKey] || item[valueKey] || key;
            selectEl.appendChild(opt);
        }
    }
};
