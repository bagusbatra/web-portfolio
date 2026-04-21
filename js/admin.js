/* Admin Dashboard Logic */

document.addEventListener('DOMContentLoaded', () => {
    
    // 1. Sidebar Toggle for Mobile
    const toggleBtn = document.getElementById('toggle-sidebar');
    const closeBtn = document.getElementById('close-sidebar');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    function toggleSidebar(show) {
        if (show) {
            sidebar.classList.add('active');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        } else {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    if (toggleBtn) {
        toggleBtn.addEventListener('click', () => toggleSidebar(true));
    }

    if (closeBtn) {
        closeBtn.addEventListener('click', () => toggleSidebar(false));
    }

    if (overlay) {
        overlay.addEventListener('click', () => toggleSidebar(false));
    }

    // 2. View Switching Logic
    const navLinks = document.querySelectorAll('.sidebar-menu .nav-link');
    const viewSections = document.querySelectorAll('.view-section');
    const viewTitle = document.getElementById('view-title');

    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const viewId = link.getAttribute('data-view');
            
            if (!viewId) return;

            // Update Active Link
            navLinks.forEach(l => l.classList.remove('active'));
            link.classList.add('active');

            // Update View Title
            viewTitle.textContent = link.textContent.trim();

            // Show/Hide Sections
            viewSections.forEach(section => {
                section.classList.add('d-none');
                if (section.id === `${viewId}-view`) {
                    section.classList.remove('d-none');
                }
            });

            // If on mobile, close sidebar after selection
            if (window.innerWidth < 992) {
                toggleSidebar(false);
            }

            // Load data for specific view if needed
            if (viewId === 'projects') loadProjects();
            if (viewId === 'articles') loadArticles();
            if (viewId === 'testimonials') loadTestimonials();
            if (viewId === 'clients') loadClients();
            if (viewId === 'skills') loadSkills();
        });
    });

    // 3. Mock Data
    
    const articles = [
        { id: 1, title: "Masa Depan Web Development", category: "Teknologi", date: "2024-03-15", views: 120 },
        { id: 2, title: "Tips UI/UX untuk Pemula", category: "Design", date: "2024-03-10", views: 85 },
        { id: 3, title: "Belajar React Hooks", category: "Tutorial", date: "2024-02-28", views: 210 }
    ];
    
    const testimonials = [
        { id: 1, name: "John Doe", position: "CEO TechCorp", message: "Bagus adalah developer yang sangat kompeten." },
        { id: 2, name: "Sarah Smith", position: "Product Manager", message: "Hasil kerjanya selalu melebihi ekspektasi." }
    ];
    
    const clients = [
        { id: 1, name: "Google", logo: "https://upload.wikimedia.org/wikipedia/commons/2/2f/Google_2015_logo.svg" },
        { id: 2, name: "Microsoft", logo: "https://upload.wikimedia.org/wikipedia/commons/4/44/Microsoft_logo.svg" },
        { id: 3, name: "Amazon", logo: "https://upload.wikimedia.org/wikipedia/commons/a/a9/Amazon_logo.svg" }
    ];
    
    const projects = [
        { id: 1, title: "E-commerce App", category: "Web Development", year: 2024, status: "Published" },
        { id: 2, title: "Task Management App", category: "Frontend Development", year: 2023, status: "Published" },
        { id: 3, title: "Business Landing Page", category: "UI/UX Design", year: 2022, status: "Published" },
        { id: 4, title: "Weather Dashboard", category: "API Integration", year: 2022, status: "Archived" },
        { id: 5, title: "Personal Blog CMS", category: "Fullstack Development", year: 2022, status: "Published" }
    ];

    function loadProjects() {
        const tableBody = document.getElementById('projects-table-body');
        if (!tableBody) return;

        tableBody.innerHTML = projects.map(proj => `
            <tr>
                <td>#${proj.id}</td>
                <td>
                    <div class="d-flex align-items-center gap-3">
                        <img src="https://picsum.photos/seed/${proj.id}/40/40" class="rounded" alt="">
                        <span class="fw-bold">${proj.title}</span>
                    </div>
                </td>
                <td><span class="badge bg-primary-soft text-primary">${proj.category}</span></td>
                <td>${proj.year}</td>
                <td>
                    <div class="d-flex gap-2">
                        <button class="btn-action edit-project" data-id="${proj.id}"><i class="fas fa-edit"></i></button>
                        <button class="btn-action btn-delete delete-project" data-id="${proj.id}"><i class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        `).join('');

    }

    function loadArticles() {
        const tableBody = document.getElementById('articles-table-body');
        if (!tableBody) return;

        tableBody.innerHTML = articles.map(art => `
            <tr>
                <td>#${art.id}</td>
                <td><span class="fw-bold">${art.title}</span></td>
                <td><span class="badge bg-success-soft text-success">${art.category}</span></td>
                <td>${art.date}</td>
                <td>
                    <div class="d-flex gap-2">
                        <button class="btn-action edit-article" data-id="${art.id}"><i class="fas fa-edit"></i></button>
                        <button class="btn-action btn-delete delete-article" data-id="${art.id}"><i class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        `).join('');

    }

    function loadTestimonials() {
        const tableBody = document.getElementById('testimonials-table-body');
        if (!tableBody) return;

        tableBody.innerHTML = testimonials.map(t => `
            <tr>
                <td><span class="fw-bold">${t.name}</span></td>
                <td><span class="text-muted small">${t.position}</span></td>
                <td><p class="mb-0 small text-truncate" style="max-width: 200px;">${t.message}</p></td>
                <td>
                    <div class="d-flex gap-2">
                        <button class="btn-action"><i class="fas fa-edit"></i></button>
                        <button class="btn-action btn-delete"><i class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        `).join('');
    }

    function loadClients() {
        const tableBody = document.getElementById('clients-table-body');
        if (!tableBody) return;

        tableBody.innerHTML = clients.map(c => `
            <tr>
                <td><img src="${c.logo}" height="20" alt="${c.name}" class="opacity-75"></td>
                <td><span class="fw-bold">${c.name}</span></td>
                <td>
                    <div class="d-flex gap-2">
                        <button class="btn-action edit-client" data-id="${c.id}"><i class="fas fa-edit"></i></button>
                        <button class="btn-action btn-delete delete-client" data-id="${c.id}"><i class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        `).join('');

    }


    // Initial Load
    loadProjects();
    loadArticles();
    loadTestimonials();
    loadClients();
    loadSkills();
});
