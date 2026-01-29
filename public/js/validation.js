document.addEventListener("DOMContentLoaded", function () {
    const elements = document.querySelectorAll("input, select, textarea");

    elements.forEach(element => {
        // Event listener saat input invalid (trigger saat submit)
        element.addEventListener("invalid", function () {
            this.setCustomValidity(""); // Reset validitas kustom lama

            if (!this.validity.valid) {
                // Tentukan pesan error berdasarkan jenis kesalahan
                if (this.validity.valueMissing) {
                    this.setCustomValidity("Silakan isi bidang ini.");
                } else if (this.validity.typeMismatch) {
                    if (this.type === "email") {
                        this.setCustomValidity("Mohon masukkan alamat email yang valid (contoh: user@example.com).");
                    } else if (this.type === "url") {
                        this.setCustomValidity("Mohon masukkan URL yang valid.");
                    } else {
                        this.setCustomValidity("Format input tidak valid.");
                    }
                } else if (this.validity.patternMismatch) {
                    // Coba ambil title attribute jika ada sebagai petunjuk
                    const title = this.getAttribute("title");
                    this.setCustomValidity(title ? title : "Format input tidak sesuai dengan yang diminta.");
                } else if (this.validity.tooShort) {
                    this.setCustomValidity(`Input terlalu pendek. Minimal ${this.minLength} karakter.`);
                } else if (this.validity.tooLong) {
                    this.setCustomValidity(`Input terlalu panjang. Maksimal ${this.maxLength} karakter.`);
                } else if (this.validity.rangeUnderflow) {
                    this.setCustomValidity(`Nilai harus lebih besar atau sama dengan ${this.min}.`);
                } else if (this.validity.rangeOverflow) {
                    this.setCustomValidity(`Nilai harus lebih kecil atau sama dengan ${this.max}.`);
                } else if (this.validity.stepMismatch) {
                    this.setCustomValidity(`Nilai tidak valid sesuai langkah (step) yang ditentukan.`);
                } else if (this.validity.badInput) {
                    this.setCustomValidity("Input tidak dapat diproses.");
                } else {
                    this.setCustomValidity("Input tidak valid.");
                }
            }
        });

        // Event listener saat user mengetik/mengubah nilai (reset error)
        element.addEventListener("input", function () {
            this.setCustomValidity("");
        });

        element.addEventListener("change", function () {
            this.setCustomValidity("");
        });
    });
});
