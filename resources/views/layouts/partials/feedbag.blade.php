<!-- Alertes -->
@if(session('success'))
    <div class="mb-6">
        <x-alert type="success" :message="session('success')" />
    </div>
@endif

@if(session('error'))
    <div class="mb-6">
        <x-alert type="error" :message="session('error')" />
    </div>
@endif

@if(session('warning'))
    <div class="mb-6">
        <x-alert type="warning" :message="session('warning')" />
    </div>
@endif