function closeAlert() {
    const alert = document.getElementById('Alert');
    if (!alert || alert.dataset.closing) return;
    alert.dataset.closing = 'true';
    alert.style.transition = 'opacity 0.5s ease';
    alert.style.opacity = '0';
    setTimeout(() => alert.remove(), 500);
}

document.addEventListener('DOMContentLoaded', function() {
    setTimeout(closeAlert, 4000);
    document.getElementById('closeBtn')?.addEventListener('click', function(e) {
        e.stopPropagation();
        closeAlert();
    });
});