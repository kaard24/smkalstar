/**
 * Lightbox utility for SMK Al-Hidayah Lestari
 * Supports both simple lightbox and animated lightbox
 */

(function() {
    'use strict';

    // Simple Lightbox (for galeri page)
    window.openLightbox = function(src, caption) {
        const lightbox = document.getElementById('lightbox');
        const img = document.getElementById('lightbox-img');
        const cap = document.getElementById('lightbox-caption');
        
        if (!lightbox || !img) return;
        
        img.src = src;
        if (cap) cap.textContent = caption || '';
        lightbox.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        // Add animation if image supports it
        if (img.style && typeof img.style.opacity !== 'undefined') {
            img.style.opacity = 0;
            img.style.transform = 'scale(0.95)';
            setTimeout(() => {
                img.style.transition = 'all 0.3s ease-out';
                img.style.opacity = 1;
                img.style.transform = 'scale(1)';
            }, 10);
        }
    };

    window.closeLightbox = function() {
        const lightbox = document.getElementById('lightbox');
        if (!lightbox) return;
        
        lightbox.classList.add('hidden');
        document.body.style.overflow = 'auto';
    };

    // Alpine.js lightbox helpers (for ekstrakurikuler, fasilitas, prestasi)
    window.createLightboxData = function() {
        return {
            lightboxOpen: false,
            activeImages: [],
            activeIndex: 0,
            activeCaption: '',
            
            openLightbox: function(images, caption) {
                this.activeImages = Array.isArray(images) ? images : [images];
                this.activeIndex = 0;
                this.activeCaption = caption || '';
                this.lightboxOpen = true;
                document.body.style.overflow = 'hidden';
            },
            
            closeLightbox: function() {
                this.lightboxOpen = false;
                document.body.style.overflow = 'auto';
                setTimeout(() => { 
                    this.activeImages = []; 
                    this.activeIndex = 0;
                }, 300);
            },
            
            nextImage: function() {
                if (this.activeImages.length > 1) {
                    this.activeIndex = (this.activeIndex + 1) % this.activeImages.length;
                }
            },
            
            prevImage: function() {
                if (this.activeImages.length > 1) {
                    this.activeIndex = this.activeIndex === 0 
                        ? this.activeImages.length - 1 
                        : this.activeIndex - 1;
                }
            },
            
            get currentImage() {
                return this.activeImages[this.activeIndex] || '';
            }
        };
    };

    // Image modal for berita/show page
    window.openImageModal = function(src) {
        const modal = document.getElementById('imageModal');
        const img = document.getElementById('modalImage');
        if (!modal || !img) return;
        
        img.src = src;
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    };

    window.closeImageModal = function() {
        const modal = document.getElementById('imageModal');
        if (!modal) return;
        
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    };

    // Global keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            // Try closing any open lightbox/modal
            const lightbox = document.getElementById('lightbox');
            const imageModal = document.getElementById('imageModal');
            
            if (lightbox && !lightbox.classList.contains('hidden')) {
                closeLightbox();
            }
            if (imageModal && !imageModal.classList.contains('hidden')) {
                closeImageModal();
            }
        }
    });

    // Close on background click
    document.addEventListener('click', function(e) {
        if (e.target.id === 'lightbox') {
            closeLightbox();
        }
        if (e.target.id === 'imageModal') {
            closeImageModal();
        }
    });
})();
