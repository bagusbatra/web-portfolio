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
    const projects = [
        { id: 1, title: "E-commerce App", category: "Web Development", year: 2024, status: "Published" },
        { id: 2, title: "Task Management App", category: "Frontend Development", year: 2023, status: "Published" },
        { id: 3, title: "Business Landing Page", category: "UI/UX Design", year: 2022, status: "Published" },
        { id: 4, title: "Weather Dashboard", category: "API Integration", year: 2022, status: "Archived" },
        { id: 5, title: "Personal Blog CMS", category: "Fullstack Development", year: 2022, status: "Published" }
    ];

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

        // Add event listeners for edit/delete
        document.querySelectorAll('.edit-project').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.getAttribute('data-id');
                const proj = projects.find(p => p.id == id);
                if (proj) openProjectModal(proj);
            });
        });
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

        document.querySelectorAll('.edit-article').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.getAttribute('data-id');
                const art = articles.find(a => a.id == id);
                if (art) openArticleModal(art);
            });
        });
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

        document.querySelectorAll('.edit-client').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.getAttribute('data-id');
                const client = clients.find(c => c.id == id);
                if (client) openClientModal(client);
            });
        });
    }

    // Modal Helpers
    function openProjectModal(proj = null) {
        const modal = new bootstrap.Modal(document.getElementById('projectModal'));
        const title = document.getElementById('projectModalTitle');
        const form = document.getElementById('projectForm');
        
        form.reset();
        if (proj) {
            title.textContent = 'Edit Proyek';
            document.getElementById('proj-id').value = proj.id;
            document.getElementById('proj-title').value = proj.title;
            document.getElementById('proj-year').value = proj.year;
            document.getElementById('proj-category').value = proj.category;
            // Add other fields as needed
        } else {
            title.textContent = 'Tambah Proyek';
            document.getElementById('proj-id').value = '';
        }
        modal.show();
    }

    function openArticleModal(art = null) {
        const modal = new bootstrap.Modal(document.getElementById('articleModal'));
        const title = document.getElementById('articleModalTitle');
        const form = document.getElementById('articleForm');
        
        form.reset();
        if (art) {
            title.textContent = 'Edit Artikel';
            document.getElementById('art-id').value = art.id;
            document.getElementById('art-title').value = art.title;
            document.getElementById('art-category').value = art.category;
            document.getElementById('art-date').value = art.date;
        } else {
            title.textContent = 'Tulis Artikel Baru';
            document.getElementById('art-id').value = '';
        }
        modal.show();
    }

    function openClientModal(client = null) {
        const modal = new bootstrap.Modal(document.getElementById('clientModal'));
        const title = document.getElementById('clientModalTitle');
        const form = document.getElementById('clientForm');
        
        form.reset();
        if (client) {
            title.textContent = 'Edit Klien';
            document.getElementById('client-id').value = client.id;
            document.getElementById('client-name').value = client.name;
            document.getElementById('client-logo').value = client.logo;
        } else {
            title.textContent = 'Tambah Klien';
            document.getElementById('client-id').value = '';
        }
        modal.show();
    }

    // Form Submit Handlers
    document.getElementById('projectForm').addEventListener('submit', (e) => {
        e.preventDefault();
        alert('Data proyek berhasil disimpan! (Simulasi)');
        bootstrap.Modal.getInstance(document.getElementById('projectModal')).hide();
    });

    document.getElementById('articleForm').addEventListener('submit', (e) => {
        e.preventDefault();
        alert('Artikel berhasil diterbitkan! (Simulasi)');
        bootstrap.Modal.getInstance(document.getElementById('articleModal')).hide();
    });

    document.getElementById('clientForm').addEventListener('submit', (e) => {
        e.preventDefault();
        alert('Data klien berhasil disimpan! (Simulasi)');
        bootstrap.Modal.getInstance(document.getElementById('clientModal')).hide();
    });


    // Initial Load
    loadProjects();
    loadArticles();
    loadTestimonials();
    loadClients();
    loadSkills();
});
