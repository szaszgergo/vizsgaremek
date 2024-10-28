document.addEventListener('DOMContentLoaded', () => {
    const selectedFlag = document.getElementById('selectedFlag');
    const hungaryOption = document.getElementById('hungaryOption');
    const usaOption = document.getElementById('usaOption');

    if (selectedFlag.src.includes('hu_flag')) {
        hungaryOption.style.display = 'none'; 
        usaOption.style.display = 'block';
    } else {
        usaOption.style.display = 'none'; 
        hungaryOption.style.display = 'block';
    }
});

function switchFlag(selectedSrc) {
    const hungaryOption = document.getElementById('hungaryOption');
    const usaOption = document.getElementById('usaOption');

    if (selectedSrc.includes('hu_flag')) {
        hungaryOption.style.display = 'none';
        usaOption.style.display = 'block';
    } else {
        usaOption.style.display = 'none';
        hungaryOption.style.display = 'block';
    }
}