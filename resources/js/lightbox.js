/**
 * Basic lightbox module.
 * Works for elements using [data-lightbox] and opens an image in an overlay.
 */

export function initLightbox() {
    const triggers = document.querySelectorAll('[data-lightbox]');
    if (!triggers.length) return;

    let overlay = document.getElementById('smk-lightbox-overlay');
    if (!overlay) {
        overlay = document.createElement('div');
        overlay.id = 'smk-lightbox-overlay';
        overlay.style.cssText = [
            'position:fixed',
            'inset:0',
            'background:rgba(0,0,0,0.8)',
            'display:none',
            'align-items:center',
            'justify-content:center',
            'z-index:9999',
            'padding:16px',
            'cursor:zoom-out'
        ].join(';');

        const image = document.createElement('img');
        image.id = 'smk-lightbox-image';
        image.alt = 'Preview';
        image.style.cssText = [
            'max-width:100%',
            'max-height:100%',
            'border-radius:8px',
            'box-shadow:0 10px 40px rgba(0,0,0,0.45)'
        ].join(';');
        overlay.appendChild(image);

        overlay.addEventListener('click', () => {
            overlay.style.display = 'none';
            image.removeAttribute('src');
        });

        document.body.appendChild(overlay);
    }

    const lightboxImage = overlay.querySelector('#smk-lightbox-image');

    triggers.forEach((trigger) => {
        trigger.addEventListener('click', (event) => {
            event.preventDefault();
            const src =
                trigger.getAttribute('data-lightbox') ||
                trigger.getAttribute('href') ||
                trigger.getAttribute('src');

            if (!src || !lightboxImage) return;
            lightboxImage.setAttribute('src', src);
            overlay.style.display = 'flex';
        });
    });
}
