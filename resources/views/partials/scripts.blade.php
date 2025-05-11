<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap 5 RTL JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script>
    $(document).ready(function() {
        // Toggle sidebar on mobile
        $('.sidebar-toggle').on('click', function() {
            $('.sidebar').toggleClass('active');
            $('.overlay').toggle();
        });
        
        // Close sidebar when clicking overlay
        $('.overlay').on('click', function() {
            $('.sidebar').removeClass('active');
            $(this).hide();
        });
        
        // Confirm before delete
        $('form[data-confirm]').on('submit', function(e) {
            if (!confirm($(this).data('confirm'))) {
                e.preventDefault();
            }
        });
        
        // Add active class to current nav item
        $('.nav-link').each(function() {
            if ($(this).attr('href') === window.location.pathname) {
                $(this).addClass('active');
            }
        });
        
        // Tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();
    });
</script>

@stack('scripts')