<!-- Search Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen m-0">
        <div class="modal-content border-0" style="background-color: rgba(255, 255, 255, 0);">
            <div class="modal-body p-0">
                <div class="container-fluid d-flex flex-column justify-content-start align-items-center py-4 px-3" style="min-height: 100vh;">
                    <!-- Close Button -->
                    <div class="w-100 d-flex justify-content-end pe-4">
                        <button type="button" class="btn btn-link text-white fs-3"
                                data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <!-- Title -->
                    <h2 class="fw-bold mb-4 text-center" style="color:rgb(255, 255, 255);">Search</h2>
                    <!-- Search Form -->
                    <form method="GET" action="{{ route('search') }}" class="w-100 mt-3" id="searchForm">
                        <div class="mb-4 d-flex justify-content-center">
                            <div class="position-relative w-100" style="max-width: 1200px;">
                                <input type="text"
                                       class="form-control fs-6 fw-semibold py-3 px-4 bg-white text-dark"
                                       name="query"
                                       id="searchQuery"
                                       placeholder="What are you looking for?"
                                       style="border-radius: 50px; border: 1px solid #eee; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);"
                                       required>
                                <button type="submit"
                                    class="btn position-absolute top-50 end-0 translate-middle-y me-3"
                                    style="background: none; border: none;">
                                <i class="fas fa-search fs-5 text-dark"></i>
                            </button>
                            </div>
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
    
    // Focus input when modal opens
    searchModal.addEventListener('shown.bs.modal', function() {
        searchInput.focus();
    });
    
    // Clear input when modal closes
    searchModal.addEventListener('hidden.bs.modal', function() {
        searchInput.value = '';
    });
});
</script>