function closeAlert(){
    const alert=document.getElementById('Alert');
    if(!alert||alert.dataset.closing) return;
    alert.dataset.closing='true';
    alert.style.transition='opacity 0.4 ease';
    alert.style.opacity='0';
    setTimeout(()=>alert.remove(),4000);
}
setTimeout(closeAlert,5000)
document.getElementsById('Alert').addEventListener('click',closeAlert);