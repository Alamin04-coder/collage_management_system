<!-- Success Message -->
@if(session('success'))
<div id="success-alert" class="alert alert-success alert-dismissible fade show text-center mx-auto shadow-lg"
     style="width: 400px; animation: slideIn 0.5s ease-in-out; border-left: 5px solid #28a745;">
    <i class="bi bi-check-circle-fill me-2 fs-5"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Error Messages -->
@if ($errors->any())
<div id="error-alert" class="alert alert-danger alert-dismissible fade show shadow-lg mx-auto"
     style="width: 400px; animation: shake 0.5s; border-left: 5px solid #dc3545;">
    <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
    
    <ul class="mb-0 mt-1">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Info Message -->
@if(session('info'))
<div id="info-alert" class="alert alert-info alert-dismissible fade show text-center mx-auto shadow-lg"
     style="width: 400px; animation: pulse 1.2s infinite; border-left: 5px solid #0dcaf0;">
    <i class="bi bi-info-circle-fill me-2 fs-5"></i>
    {{ session('info') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('error'))
<div id="info-alert" class="alert alert-info alert-dismissible fade show text-center mx-auto shadow-lg"
     style="width: 400px; animation: pulse 1.2s infinite; border-left: 5px solid #0dcaf0;">
    <i class="bi bi-info-circle-fill me-2 fs-5"></i>
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<style>
/* Animations */
@keyframes slideIn {
    0% { transform: translateY(-50px); opacity: 0; }
    100% { transform: translateY(0); opacity: 1; }
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    50% { transform: translateX(5px); }
    75% { transform: translateX(-5px); }
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

/* Optional: auto hide transition */
#success-alert, #error-alert, #info-alert {
    transition: all 0.5s ease-in-out;
}

/* Hover glow effect for fun */
#success-alert:hover {
    box-shadow: 0 0 15px rgba(40, 167, 69, 0.6);
}
#error-alert:hover {
    box-shadow: 0 0 15px rgba(220, 53, 69, 0.6);
}
#info-alert:hover {
    box-shadow: 0 0 15px rgba(13, 202, 240, 0.6);
}
</style>

<script>
    // Auto-hide alerts after 5 seconds
    setTimeout(() => {
        const alerts = document.querySelectorAll('#success-alert, #error-alert, #info-alert');
        alerts.forEach(alert => {
            alert.classList.remove('show');
            alert.style.opacity = '0';
            setTimeout(() => { alert.remove(); }, 500); // remove from DOM
        });
    }, 5000);
</script>
