// Handle 3-view rotation
window.spcvRotate = function(dir) {
    const views = ["front", "left", "right"];
    let current = window.spcvCurrent || 0;

    if (dir === "left") current = (current + 2) % 3;
    if (dir === "right") current = (current + 1) % 3;

    window.spcvCurrent = current;

    document.querySelectorAll(".spcv-view").forEach((el) => {
        el.style.display = "none";
    });

    const active = document.querySelector(`.spcv-view-${views[current]}`);
    if (active) active.style.display = "block";
};
