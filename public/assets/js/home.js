document.addEventListener('DOMContentLoaded', function () {

    // ---- Navbar shadow saat scroll ----
    var navbar = document.querySelector('.navbar');
    window.addEventListener('scroll', function () {
        if (navbar) {
            if (window.scrollY > 8) navbar.classList.add('scrolled');
            else navbar.classList.remove('scrolled');
        }
    });

    // ---- Hamburger menu (mobile) ----
    var hamburger = document.querySelector('.hamburger');
    var mobileMenu = document.querySelector('.mobile-menu');
    if (hamburger && mobileMenu) {
        hamburger.addEventListener('click', function () {
            mobileMenu.classList.toggle('open');
        });
        mobileMenu.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                mobileMenu.classList.remove('open');
            });
        });
    }

    // ---- Scroll reveal animation ----
    var revealEls = document.querySelectorAll('.reveal');
    if ('IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });
        revealEls.forEach(function (el) { observer.observe(el); });
    } else {
        revealEls.forEach(function (el) { el.classList.add('in'); });
    }

    // ---- Prompt "Login atau daftar" untuk fitur yang butuh akun ----
    var toast = document.getElementById('authToast');
    var toastTimer = null;
    function showAuthPrompt() {
        if (!toast) return;
        toast.classList.add('show');
        clearTimeout(toastTimer);
        toastTimer = setTimeout(function () { toast.classList.remove('show'); }, 5000);
    }
    document.querySelectorAll('[data-requires-auth]').forEach(function (el) {
        el.addEventListener('click', function (e) {
            e.preventDefault();
            showAuthPrompt();
        });
    });

    // ---- Carousel Trending Fashion ----
    var track = document.getElementById('trendCarousel');
    var prevBtn = document.querySelector('.carousel-btn.prev');
    var nextBtn = document.querySelector('.carousel-btn.next');
    if (track && prevBtn && nextBtn) {
        var scrollAmount = 280;
        prevBtn.addEventListener('click', function () {
            track.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        });
        nextBtn.addEventListener('click', function () {
            track.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        });
    }

});

// ---- Preloader ----
window.addEventListener('load', function () {
    var pre = document.getElementById('preloader');
    if (pre) {
        setTimeout(function () { pre.classList.add('hide'); }, 350);
    }
});

// ---- Welcome Sound: "Welcome, WEAR." ----
// Aman terhadap kebijakan autoplay browser & tidak pernah bikin halaman error.
(function () {
    var STORAGE_KEY = 'wear_welcome_played';
    var MUTE_KEY = 'wear_sound_muted';
    var played = localStorage.getItem(STORAGE_KEY) === 'true';
    var muted = localStorage.getItem(MUTE_KEY) === 'true';

    function speakWelcome(callback) {
        if (played || muted) { if (callback) callback(false); return; }
        if (!('speechSynthesis' in window) || typeof SpeechSynthesisUtterance === 'undefined') {
            if (callback) callback(false);
            return;
        }
        try {
            var utter = new SpeechSynthesisUtterance('Welcome, WEAR.');
            utter.rate = 0.95;
            utter.pitch = 1;
            utter.volume = 1;
            utter.onstart = function () {
                played = true;
                localStorage.setItem(STORAGE_KEY, 'true');
                if (callback) callback(true);
            };
            utter.onerror = function () { if (callback) callback(false); };
            window.speechSynthesis.speak(utter);
        } catch (e) {
            // Diamkan sepenuhnya, jangan sampai bikin halaman error
            if (callback) callback(false);
        }
    }

    function attachFirstInteractionFallback() {
        var onFirstInteract = function () {
            speakWelcome();
            document.removeEventListener('click', onFirstInteract);
            document.removeEventListener('touchstart', onFirstInteract);
            document.removeEventListener('keydown', onFirstInteract);
        };
        document.addEventListener('click', onFirstInteract, { once: true });
        document.addEventListener('touchstart', onFirstInteract, { once: true });
        document.addEventListener('keydown', onFirstInteract, { once: true });
    }

    function tryAutoplay() {
        if (played || muted) return;
        speakWelcome(function (success) {
            if (!success) attachFirstInteractionFallback();
        });
    }

    document.addEventListener('DOMContentLoaded', tryAutoplay);

    // Tombol mute/unmute
    document.addEventListener('DOMContentLoaded', function () {
        var btn = document.getElementById('soundToggle');
        if (!btn) return;

        function iconOn() {
            return '<svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M11 5L6 9H3V15H6L11 19V5Z" stroke="#2b2a3d" stroke-width="1.5" stroke-linejoin="round"/><path d="M15 9C16 10.2 16 13.8 15 15" stroke="#2b2a3d" stroke-width="1.5" stroke-linecap="round"/><path d="M17.3 7C19.3 9.6 19.3 14.4 17.3 17" stroke="#2b2a3d" stroke-width="1.5" stroke-linecap="round"/></svg>';
        }
        function iconOff() {
            return '<svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M11 5L6 9H3V15H6L11 19V5Z" stroke="#2b2a3d" stroke-width="1.5" stroke-linejoin="round"/><path d="M16 9L20 15M20 9L16 15" stroke="#2b2a3d" stroke-width="1.5" stroke-linecap="round"/></svg>';
        }

        function updateIcon() { btn.innerHTML = muted ? iconOff() : iconOn(); }
        updateIcon();

        btn.addEventListener('click', function () {
            muted = !muted;
            localStorage.setItem(MUTE_KEY, muted ? 'true' : 'false');
            updateIcon();

            if ('speechSynthesis' in window) window.speechSynthesis.cancel();
            if (!muted && !played) speakWelcome();
        });
    });
})();

/* =====================================================================
   TAMBAHAN v2: Kategori carousel autoplay, Preferensi interaktif,
   Modal detail, Random Fashion
   ===================================================================== */
document.addEventListener('DOMContentLoaded', function () {

    var isLoggedIn = window.WEAR_LOGGED_IN === true;
    var loginUrl = window.WEAR_LOGIN_URL || '/login';

    function goToLogin(message) {
        try { localStorage.setItem('wear_preferences', JSON.stringify(wearPrefs)); } catch (e) {}
        window.location.href = loginUrl;
    }

    // ---------------------------------------------------------------
    // 1. Kategori: carousel auto-slide + klik gating login
    // ---------------------------------------------------------------
    var catTrack = document.getElementById('categoryCarousel');
    if (catTrack) {
        var catAutoplay = setInterval(function () {
            if (catTrack.scrollLeft + catTrack.clientWidth >= catTrack.scrollWidth - 5) {
                catTrack.scrollTo({ left: 0, behavior: 'smooth' });
            } else {
                catTrack.scrollBy({ left: 220, behavior: 'smooth' });
            }
        }, 3200);
        catTrack.addEventListener('mouseenter', function () { clearInterval(catAutoplay); });
        catTrack.addEventListener('touchstart', function () { clearInterval(catAutoplay); }, { passive: true });

        catTrack.querySelectorAll('.category-card').forEach(function (card) {
            card.addEventListener('click', function () {
                var name = card.getAttribute('data-category') || 'kategori ini';
                if (!isLoggedIn) {
                    goToLogin();
                    return;
                }
                showToast('Katalog kategori "' + name + '" akan segera hadir.');
            });
        });
    }
    var catPrev = document.getElementById('catPrev');
    var catNext = document.getElementById('catNext');
    if (catTrack && catPrev && catNext) {
        catPrev.addEventListener('click', function () { catTrack.scrollBy({ left: -220, behavior: 'smooth' }); });
        catNext.addEventListener('click', function () { catTrack.scrollBy({ left: 220, behavior: 'smooth' }); });
    }

    // ---------------------------------------------------------------
    // 2. Modal generik
    // ---------------------------------------------------------------
    var modalOverlay = document.getElementById('wearModal');
    var modalBody = document.getElementById('wearModalBody');

    function openModal(html) {
        if (!modalOverlay || !modalBody) return;
        modalBody.innerHTML = html;
        modalOverlay.classList.add('open');
    }
    function closeModal() {
        if (!modalOverlay) return;
        modalOverlay.classList.remove('open');
    }
    if (modalOverlay) {
        modalOverlay.addEventListener('click', function (e) {
            if (e.target === modalOverlay) closeModal();
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeModal();
        });
    }
    window.wearCloseModal = closeModal;

    // ---------------------------------------------------------------
    // 3. Data outfit dummy (frontend-only, siap disambungkan ke backend)
    // ---------------------------------------------------------------
    var outfitData = [
        { name: 'Oversized Blazer Look', cat: 'Women', color: 'Beige', occasion: 'Kerja/Formal', grad: 'grad-a', desc: 'Padanan blazer oversized dengan inner simpel, cocok untuk kerja maupun jalan santai.', items: 'Blazer oversized, inner turtleneck, celana kain lurus' },
        { name: 'Layered Street Style', cat: 'Streetwear', color: 'Black', occasion: 'Hangout', grad: 'grad-b', desc: 'Gaya jalanan dengan layering jaket dan aksesoris bold, penuh karakter.', items: 'Jaket bomber, kaos grafis, cargo pants, sneakers' },
        { name: 'Modest Chic Ensemble', cat: 'Hijab', color: 'Pastel Pink', occasion: 'Daily', grad: 'grad-c', desc: 'Perpaduan warna lembut dan siluet longgar yang tetap terlihat modern.', items: 'Outer panjang, dress longgar, hijab pashmina' },
        { name: 'Minimalist Office Wear', cat: 'Office', color: 'Grey', occasion: 'Office', grad: 'grad-a', desc: 'Tampil profesional dengan potongan clean dan palet warna netral.', items: 'Kemeja, rok pensil, blazer pendek' },
        { name: 'Korean Soft Casual', cat: 'Korean Style', color: 'White', occasion: 'Campus', grad: 'grad-b', desc: 'Oversized top dipadu rok/celana longgar, kesan santai tapi tetap rapi.', items: 'Knit top oversized, wide-leg pants, sneakers putih' },
        { name: 'Party Night Glam', cat: 'Party', color: 'Black', occasion: 'Party', grad: 'grad-c', desc: 'Siluet fitted dengan aksen mengkilap, cocok untuk acara malam.', items: 'Dress satin, heels, clutch bag' },
        { name: 'Everyday Unisex Layers', cat: 'Unisex', color: 'Olive', occasion: 'Daily', grad: 'grad-a', desc: 'Padanan netral gender dengan potongan longgar dan warna earthy yang mudah dimix.', items: 'Overshirt, kaos basic, celana cargo longgar' },
        { name: 'Clean Minimalist Set', cat: 'Minimalist', color: 'Beige', occasion: 'Daily/Office', grad: 'grad-b', desc: 'Palet warna netral dan garis simpel, fokus ke potongan yang rapi tanpa detail berlebih.', items: 'Knit top polos, celana kain lurus, flat shoes' }
    ];

    function renderOutfitModal(o) {
        openModal(
            '<div class="wear-modal-media ' + o.grad + '"></div>' +
            '<div class="tag-row"><span class="tag-pill">' + o.cat + '</span><span class="tag-pill">' + o.occasion + '</span></div>' +
            '<h3>' + o.name + '</h3>' +
            '<div class="modal-meta">Warna dominan: ' + o.color + '</div>' +
            '<p class="desc">' + o.desc + '</p>' +
            '<p class="desc"><strong>Rekomendasi item:</strong> ' + o.items + '</p>' +
            '<div class="modal-cta">' +
            (isLoggedIn
                ? '<button class="btn btn-primary btn-sm" onclick="window.wearCloseModal()">Simpan Outfit Ini</button>'
                : '<a href="' + loginUrl + '" class="btn btn-primary btn-sm">Login untuk Simpan</a>') +
            '<button class="btn btn-outline btn-sm" onclick="window.wearCloseModal()">Tutup</button>' +
            '</div>'
        );
    }

    // Klik kartu trending -> buka detail
    document.querySelectorAll('.trend-card').forEach(function (card, idx) {
        card.addEventListener('click', function (e) {
            if (e.target.closest('a')) e.preventDefault();
            renderOutfitModal(outfitData[idx % outfitData.length]);
        });
    });

    // Random Fashion
    var randomBtn = document.getElementById('randomFashionBtn');
    if (randomBtn) {
        randomBtn.addEventListener('click', function () {
            var pick = outfitData[Math.floor(Math.random() * outfitData.length)];
            renderOutfitModal(pick);
        });
    }

    // Ekspos ke global biar fitur search bisa manggil modal outfit yang sama
    window.wearShowOutfitModal = function (idx) {
        if (outfitData[idx]) renderOutfitModal(outfitData[idx]);
    };

    // Klik kartu inspirasi -> buka detail singkat
    document.querySelectorAll('.inspo-item').forEach(function (card) {
        card.addEventListener('click', function () {
            var title = card.getAttribute('data-title') || 'Fashion Inspiration';
            var desc = card.getAttribute('data-desc') || '';
            var grad = card.getAttribute('data-grad') || 'grad-a';
            openModal(
                '<div class="wear-modal-media ' + grad + '"></div>' +
                '<div class="tag-row"><span class="tag-pill">Inspiration</span></div>' +
                '<h3>' + title + '</h3>' +
                '<p class="desc">' + desc + '</p>' +
                '<div class="modal-cta"><button class="btn btn-outline btn-sm" onclick="window.wearCloseModal()">Tutup</button></div>'
            );
        });
    });

    // ---------------------------------------------------------------
    // 4. Preferensi interaktif ("Your Style, Your Recommendation")
    // ---------------------------------------------------------------
    var wearPrefs = {};
    try {
        var saved = localStorage.getItem('wear_preferences');
        if (saved) wearPrefs = JSON.parse(saved);
    } catch (e) { wearPrefs = {}; }

    function savePrefs() {
        try { localStorage.setItem('wear_preferences', JSON.stringify(wearPrefs)); } catch (e) {}
    }

    var prefPanel = document.getElementById('prefPanel');
    var prefChips = document.querySelectorAll('.pref-chip');

    var prefTemplates = {
        gender: {
            title: 'Pilih Gender',
            render: function () {
                return optRow(['Women', 'Men', 'Others'], 'gender', false);
            }
        },
        style: {
            title: 'Pilih Style Favorit (bisa lebih dari satu)',
            render: function () {
                return optRow(['Casual', 'Korean', 'Streetwear', 'Y2K', 'Minimalist', 'Feminine', 'Elegant', 'Old Money', 'Sporty', 'Vintage', 'Formal', 'Hijab'], 'style', true);
            }
        },
        warna: {
            title: 'Pilih Warna Favorit',
            render: function () {
                var colors = [
                    ['Black', '#1c1c26'], ['White', '#ffffff'], ['Blue', '#8ba0bd'], ['Pink', '#e7bfae'],
                    ['Brown', '#a97155'], ['Beige', '#e8d9c3'], ['Green', '#8fbf8f'], ['Red', '#e06a6a'],
                    ['Grey', '#b7b7c2'], ['Purple', '#b39ddb']
                ];
                var html = '<div class="swatch-row">';
                colors.forEach(function (c) {
                    var sel = (wearPrefs.warna || []).includes(c[0]) ? ' selected' : '';
                    html += '<div class="swatch-item' + sel + '" data-group="warna" data-multi="true" data-value="' + c[0] + '">' +
                        '<span class="swatch-circle" style="background:' + c[1] + '; border-color:' + (c[0] === 'White' ? '#eee' : 'rgba(255,255,255,0.7)') + ';"></span>' +
                        '<span>' + c[0] + '</span></div>';
                });
                html += '</div>';
                return html;
            }
        },
        occasion: {
            title: 'Pilih Occasion',
            render: function () {
                return optRow(['Daily', 'Campus', 'Office', 'Date', 'Party', 'Wedding', 'Hangout', 'Vacation', 'Formal Event'], 'occasion', true);
            }
        },
        budget: {
            title: 'Pilih Rentang Budget',
            render: function () {
                return optRow(['Under Rp100.000', 'Rp100.000 – Rp250.000', 'Rp250.000 – Rp500.000', 'Rp500.000 – Rp1.000.000', 'Above Rp1.000.000'], 'budget', false);
            }
        },
        lain: {
            title: 'Preferensi Lain',
            render: function () {
                return '<textarea id="prefLainInput" rows="3" style="width:100%;max-width:420px;border-radius:10px;border:none;padding:0.7rem 0.9rem;font-family:Inter,sans-serif;font-size:0.88rem;" placeholder="Contoh: suka baju longgar, hindari warna terang...">' + (wearPrefs.lain || '') + '</textarea>';
            }
        },
        kulit: {
            title: 'Pilih Warna Kulit (Skin Tone)',
            render: function () {
                var tones = [['Fair', '#f6dfd0'], ['Light', '#eec9a8'], ['Medium', '#c68e5f'], ['Tan', '#a56b3d'], ['Deep', '#6b4226']];
                var html = '<div class="swatch-row">';
                tones.forEach(function (t) {
                    var sel = wearPrefs.kulit === t[0] ? ' selected' : '';
                    html += '<div class="swatch-item' + sel + '" data-group="kulit" data-multi="false" data-value="' + t[0] + '">' +
                        '<span class="swatch-circle" style="background:' + t[1] + ';"></span><span>' + t[0] + '</span></div>';
                });
                html += '</div>';
                return html;
            }
        },
        badan: {
            title: 'Tinggi & Berat Badan',
            render: function () {
                return '<div class="body-form">' +
                    '<div class="bf-field"><label>Tinggi Badan (cm)</label><input type="number" id="prefTinggi" value="' + (wearPrefs.tinggi || '') + '" placeholder="Contoh: 160"></div>' +
                    '<div class="bf-field"><label>Berat Badan (kg)</label><input type="number" id="prefBerat" value="' + (wearPrefs.berat || '') + '" placeholder="Contoh: 55"></div>' +
                    '</div>';
            }
        },
        bentuk: {
            title: 'Pilih Bentuk Tubuh',
            render: function () {
                var shapes = ['Hourglass', 'Rectangle', 'Pear', 'Apple', 'Inverted Triangle'];
                var html = '<div class="silhouette-row">';
                shapes.forEach(function (s) {
                    var sel = wearPrefs.bentuk === s ? ' selected' : '';
                    html += '<div class="silhouette-item' + sel + '" data-group="bentuk" data-multi="false" data-value="' + s + '">' +
                        '<svg width="26" height="34" viewBox="0 0 26 34" fill="none"><path d="M13 2C15 2 16.5 4 16.5 6.5C16.5 8 15.8 9 15 9.5C18 11 20 15 19 20L17 32H9L7 20C6 15 8 11 11 9.5C10.2 9 9.5 8 9.5 6.5C9.5 4 11 2 13 2Z" stroke="#2b2a3d" stroke-width="1.3" fill="none"/></svg>' +
                        '<span>' + s + '</span></div>';
                });
                html += '</div>';
                return html;
            }
        },
        brand: {
            title: 'Pilih Brand yang Diminati',
            render: function () {
                var html = optRow(['Zara', 'H&M', 'Uniqlo', 'Cotton On', 'Adidas', 'Nike', 'Converse', 'Local Brand', 'Other'], 'brand', true);
                var showOther = (wearPrefs.brand || []).includes('Other');
                html += '<div class="brand-input-row' + (showOther ? ' show' : '') + '" id="brandOtherRow">' +
                    '<input type="text" id="prefBrandOther" value="' + (wearPrefs.brandOther || '') + '" placeholder="Masukkan brand favoritmu...">' +
                    '</div>';
                return html;
            }
        }
    };

    function optRow(options, group, multi) {
        var html = '<div class="opt-row">';
        options.forEach(function (opt) {
            var current = wearPrefs[group];
            var sel = multi ? (Array.isArray(current) && current.includes(opt)) : (current === opt);
            html += '<span class="opt-chip' + (sel ? ' selected' : '') + '" data-group="' + group + '" data-multi="' + multi + '" data-value="' + opt + '">' + opt + '</span>';
        });
        html += '</div>';
        return html;
    }

    function updateChipBadge(key, text) {
        var chip = document.querySelector('.pref-chip[data-pref="' + key + '"]');
        if (!chip) return;
        var valueEl = chip.querySelector('.pref-value');
        if (!valueEl) {
            valueEl = document.createElement('span');
            valueEl.className = 'pref-value';
            chip.appendChild(valueEl);
        }
        if (text) {
            valueEl.textContent = text;
            chip.classList.add('filled');
        } else {
            valueEl.textContent = '';
            chip.classList.remove('filled');
        }
    }

    function refreshAllBadges() {
        updateChipBadge('gender', wearPrefs.gender || '');
        updateChipBadge('style', (wearPrefs.style || []).join(', '));
        updateChipBadge('warna', (wearPrefs.warna || []).join(', '));
        updateChipBadge('occasion', (wearPrefs.occasion || []).join(', '));
        updateChipBadge('budget', wearPrefs.budget || '');
        updateChipBadge('lain', wearPrefs.lain ? 'Terisi' : '');
        updateChipBadge('kulit', wearPrefs.kulit || '');
        updateChipBadge('badan', (wearPrefs.tinggi || wearPrefs.berat) ? (wearPrefs.tinggi || '-') + 'cm / ' + (wearPrefs.berat || '-') + 'kg' : '');
        updateChipBadge('bentuk', wearPrefs.bentuk || '');
        updateChipBadge('brand', (wearPrefs.brand || []).join(', '));
    }

    function openPrefPanel(key) {
        if (!prefPanel || !prefTemplates[key]) return;
        prefPanel.innerHTML = '<h4>' + prefTemplates[key].title + '</h4>' + prefTemplates[key].render();
        prefPanel.classList.add('open');
        prefPanel.setAttribute('data-current', key);
        attachPanelEvents(key);
    }

    function attachPanelEvents(key) {
        prefPanel.querySelectorAll('.opt-chip, .swatch-item, .silhouette-item').forEach(function (el) {
            el.addEventListener('click', function () {
                var group = el.getAttribute('data-group');
                var value = el.getAttribute('data-value');
                var multi = el.getAttribute('data-multi') === 'true';

                if (multi) {
                    if (!Array.isArray(wearPrefs[group])) wearPrefs[group] = [];
                    var idx = wearPrefs[group].indexOf(value);
                    if (idx > -1) wearPrefs[group].splice(idx, 1);
                    else wearPrefs[group].push(value);
                } else {
                    wearPrefs[group] = (wearPrefs[group] === value) ? null : value;
                }

                savePrefs();
                openPrefPanel(key); // re-render biar state kelihatan
                refreshAllBadges();

                if (group === 'brand') {
                    var otherRow = document.getElementById('brandOtherRow');
                    if (otherRow) {
                        otherRow.classList.toggle('show', (wearPrefs.brand || []).includes('Other'));
                    }
                }
            });
        });

        var lainInput = document.getElementById('prefLainInput');
        if (lainInput) lainInput.addEventListener('input', function () { wearPrefs.lain = lainInput.value; savePrefs(); refreshAllBadges(); });

        var tinggiInput = document.getElementById('prefTinggi');
        var beratInput = document.getElementById('prefBerat');
        if (tinggiInput) tinggiInput.addEventListener('input', function () { wearPrefs.tinggi = tinggiInput.value; savePrefs(); refreshAllBadges(); });
        if (beratInput) beratInput.addEventListener('input', function () { wearPrefs.berat = beratInput.value; savePrefs(); refreshAllBadges(); });

        var brandOtherInput = document.getElementById('prefBrandOther');
        if (brandOtherInput) brandOtherInput.addEventListener('input', function () { wearPrefs.brandOther = brandOtherInput.value; savePrefs(); });
    }

    prefChips.forEach(function (chip) {
        chip.addEventListener('click', function () {
            var key = chip.getAttribute('data-pref');
            var isOpenSame = prefPanel.classList.contains('open') && prefPanel.getAttribute('data-current') === key;
            if (isOpenSame) {
                prefPanel.classList.remove('open');
            } else {
                openPrefPanel(key);
            }
        });
    });

    refreshAllBadges();

    // CTA akhir: simpan preferensi -> gating login
    var savePrefBtn = document.getElementById('savePrefBtn');
    if (savePrefBtn) {
        savePrefBtn.addEventListener('click', function () {
            savePrefs();
            if (!isLoggedIn) {
                goToLogin();
            } else {
                showToast('Preferensi tersimpan! Rekomendasi personalmu sedang disiapkan.');
            }
        });
    }

    // ---------------------------------------------------------------
    // Toast kecil generik (dipakai beberapa fitur di atas)
    // ---------------------------------------------------------------
    function showToast(msg) {
        var toastEl = document.getElementById('genericToast');
        if (!toastEl) return;
        toastEl.textContent = msg;
        toastEl.classList.add('show');
        clearTimeout(showToast._t);
        showToast._t = setTimeout(function () { toastEl.classList.remove('show'); }, 3500);
    }
    window.wearShowToast = showToast;
});

/* =====================================================================
   TAMBAHAN v3: Fitur Search
   ===================================================================== */
document.addEventListener('DOMContentLoaded', function () {

    var searchToggle = document.getElementById('searchToggle');
    var searchOverlay = document.getElementById('searchOverlay');
    var searchInput = document.getElementById('searchInput');
    var searchResults = document.getElementById('searchResults');

    if (!searchToggle || !searchOverlay || !searchInput || !searchResults) return;

    // Index pencarian: gabungan kategori, trending outfit, dan inspirasi
    var searchIndex = [
        { title: 'Women', type: 'Kategori', grad: 'grad-a', action: 'category' },
        { title: 'Men', type: 'Kategori', grad: 'grad-b', action: 'category' },
        { title: 'Unisex', type: 'Kategori', grad: 'grad-a', action: 'category' },
        { title: 'Casual', type: 'Kategori', grad: 'grad-b', action: 'category' },
        { title: 'Streetwear', type: 'Kategori', grad: 'grad-a', action: 'category' },
        { title: 'Minimalist', type: 'Kategori', grad: 'grad-b', action: 'category' },
        { title: 'Hijab', type: 'Kategori', grad: 'grad-a', action: 'category' },
        { title: 'Office', type: 'Kategori', grad: 'grad-b', action: 'category' },
        { title: 'Korean Style', type: 'Kategori', grad: 'grad-a', action: 'category' },
        { title: 'Party', type: 'Kategori', grad: 'grad-b', action: 'category' },
        { title: 'Oversized Blazer Look', type: 'Trending', grad: 'grad-a', action: 'outfit', idx: 0 },
        { title: 'Layered Street Style', type: 'Trending', grad: 'grad-b', action: 'outfit', idx: 1 },
        { title: 'Modest Chic Ensemble', type: 'Trending', grad: 'grad-c', action: 'outfit', idx: 2 },
        { title: 'Minimalist Office Wear', type: 'Trending', grad: 'grad-a', action: 'outfit', idx: 3 },
        { title: 'Korean Soft Casual', type: 'Trending', grad: 'grad-b', action: 'outfit', idx: 4 },
        { title: 'Party Night Glam', type: 'Trending', grad: 'grad-c', action: 'outfit', idx: 5 },
        { title: 'Everyday Unisex Layers', type: 'Trending', grad: 'grad-a', action: 'outfit', idx: 6 },
        { title: 'Clean Minimalist Set', type: 'Trending', grad: 'grad-b', action: 'outfit', idx: 7 },
        { title: 'Casual Outfit', type: 'Inspirasi', grad: 'grad-a', action: 'inspo' },
        { title: 'Hijab Outfit', type: 'Inspirasi', grad: 'grad-b', action: 'inspo' },
        { title: 'Street Style', type: 'Inspirasi', grad: 'grad-c', action: 'inspo' },
        { title: 'Office Outfit', type: 'Inspirasi', grad: 'grad-a', action: 'inspo' },
        { title: 'Party Outfit', type: 'Inspirasi', grad: 'grad-b', action: 'inspo' },
        { title: 'Korean Style Look', type: 'Inspirasi', grad: 'grad-c', action: 'inspo' },
        { title: 'Scan Your Outfit', type: 'Fitur', grad: 'grad-a', action: 'scroll', targetId: 'scan' }
    ];

    function renderResults(items) {
        if (items.length === 0) {
            searchResults.innerHTML = '<div class="search-empty">Nggak ketemu hasil. Coba kata kunci lain.</div>';
            return;
        }
        searchResults.innerHTML = items.map(function (item, i) {
            return '<div class="search-result-item" data-search-idx="' + i + '">' +
                '<span class="sr-swatch ' + item.grad + '"></span>' +
                '<div class="sr-text"><h5>' + item.title + '</h5><span>' + item.type + '</span></div>' +
                '</div>';
        }).join('');

        searchResults.querySelectorAll('.search-result-item').forEach(function (el) {
            el.addEventListener('click', function () {
                var item = items[parseInt(el.getAttribute('data-search-idx'), 10)];
                closeSearch();

                if (item.action === 'category') {
                    var card = document.querySelector('.category-card[data-category="' + item.title + '"]');
                    if (card) card.click();
                } else if (item.action === 'outfit' && window.wearShowOutfitModal) {
                    window.wearShowOutfitModal(item.idx);
                } else if (item.action === 'inspo') {
                    var target = Array.from(document.querySelectorAll('.inspo-item')).find(function (el2) {
                        return el2.getAttribute('data-title').toLowerCase().indexOf(item.title.toLowerCase()) === 0
                            || item.title.toLowerCase().indexOf(el2.getAttribute('data-title').toLowerCase()) === 0;
                    });
                    if (target) target.click();
                } else if (item.action === 'scroll' && item.targetId) {
                    var section = document.getElementById(item.targetId);
                    if (section) section.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    }

    function openSearch() {
        searchOverlay.classList.add('open');
        setTimeout(function () { searchInput.focus(); }, 50);
        renderResults(searchIndex.slice(0, 6));
    }
    function closeSearch() {
        searchOverlay.classList.remove('open');
        searchInput.value = '';
    }

    searchToggle.addEventListener('click', function () {
        if (searchOverlay.classList.contains('open')) closeSearch();
        else openSearch();
    });

    searchInput.addEventListener('input', function () {
        var q = searchInput.value.trim().toLowerCase();
        if (q === '') { renderResults(searchIndex.slice(0, 6)); return; }
        var filtered = searchIndex.filter(function (item) {
            return item.title.toLowerCase().indexOf(q) !== -1;
        });
        renderResults(filtered);
    });

    document.addEventListener('click', function (e) {
        if (!searchOverlay.contains(e.target) && e.target !== searchToggle && !searchToggle.contains(e.target)) {
            closeSearch();
        }
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeSearch();
    });
});