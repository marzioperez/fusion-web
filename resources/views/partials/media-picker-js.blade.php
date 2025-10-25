<script>
    document.addEventListener('alpine:init', () => {
        window.addEventListener('set-media-single', (e) => {
            const { hostId, statePath, value } = e.detail || {};
            const lw = (window.Livewire && window.Livewire.find(hostId)) || (window.Livewire && window.Livewire.all()[0]) || null;
            if (lw) lw.set(statePath, value);
        });
    });
</script>
