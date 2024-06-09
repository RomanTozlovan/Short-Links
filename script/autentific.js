document.addEventListener('DOMContentLoaded', function() {
    const togglePopupButton = document.getElementById('togglePopup');
    const closePopupButton = document.getElementById('closePopup');
    const popup = document.getElementById('popup');
    const popupContent = document.getElementById('popupContent');

    function getIframeHeight(formType) {
        return formType === 'signup' ? '550px' : '200px';
    }

    togglePopupButton.addEventListener('click', () => {
        if (popup.style.display === 'block') {
            popup.style.display = 'none';
            popupContent.innerHTML = ''; // Șterge conținutul iframe-ului
            fetch('close.php');
        } else {
            const formType = togglePopupButton.getAttribute('data-form-type');
            popup.style.display = 'block';

            const iframe = document.createElement('iframe');
            iframe.src = 'autentificare_pop_up.php?formType=' + formType;
            iframe.style.width = '100%';
            iframe.style.height = getIframeHeight(formType);
            popupContent.appendChild(iframe);
        }
    });

    closePopupButton.addEventListener('click', () => {
        popup.style.display = 'none';
        popupContent.innerHTML = ''; // Șterge conținutul iframe-ului
        window.location.reload();
    });
});
