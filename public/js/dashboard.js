const expandBtn = document.querySelector(".toggle-btn");
const sidebar = document.querySelector("#sidebar");

expandBtn.addEventListener("click", () => {
    sidebar.classList.toggle("expand");
});

document.addEventListener("click", (event) => {
    if (
        !sidebar.contains(event.target) &&
        !event.target.matches(".toggle-btn") &&
        !event.target.matches(".lni-menu") // Add this line to match the actual toggle button
    ) {
        sidebar.classList.remove("expand");
    }
});
