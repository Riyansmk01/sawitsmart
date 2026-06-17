// Clean Header Navigation
document.addEventListener('DOMContentLoaded', function() {
    const toggler = document.getElementById('navbarToggler');
    const collapse = document.getElementById('navbarCollapse');
    const navDropdowns = document.querySelectorAll('.nav-dropdown');
    const navLinks = document.querySelectorAll('.nav-link-clean[data-dropdown]');

    // Hamburger Toggle
    if (toggler) {
        toggler.addEventListener('click', function(e) {
            e.preventDefault();
            this.classList.toggle('active');
            collapse.classList.toggle('active');
        });
    }

    // Close menu when clicking outside
    document.addEventListener('click', function(e) {
        if (collapse && !collapse.contains(e.target) && !toggler?.contains(e.target)) {
            toggler?.classList.remove('active');
            collapse.classList.remove('active');
        }
    });

    // Dropdown Menu Toggle for Mobile
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            if (window.innerWidth <= 991) {
                e.preventDefault();
                const parent = this.closest('.nav-dropdown');
                const isActive = parent.classList.contains('active');
                
                // Close all dropdowns
                navDropdowns.forEach(dropdown => {
                    dropdown.classList.remove('active');
                });
                
                // Toggle current
                if (!isActive) {
                    parent.classList.add('active');
                }
            }
        });
    });

    // Desktop hover behavior
    navDropdowns.forEach(dropdown => {
        dropdown.addEventListener('mouseenter', function() {
            if (window.innerWidth > 991) {
                this.classList.add('active');
            }
        });

        dropdown.addEventListener('mouseleave', function() {
            if (window.innerWidth > 991) {
                this.classList.remove('active');
            }
        });
    });

    // Close dropdowns on window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth > 991) {
            navDropdowns.forEach(dropdown => {
                dropdown.classList.remove('active');
            });
            collapse?.classList.remove('active');
            toggler?.classList.remove('active');
        }
    });
});
