// Elemen-elemen DOM
const sidebar = document.getElementById("sidebar");
const sidebarToggle = document.getElementById("sidebar-toggle");
const mainContent = document.getElementById("main-content");
const collapseBtn = document.getElementById("collapse-btn");

// --- LOGIKA UNTUK TOGGLE SIDEBAR DI TAMPILAN SELULER ---
function toggleBodyScroll() {
    if (window.innerWidth < 768) {
        document.body.style.overflow = sidebar.classList.contains(
            "-translate-x-full"
        )
            ? ""
            : "hidden";
    } else {
        document.body.style.overflow = "";
    }
}

sidebarToggle.addEventListener("click", (e) => {
    e.stopPropagation();
    sidebar.classList.toggle("-translate-x-full");
    toggleBodyScroll();
});

document.addEventListener("click", (event) => {
    if (
        window.innerWidth < 768 &&
        !sidebar.contains(event.target) &&
        !sidebarToggle.contains(event.target) &&
        !sidebar.classList.contains("-translate-x-full")
    ) {
        sidebar.classList.add("-translate-x-full");
        toggleBodyScroll();
    }
});

// --- LOGIKA UNTUK COLLAPSE SIDEBAR DI TAMPILAN DESKTOP ---
if (collapseBtn) {
    collapseBtn.addEventListener("click", () => {
        sidebar.classList.toggle("collapsed");
        mainContent.classList.toggle("collapsed");
        // mainContent.classList.toggle('md:ml-64');
        // mainContent.classList.toggle('md:ml-20');
    });
}

// --- MENYESUAIKAN TAMPILAN SAAT UKURAN LAYAR BERUBAH ---
window.addEventListener("resize", () => {
    if (window.innerWidth >= 768) {
        sidebar.classList.remove("-translate-x-full");
        if (!mainContent.classList.contains("collapsed")) {
            //    mainContent.classList.add('md:ml-64');
            //    mainContent.classList.remove('md:ml-20');
        } else {
            //    mainContent.classList.add('md:ml-20');
            //    mainContent.classList.remove('md:ml-64');
        }
    } else {
        mainContent.classList.remove("md:ml-64", "md:ml-20");
    }
    toggleBodyScroll();
});

// Panggil saat load untuk inisialisasi
toggleBodyScroll();
