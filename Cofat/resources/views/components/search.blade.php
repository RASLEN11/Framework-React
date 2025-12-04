<link rel="stylesheet" href="{{ asset('css/components/search.css') }}">
<!-- Search Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen m-0">
        <div class="modal-content border-0">
            <div class="modal-body p-0">
                <!-- Close Button -->
                <button type="button" class="btn-close btn-close-search" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
                
                <!-- Search Content -->
                <div class="container-fluid d-flex flex-column justify-content-center align-items-center search-modal-container">
                    <!-- Title -->
                    <h2 class="search-modal-title">Search COFAT</h2>
                    
                    <!-- Search Form -->
                    <form method="GET" action="{{ route('search') }}" class="w-100 search-modal-form" id="searchForm">
                        <div class="position-relative w-100">
                            <input type="text"
                                   class="form-control search-input"
                                   name="query"
                                   id="searchQuery"
                                   placeholder="What are you looking for?"
                                   required>
                            <button type="submit"
                                class="btn search-submit-btn">
                                <i class="fas fa-search fs-5"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchModal = document.getElementById('searchModal');
    const searchInput = document.getElementById('searchQuery');
    
    if (searchModal && searchInput) {
        // Focus input when modal opens
        searchModal.addEventListener('shown.bs.modal', function() {
            searchInput.focus();
        });
        
        // Clear input when modal closes
        searchModal.addEventListener('hidden.bs.modal', function() {
            searchInput.value = '';
        });
    }
});
</script>