<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friendly Restaurant</title>
    
    <!-- ========================================== -->
    <!-- 📂 ส่วนของ CSS (บน Server จริงควรแยกเป็น /css/style.css) -->
    <!-- ========================================== -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Kanit', sans-serif; }
        .input-field {
            width: 100%; border: 1px solid #d1d5db; border-radius: 0.5rem;
            padding: 0.5rem 0.75rem; transition: all 0.2s;
        }
        .input-field:focus {
            outline: none; border-color: #ef4444; box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.2);
        }
        .fade-in { animation: fadeIn 0.3s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        html { scroll-behavior: smooth; }
        
        /* ซ่อน Scrollbar ของ Promotion แต่ยังเลื่อนได้ */
        .hide-scroll-bar {
            -ms-overflow-style: none; scrollbar-width: none;
        }
        .hide-scroll-bar::-webkit-scrollbar { display: none; }
        .promo-snap { scroll-snap-type: x mandatory; }
        .promo-item { scroll-snap-align: center; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <!-- ========================================== -->
    <!-- 📂 ส่วนของ HTML FRONTEND (หน้าบ้าน) -->
    <!-- ========================================== -->
    <div id="frontend-view" class="flex-1 flex flex-col">
        <!-- Navigation -->
        <nav class="bg-white shadow-md fixed w-full z-50 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex items-center">
                        <img id="nav-logo" src="" alt="Logo" class="h-12 w-12 object-cover rounded-full mr-3 border-2 border-red-100 hidden" onerror="this.style.display='none'" />
                        <i id="nav-logo-icon" data-lucide="chef-hat" class="h-10 w-10 text-red-600 mr-2"></i>
                        <span class="font-bold text-xl md:text-2xl text-gray-900 tracking-tight">
                            Friendly <span class="text-red-600 hidden sm:inline">Restaurant</span>
                        </span>
                    </div>
                    
                    <div class="hidden md:flex items-center space-x-6">
                        <a href="#home" onclick="showMainPage()" class="text-gray-600 hover:text-red-600 font-medium">หน้าแรก</a>
                        <a href="#menu" onclick="showMainPage()" class="text-gray-600 hover:text-red-600 font-medium">เมนูอาหาร</a>
                        <a href="#atmosphere" onclick="showMainPage()" class="text-gray-600 hover:text-red-600 font-medium">บรรยากาศ</a>
                        <a href="#contact" onclick="showMainPage()" class="px-4 py-2 bg-red-600 text-white rounded-full hover:bg-red-700 font-medium transition shadow-md">ติดต่อเรา</a>
                    </div>

                    <div class="md:hidden flex items-center">
                        <button onclick="toggleMobileMenu()" class="text-gray-600 hover:text-red-600">
                            <i data-lucide="menu" class="w-7 h-7"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div id="mobile-menu" class="hidden md:hidden bg-white border-t shadow-lg absolute w-full">
                <div class="px-4 pt-2 pb-6 space-y-2">
                    <a href="#home" onclick="toggleMobileMenu(); showMainPage();" class="block py-3 border-b font-medium">หน้าแรก</a>
                    <a href="#menu" onclick="toggleMobileMenu(); showMainPage();" class="block py-3 border-b font-medium">เมนูอาหาร</a>
                    <a href="#atmosphere" onclick="toggleMobileMenu(); showMainPage();" class="block py-3 border-b font-medium">บรรยากาศ</a>
                    <a href="#contact" onclick="toggleMobileMenu(); showMainPage();" class="block py-3 text-red-600 font-bold">ติดต่อเรา</a>
                </div>
            </div>
        </nav>

        <!-- MAIN CONTENT CONTAINER -->
        <div id="main-content">
            <!-- Hero -->
            <div id="home" class="relative pt-20">
                <div class="absolute inset-0 z-0 h-[60vh] min-h-[400px]">
                    <img id="hero-img" src="" alt="Hero" class="w-full h-full object-cover" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-black/30"></div>
                </div>
                <div class="relative z-10 h-[60vh] min-h-[400px] flex flex-col justify-center items-center text-center px-4">
                    <h1 id="hero-title" class="text-4xl md:text-6xl font-bold text-white mb-6 drop-shadow-xl"></h1>
                    <p id="hero-subtitle" class="text-xl md:text-2xl text-gray-200 mb-10 max-w-2xl drop-shadow-md"></p>
                </div>
            </div>

            <!-- Promotions Carousel -->
            <div id="promotions" class="py-8 bg-white hidden">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center"><i data-lucide="ticket" class="text-red-600 mr-2 w-6 h-6"></i> โปรโมชั่นพิเศษ</h2>
                    <div class="relative w-full overflow-hidden">
                        <div id="promo-track" class="flex overflow-x-auto promo-snap hide-scroll-bar gap-4 pb-4 cursor-grab active:cursor-grabbing">
                            <!-- Promotions injected here -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menu -->
            <div id="menu" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 bg-gray-50">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">เมนูอาหาร</h2>
                    <div class="w-24 h-1 bg-red-600 mx-auto rounded-full"></div>
                </div>
                <div id="menu-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8"></div>
            </div>

            <!-- Atmosphere -->
            <div id="atmosphere" class="bg-white py-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-4">บรรยากาศภายในร้าน</h2>
                        <div class="w-24 h-1 bg-red-600 mx-auto rounded-full"></div>
                    </div>
                    <div id="atmosphere-grid" class="grid grid-cols-1 md:grid-cols-3 gap-6"></div>
                </div>
            </div>

            <!-- Notice Board (Moved to Bottom) -->
            <div id="notice-container" class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative z-20 hidden">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="bg-amber-400 text-amber-900 px-6 py-4 flex items-center font-bold text-lg">
                        <i data-lucide="megaphone" class="mr-2 h-6 w-6"></i> บอร์ดประกาศจากทางร้าน
                    </div>
                    <div id="notice-list" class="p-2"></div>
                </div>
            </div>
        </div>

        <!-- MENU DETAIL PAGE (Hidden by default) -->
        <div id="menu-detail-page" class="hidden flex-1 bg-gray-50 pt-28 pb-16 px-4">
            <div class="max-w-5xl mx-auto fade-in">
                <button onclick="showMainPage()" class="mb-8 flex items-center text-gray-600 hover:text-red-600 font-bold bg-white px-5 py-2.5 rounded-full shadow-sm border border-gray-200 transition">
                    <i data-lucide="arrow-left" class="mr-2 w-5 h-5"></i> ย้อนกลับไปหน้าหลัก
                </button>
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden flex flex-col md:flex-row">
                    <div class="w-full md:w-1/2 bg-gray-100">
                        <img id="detail-img" src="" class="w-full h-full object-cover aspect-square md:aspect-auto" />
                    </div>
                    <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
                        <div id="detail-recommended" class="hidden inline-flex mb-4 bg-yellow-400 text-yellow-900 text-sm font-bold px-4 py-1.5 rounded-full shadow-sm items-center w-max">
                            <i data-lucide="star" class="w-4 h-4 mr-1" style="fill: currentColor"></i> เมนูแนะนำ
                        </div>
                        <h1 id="detail-name" class="text-3xl md:text-5xl font-bold text-gray-900 mb-4"></h1>
                        <div id="detail-price" class="text-3xl font-bold text-red-600 mb-8 inline-block bg-red-50 px-6 py-2 rounded-xl border border-red-100 w-max"></div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2 border-b pb-2">รายละเอียด</h3>
                        <p id="detail-desc" class="text-gray-600 text-lg leading-relaxed"></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer id="contact" class="bg-gray-900 text-white pt-16 pb-8 mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
                    <div>
                        <div class="flex items-center mb-4">
                            <img id="footer-logo" src="" class="h-10 w-10 object-cover rounded-full mr-3 bg-white hidden" />
                            <i id="footer-logo-icon" data-lucide="chef-hat" class="h-8 w-8 text-red-500 mr-2"></i>
                            <span class="font-bold text-2xl tracking-tight"><span class="text-red-500">Friendly</span> Restaurant</span>
                        </div>
                        <p id="footer-subtitle" class="text-gray-400 mb-6"></p>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold mb-4 text-white border-b border-gray-700 pb-2">ติดต่อเรา</h3>
                        <ul id="contact-list" class="space-y-4 text-gray-300"></ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold mb-4 text-white border-b border-gray-700 pb-2">ติดตามเรา</h3>
                        <div id="social-list" class="flex flex-col space-y-4 pt-2"></div>
                    </div>
                </div>
                <div class="border-t border-gray-800 pt-8 text-center text-gray-500 text-sm">
                    <p>Copyright © 2026 <span class="cursor-pointer hover:text-white transition px-2" onclick="showPinModal()">Friendly Group</span>. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Login Modal -->
    <div id="pin-modal" class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-[100] px-4 hidden">
        <div class="bg-white rounded-2xl p-8 max-w-sm w-full shadow-2xl relative fade-in">
            <button onclick="hidePinModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-700"><i data-lucide="x"></i></button>
            <div class="text-center mb-6">
                <div class="bg-red-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4"><i data-lucide="lock" class="h-8 w-8 text-red-600"></i></div>
                <h3 class="text-2xl font-bold">Admin Login</h3>
            </div>
            <form onsubmit="handleLogin(event)">
                <input type="password" id="pin-input" maxlength="6" placeholder="รหัส PIN 6 หลัก" class="w-full text-center text-3xl tracking-widest border-2 border-gray-200 rounded-xl px-4 py-4 mb-4 font-mono" autofocus />
                <p id="pin-error" class="text-red-500 text-sm text-center mb-4 hidden">รหัส PIN ไม่ถูกต้อง</p>
                <button type="submit" id="btn-login" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-4 rounded-xl">เข้าสู่ระบบ</button>
            </form>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- 📂 ส่วนของ HTML BACKEND (หน้าหลังบ้าน) -->
    <!-- ========================================== -->
    <div id="admin-view" class="min-h-screen bg-gray-50 hidden flex-col md:flex-row">
        <div class="w-full md:w-64 bg-gray-900 text-white shrink-0 shadow-xl flex flex-col md:min-h-screen sticky top-0">
            <div class="p-6 flex items-center border-b border-gray-800"><i data-lucide="lock" class="text-red-500 mr-3"></i><span class="font-bold text-xl">ระบบจัดการร้าน</span></div>
            <div class="flex-1 py-4 flex flex-row md:flex-col overflow-x-auto px-2 space-x-1 md:space-x-0 md:space-y-1">
                <button onclick="switchTab('promo')" id="tab-promo" class="admin-tab active flex items-center px-4 py-3 md:px-6 md:py-4 rounded-lg bg-red-600 text-white"><i data-lucide="ticket" class="mr-3 w-5 h-5"></i> โปรโมชั่น</button>
                <button onclick="switchTab('menu')" id="tab-menu" class="admin-tab flex items-center px-4 py-3 md:px-6 md:py-4 rounded-lg text-gray-300"><i data-lucide="menu" class="mr-3 w-5 h-5"></i> เมนูอาหาร</button>
                <button onclick="switchTab('atm')" id="tab-atm" class="admin-tab flex items-center px-4 py-3 md:px-6 md:py-4 rounded-lg text-gray-300"><i data-lucide="image" class="mr-3 w-5 h-5"></i> บรรยากาศร้าน</button>
                <button onclick="switchTab('notice')" id="tab-notice" class="admin-tab flex items-center px-4 py-3 md:px-6 md:py-4 rounded-lg text-gray-300"><i data-lucide="megaphone" class="mr-3 w-5 h-5"></i> บอร์ดประกาศ</button>
                <button onclick="switchTab('contact')" id="tab-contact" class="admin-tab flex items-center px-4 py-3 md:px-6 md:py-4 rounded-lg text-gray-300"><i data-lucide="phone" class="mr-3 w-5 h-5"></i> ติดต่อ/โซเชียล</button>
                <button onclick="switchTab('settings')" id="tab-settings" class="admin-tab flex items-center px-4 py-3 md:px-6 md:py-4 rounded-lg text-gray-300"><i data-lucide="settings" class="mr-3 w-5 h-5"></i> ตั้งค่าทั่วไป</button>
            </div>
            <div class="p-4 border-t border-gray-800 hidden md:block"><button onclick="handleLogout()" class="w-full bg-gray-800 hover:bg-red-600 text-white py-3 rounded-lg"><i data-lucide="log-out" class="inline w-5 h-5 mr-2"></i> ออกจากระบบ</button></div>
        </div>

        <div class="flex-1 p-4 md:p-8 overflow-y-auto">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 max-w-5xl mx-auto min-h-[80vh]">
                
                <!-- Dynamic Content Area -->
                <div id="admin-content-area"></div>

            </div>
            <div class="md:hidden mt-6 pb-6"><button onclick="handleLogout()" class="w-full bg-gray-800 text-white py-4 rounded-xl font-bold">ออกจากระบบแอดมิน</button></div>
        </div>
    </div>


    <!-- ========================================== -->
    <!-- 📂 ส่วนของ JAVASCRIPT (.env, state, logic) -->
    <!-- บน Server จริงควรแยกไฟล์และใช้ .env จริง -->
    <!-- ========================================== -->
    <script>
        // ----------------------------------------------------
        // 1. CONFIGURATION (จำลองไฟล์ .env)
        // ----------------------------------------------------
        const CONFIG = {
            ADMIN_PIN: "000000",
            // หากมี Web App URL ของ Google Script ให้ใส่ตรงนี้
            GOOGLE_SCRIPT_URL: "" // เช่น "https://script.google.com/macros/s/xxxx/exec"
        };

        // ----------------------------------------------------
        // 2. STATE MANAGEMENT (จำลอง Database)
        // ----------------------------------------------------
        let state = {
            promotions: [
                { id: 1, image: 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=1200&q=80', link: '#menu' },
                { id: 2, image: 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1200&q=80', link: 'https://facebook.com' }
            ],
            menuItems: [
                { id: 1, name: 'ผัดไทยกุ้งสด', price: '120', image: 'https://images.unsplash.com/photo-1559314809-0d155014e29e?auto=format&fit=crop&w=800&q=80', description: 'ผัดไทยเส้นจันท์เหนียวนุ่ม กุ้งสดตัวโต', recommended: true },
                { id: 2, name: 'กะเพราเนื้อสับ', price: '95', image: 'https://images.unsplash.com/photo-1626804475297-41609ea064eb?auto=format&fit=crop&w=800&q=80', description: 'เนื้อสับเกรดพรีเมียมผัดกะเพรารสจัดจ้าน', recommended: false },
            ],
            atmospheres: [
                { id: 1, image: 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=800&q=80', caption: 'บรรยากาศด้านใน' },
            ],
            notices: [
                { id: 1, text: 'โปรโมชั่นพิเศษ ลด 10% เมื่อทานครบ 1,000 บาท', linkText: 'ดูเมนู', linkUrl: '#menu' },
            ],
            contacts: [
                { id: 1, type: 'map', text: 'ร้านอาหารเฟรนลี่เรสเตอรอง', url: 'https://maps.app.goo.gl/LWPaJMe25AcdZSBr8?g_st=ic' },
                { id: 2, type: 'phone', text: '098-314-5769', url: 'tel:0983145769' }
            ],
            socials: [
                { id: 1, type: 'facebook', text: 'Facebook : Friendly Restaurant', url: 'https://www.facebook.com/share/1DsJYkHEQr/?mibextid=wwXIfr' },
                { id: 2, type: 'line', text: 'Line Official', url: 'https://line.me/ti/p/' }
            ],
            settings: {
                logo: 'image.png',
                heroImage: 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=1920&q=80',
                title: 'ยินดีต้อนรับสู่ Friendly Restaurant',
                subtitle: 'อาหารอร่อย บรรยากาศดี',
                menuLimit: 8,
                atmLimit: 6
            }
        };

        // --- ตัวแปรสำหรับ Promotion Slider ---
        let promoInterval;

        // ----------------------------------------------------
        // 3. UTILITY FUNCTIONS
        // ----------------------------------------------------
        function convertDriveUrl(url) {
            if (!url) return '';
            const match = url.match(/\/file\/d\/([a-zA-Z0-9_-]+)/);
            if (match && match[1]) return `https://drive.google.com/uc?export=view&id=${match[1]}`;
            return url;
        }

        // --- Google Sheets Sync (โครงสร้างเตรียมไว้) ---
        async function syncToGoogleSheets(action, payload) {
            if(!CONFIG.GOOGLE_SCRIPT_URL) return; // ข้ามถ้าไม่ได้ใส่ URL
            try {
                await fetch(CONFIG.GOOGLE_SCRIPT_URL, {
                    method: 'POST', mode: 'no-cors',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ action: action, data: payload, fullState: state })
                });
            } catch (err) { console.error("Sync Error", err); }
        }

        // ----------------------------------------------------
        // 4. FRONTEND LOGIC
        // ----------------------------------------------------
        function initFrontend() {
            const set = state.settings;
            document.getElementById('hero-img').src = convertDriveUrl(set.heroImage);
            document.getElementById('hero-title').innerText = set.title;
            document.getElementById('hero-subtitle').innerText = set.subtitle;
            document.getElementById('footer-subtitle').innerText = set.subtitle;

            const logoUrl = convertDriveUrl(set.logo);
            ['nav-logo', 'footer-logo'].forEach(id => {
                const img = document.getElementById(id), icon = document.getElementById(id+'-icon');
                if(set.logo) { img.src = logoUrl; img.style.display = 'block'; icon.style.display = 'none'; }
                else { img.style.display = 'none'; icon.style.display = 'block'; }
            });

            // --- Promotions (Slider) ---
            const pCont = document.getElementById('promotions');
            const pTrack = document.getElementById('promo-track');
            if(state.promotions.length > 0) {
                pCont.classList.remove('hidden');
                pTrack.innerHTML = state.promotions.map(p => `
                    <div class="promo-item flex-none w-[90%] md:w-[60%] lg:w-[45%] shrink-0">
                        <a href="${p.link || '#'}" class="block relative rounded-2xl overflow-hidden shadow-lg border border-gray-100">
                            <img src="${convertDriveUrl(p.image)}" class="w-full h-48 md:h-64 object-cover" draggable="false" />
                        </a>
                    </div>
                `).join('');
                initSlider();
            } else pCont.classList.add('hidden');

            // --- Menus ---
            const limitedMenu = state.menuItems.slice(0, set.menuLimit);
            document.getElementById('menu-grid').innerHTML = limitedMenu.map(m => `
                <div onclick="showMenuDetail(${m.id})" class="cursor-pointer bg-white rounded-2xl shadow-md overflow-hidden transition transform hover:-translate-y-1 hover:shadow-xl relative">
                    ${m.recommended ? `<div class="absolute top-3 left-3 bg-yellow-400 text-yellow-900 text-xs font-bold px-2 py-1 rounded shadow"><i data-lucide="star" class="w-3 h-3 inline"></i> แนะนำ</div>` : ''}
                    <img src="${convertDriveUrl(m.image)}" class="w-full h-48 object-cover" />
                    <div class="p-4">
                        <h3 class="text-xl font-bold">${m.name}</h3>
                        <p class="text-red-600 font-bold text-lg mt-1">฿${m.price}</p>
                    </div>
                </div>
            `).join('');

            // --- Atmosphere ---
            const limitedAtm = state.atmospheres.slice(0, set.atmLimit);
            document.getElementById('atmosphere-grid').innerHTML = limitedAtm.map(a => `
                <div class="rounded-xl overflow-hidden shadow-md relative group">
                    <img src="${convertDriveUrl(a.image)}" class="w-full h-48 object-cover group-hover:scale-110 transition duration-500" />
                    <div class="absolute bottom-0 w-full bg-black/50 p-2 text-white font-medium">${a.caption}</div>
                </div>
            `).join('');

            // --- Notice Board ---
            if(state.notices.length > 0){
                document.getElementById('notice-container').classList.remove('hidden');
                document.getElementById('notice-list').innerHTML = state.notices.map(n => `
                    <div class="p-3 border-b border-gray-100 flex justify-between items-center">
                        <span class="font-medium">${n.text}</span>
                        ${n.linkText ? `<a href="${n.linkUrl}" class="bg-amber-100 text-amber-800 px-3 py-1 rounded text-sm font-bold">${n.linkText}</a>` : ''}
                    </div>
                `).join('');
            } else document.getElementById('notice-container').classList.add('hidden');

            // --- Contacts & Socials ---
            const cIcon = (t) => t==='map'?'map-pin':'phone';
            document.getElementById('contact-list').innerHTML = state.contacts.map(c => `
                <li><a href="${c.url}" class="flex items-start hover:text-red-400"><i data-lucide="${cIcon(c.type)}" class="w-5 h-5 mr-3 text-red-500 shrink-0"></i> ${c.text}</a></li>
            `).join('');

            const sIcon = (t) => {
                if(t==='facebook') return '<svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" /></svg>';
                if(t==='line') return '<svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 24 24"><path d="M24 10.304c0-5.369-5.383-9.738-12-9.738-6.616 0-12 4.369-12 9.738 0 4.814 4.269 8.846 10.036 9.608.391.084.922.258 1.057.592.122.303.079.778.039 1.085l-.171 1.027c-.053.303-.242 1.186 1.039.647 1.281-.54 6.911-4.069 9.428-6.967 1.739-1.907 2.572-3.843 2.572-5.992zm-18.988-2.595h2.608c.253 0 .458.205.458.458v.918c0 .253-.205.458-.458.458h-1.69v1.69h1.69c.253 0 .458.205.458.458v.917c0 .253-.205.458-.458.458H5.012c-.253 0-.458-.205-.458-.458v-4.444c0-.253.205-.457.458-.457zm6.837 4.903c0 .253-.205.458-.458.458h-2.608c-.253 0-.458-.205-.458-.458v-4.444c0-.253.205-.457.458-.457h2.608c.253 0 .458.205.458.458v.918c0 .253-.205.458-.458.458h-1.69v.842h1.69c.253 0 .458.205.458.458v.917zm2.464 0c0 .253-.205.458-.458.458h-.917c-.253 0-.458-.205-.458-.458v-4.444c0-.253.205-.457.458-.457h.917c.253 0 .458.205.458.458v4.444zm6.059 0c0 .253-.205.458-.458.458h-2.608c-.253 0-.458-.205-.458-.458v-4.444c0-.253.205-.457.458-.457h2.608c.253 0 .458.205.458.458v.918c0 .253-.205.458-.458.458h-1.69v.842h1.69c.253 0 .458.205.458.458v.917z"/></svg>';
                return '<i data-lucide="link" class="w-5 h-5"></i>';
            }
            document.getElementById('social-list').innerHTML = state.socials.map(s => `
                <a href="${s.url}" class="flex items-center hover:text-white"><div class="bg-white p-1.5 rounded mr-3">${sIcon(s.type)}</div> ${s.text}</a>
            `).join('');

            lucide.createIcons();
        }

        function initSlider() {
            const track = document.getElementById('promo-track');
            if(!track) return;
            clearInterval(promoInterval);
            
            // Auto Scroll
            promoInterval = setInterval(() => {
                const max = track.scrollWidth - track.clientWidth;
                if(track.scrollLeft >= max - 10) track.scrollTo({ left: 0, behavior: 'smooth' });
                else track.scrollBy({ left: track.clientWidth/2, behavior: 'smooth' });
            }, 3000);

            // Drag to Scroll (Mouse)
            let isDown = false; let startX; let scrollLeft;
            track.addEventListener('mousedown', (e) => { isDown = true; startX = e.pageX - track.offsetLeft; scrollLeft = track.scrollLeft; clearInterval(promoInterval); });
            track.addEventListener('mouseleave', () => { isDown = false; initSlider(); });
            track.addEventListener('mouseup', () => { isDown = false; initSlider(); });
            track.addEventListener('mousemove', (e) => {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - track.offsetLeft;
                track.scrollLeft = scrollLeft - ((x - startX) * 2);
            });
            // Touch Pause
            track.addEventListener('touchstart', () => clearInterval(promoInterval));
            track.addEventListener('touchend', () => initSlider());
        }

        // --- Pages ---
        function showMainPage() {
            document.getElementById('menu-detail-page').classList.add('hidden');
            document.getElementById('main-content').classList.remove('hidden');
            window.scrollTo(0,0);
        }

        function showMenuDetail(id) {
            const item = state.menuItems.find(i => i.id === id);
            if(!item) return;
            document.getElementById('main-content').classList.add('hidden');
            document.getElementById('menu-detail-page').classList.remove('hidden');
            
            document.getElementById('detail-img').src = convertDriveUrl(item.image);
            document.getElementById('detail-name').innerText = item.name;
            document.getElementById('detail-price').innerText = `฿${item.price}`;
            document.getElementById('detail-desc').innerText = item.description;
            
            const rec = document.getElementById('detail-recommended');
            if(item.recommended) { rec.classList.remove('hidden'); rec.classList.add('inline-flex'); }
            else { rec.classList.add('hidden'); rec.classList.remove('inline-flex'); }
            window.scrollTo(0,0);
        }

        function toggleMobileMenu() { document.getElementById('mobile-menu').classList.toggle('hidden'); }

        // ----------------------------------------------------
        // 5. ADMIN LOGIN
        // ----------------------------------------------------
        function showPinModal() { document.getElementById('pin-modal').classList.remove('hidden'); }
        function hidePinModal() { document.getElementById('pin-modal').classList.add('hidden'); document.getElementById('pin-error').classList.add('hidden'); }
        function handleLogin(e) {
            e.preventDefault();
            if (document.getElementById('pin-input').value === CONFIG.ADMIN_PIN) {
                document.getElementById('frontend-view').classList.add('hidden');
                document.getElementById('admin-view').classList.remove('hidden');
                document.getElementById('admin-view').classList.add('flex');
                hidePinModal();
                switchTab('promo'); // Default tab
            } else {
                document.getElementById('pin-error').classList.remove('hidden');
            }
        }
        function handleLogout() {
            document.getElementById('admin-view').classList.add('hidden');
            document.getElementById('admin-view').classList.remove('flex');
            document.getElementById('frontend-view').classList.remove('hidden');
            renderFrontend();
        }

        // ----------------------------------------------------
        // 6. ADMIN CRUD LOGIC (Dynamic HTML Generation)
        // ----------------------------------------------------
        function switchTab(tab) {
            // Update Buttons UI
            document.querySelectorAll('.admin-tab').forEach(b => {
                b.classList.remove('bg-red-600', 'text-white');
                b.classList.add('text-gray-300');
            });
            document.getElementById(`tab-${tab}`).classList.remove('text-gray-300');
            document.getElementById(`tab-${tab}`).classList.add('bg-red-600', 'text-white');

            const area = document.getElementById('admin-content-area');
            let html = '';

            if (tab === 'promo') {
                html = generateCrudHTML('โปรโมชั่น', 'promo', state.promotions, [
                    { name: 'image', label: 'URL รูปภาพ (Google Drive)', type: 'url' },
                    { name: 'link', label: 'ลิงก์เป้าหมายเมื่อคลิก', type: 'text' }
                ], (item) => `<img src="${convertDriveUrl(item.image)}" class="h-16 w-32 object-cover rounded mr-4" /> <span class="truncate">${item.link}</span>`);
            } 
            else if (tab === 'menu') {
                html = generateCrudHTML('เมนูอาหาร', 'menu', state.menuItems, [
                    { name: 'name', label: 'ชื่อเมนู', type: 'text' },
                    { name: 'price', label: 'ราคา', type: 'number' },
                    { name: 'image', label: 'URL รูปภาพ', type: 'url' },
                    { name: 'description', label: 'รายละเอียด', type: 'textarea' },
                    { name: 'recommended', label: '⭐ ตั้งเป็นเมนูแนะนำ', type: 'checkbox' }
                ], (item) => `<img src="${convertDriveUrl(item.image)}" class="h-16 w-16 object-cover rounded mr-4" /> <div><b>${item.name}</b> (฿${item.price}) ${item.recommended?'⭐':''}</div>`);
            }
            else if (tab === 'atm') {
                html = generateCrudHTML('บรรยากาศร้าน', 'atm', state.atmospheres, [
                    { name: 'image', label: 'URL รูปภาพ', type: 'url' },
                    { name: 'caption', label: 'คำบรรยาย', type: 'text' }
                ], (item) => `<img src="${convertDriveUrl(item.image)}" class="h-16 w-32 object-cover rounded mr-4" /> <span>${item.caption}</span>`);
            }
            else if (tab === 'notice') {
                html = generateCrudHTML('บอร์ดประกาศ', 'notice', state.notices, [
                    { name: 'text', label: 'ข้อความประกาศ', type: 'textarea' },
                    { name: 'linkText', label: 'ข้อความปุ่มลิงก์', type: 'text' },
                    { name: 'linkUrl', label: 'URL ของปุ่ม', type: 'url' }
                ], (item) => `<div><b>${item.text}</b><br/><small class="text-blue-500">${item.linkUrl}</small></div>`);
            }
            else if (tab === 'contact') {
                html = `
                    <h2 class="text-2xl font-bold mb-6 border-b pb-2">ช่องทางการติดต่อ</h2>
                    ${generateCrudHTML('', 'contact', state.contacts, [
                        { name: 'type', label: 'ประเภท (map / phone)', type: 'select', options: ['map', 'phone'] },
                        { name: 'text', label: 'ข้อความที่จะแสดง', type: 'text' },
                        { name: 'url', label: 'URL หรือ tel:', type: 'text' }
                    ], (item) => `<b>[${item.type}]</b> &nbsp; ${item.text}`)}
                    
                    <h2 class="text-2xl font-bold mb-6 mt-10 border-b pb-2">โซเชียลมีเดีย</h2>
                    ${generateCrudHTML('', 'social', state.socials, [
                        { name: 'type', label: 'แพลตฟอร์ม (facebook / line)', type: 'select', options: ['facebook', 'line'] },
                        { name: 'text', label: 'ข้อความ', type: 'text' },
                        { name: 'url', label: 'URL ลิงก์โซเชียล', type: 'url' }
                    ], (item) => `<b>[${item.type}]</b> &nbsp; ${item.text}`)}
                `;
            }
            else if (tab === 'settings') {
                const s = state.settings;
                html = `
                    <h2 class="text-2xl font-bold mb-6">ตั้งค่าทั่วไป</h2>
                    <form onsubmit="saveSettings(event)" class="space-y-4">
                        <div><label class="block text-sm font-bold mb-1">โลโก้ (ไฟล์ หรือ URL)</label><input type="text" id="s_logo" value="${s.logo}" class="input-field" required></div>
                        <div><label class="block text-sm font-bold mb-1">ภาพปก (Hero URL)</label><input type="url" id="s_hero" value="${s.heroImage}" class="input-field" required></div>
                        <div><label class="block text-sm font-bold mb-1">หัวข้อหลัก</label><input type="text" id="s_title" value="${s.title}" class="input-field" required></div>
                        <div><label class="block text-sm font-bold mb-1">คำบรรยายรอง</label><input type="text" id="s_sub" value="${s.subtitle}" class="input-field" required></div>
                        <div class="grid grid-cols-2 gap-4">
                            <div><label class="block text-sm font-bold mb-1">แสดงเมนู (รายการ)</label><input type="number" id="s_mlim" value="${s.menuLimit}" class="input-field" required></div>
                            <div><label class="block text-sm font-bold mb-1">แสดงบรรยากาศ (รูป)</label><input type="number" id="s_alim" value="${s.atmLimit}" class="input-field" required></div>
                        </div>
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded font-bold">บันทึกการตั้งค่า</button>
                    </form>
                `;
            }

            area.innerHTML = html;
            lucide.createIcons();
        }

        function generateCrudHTML(title, type, dataArray, fields, renderRow) {
            let html = title ? `<div class="flex justify-between items-center mb-4"><h2 class="text-2xl font-bold">${title}</h2> <button onclick="openForm('${type}')" class="bg-green-600 text-white px-4 py-2 rounded flex items-center"><i data-lucide="plus" class="w-4 h-4 mr-1"></i> เพิ่มใหม่</button></div>` : 
                               `<div class="mb-4 text-right"><button onclick="openForm('${type}')" class="bg-green-600 text-white px-4 py-2 rounded text-sm">+ เพิ่มใหม่</button></div>`;
            
            // Form (Hidden by default)
            html += `<form id="form-${type}" class="hidden bg-gray-50 p-4 rounded-xl border mb-6 space-y-4" onsubmit="saveData(event, '${type}')">
                        <input type="hidden" id="${type}-id" />`;
            fields.forEach(f => {
                if (f.type === 'textarea') html += `<div><label class="block text-sm font-bold mb-1">${f.label}</label><textarea id="${type}-${f.name}" class="input-field" rows="2"></textarea></div>`;
                else if (f.type === 'checkbox') html += `<div class="flex items-center"><input type="checkbox" id="${type}-${f.name}" class="w-5 h-5 mr-2" /> <label class="font-bold text-yellow-700">${f.label}</label></div>`;
                else if (f.type === 'select') html += `<div><label class="block text-sm font-bold mb-1">${f.label}</label><select id="${type}-${f.name}" class="input-field">${f.options.map(o=>`<option value="${o}">${o}</option>`).join('')}</select></div>`;
                else html += `<div><label class="block text-sm font-bold mb-1">${f.label}</label><input type="${f.type}" id="${type}-${f.name}" class="input-field" /></div>`;
            });
            html += `<div class="flex justify-end space-x-2"><button type="button" onclick="closeForm('${type}')" class="px-4 py-2 bg-white border rounded">ยกเลิก</button><button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">บันทึก</button></div></form>`;

            // List
            html += `<div class="space-y-3">`;
            dataArray.forEach(item => {
                html += `<div class="flex justify-between items-center bg-white p-3 border rounded-lg shadow-sm hover:bg-gray-50">
                            <div class="flex items-center flex-1 overflow-hidden">${renderRow(item)}</div>
                            <div class="flex space-x-2 shrink-0 ml-4">
                                <button onclick='editData("${type}", ${JSON.stringify(item).replace(/'/g, "&#39;")})' class="p-2 text-blue-600 bg-blue-50 rounded"><i data-lucide="edit" class="w-4 h-4"></i></button>
                                <button onclick="deleteData('${type}', ${item.id})" class="p-2 text-red-600 bg-red-50 rounded"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                            </div>
                        </div>`;
            });
            if(dataArray.length === 0) html += `<div class="text-center text-gray-500 py-4">ไม่มีข้อมูล</div>`;
            html += `</div>`;
            return html;
        }

        function openForm(type) { document.getElementById(`form-${type}`).reset(); document.getElementById(`${type}-id`).value = ''; document.getElementById(`form-${type}`).classList.remove('hidden'); }
        function closeForm(type) { document.getElementById(`form-${type}`).classList.add('hidden'); }
        function editData(type, item) {
            openForm(type);
            document.getElementById(`${type}-id`).value = item.id;
            Object.keys(item).forEach(k => {
                const el = document.getElementById(`${type}-${k}`);
                if(el) { if(el.type === 'checkbox') el.checked = item[k]; else el.value = item[k]; }
            });
        }
        
        function saveData(e, type) {
            e.preventDefault();
            const id = document.getElementById(`${type}-id`).value;
            let newItem = { id: id ? parseInt(id) : Date.now() };
            
            // Extract values dynamically based on inputs inside the form
            const inputs = document.getElementById(`form-${type}`).querySelectorAll('input, textarea, select');
            inputs.forEach(el => {
                if(el.id !== `${type}-id`) {
                    const key = el.id.replace(`${type}-`, '');
                    newItem[key] = el.type === 'checkbox' ? el.checked : el.value;
                }
            });

            const stateKey = type === 'promo' ? 'promotions' : type === 'atm' ? 'atmospheres' : type + 's';
            if(id) state[stateKey] = state[stateKey].map(i => i.id === parseInt(id) ? newItem : i);
            else state[stateKey].push(newItem);
            
            syncToGoogleSheets('save', newItem); // Sync
            
            let activeTab = type;
            if(type === 'contact' || type === 'social') activeTab = 'contact';
            switchTab(activeTab);
        }

        function deleteData(type, id) {
            if(!confirm('ยืนยันการลบ?')) return;
            const stateKey = type === 'promo' ? 'promotions' : type === 'atm' ? 'atmospheres' : type + 's';
            state[stateKey] = state[stateKey].filter(i => i.id !== id);
            syncToGoogleSheets('delete', {id, type}); // Sync
            
            let activeTab = type;
            if(type === 'contact' || type === 'social') activeTab = 'contact';
            switchTab(activeTab);
        }

        function saveSettings(e) {
            e.preventDefault();
            state.settings = {
                logo: document.getElementById('s_logo').value, heroImage: document.getElementById('s_hero').value,
                title: document.getElementById('s_title').value, subtitle: document.getElementById('s_sub').value,
                menuLimit: parseInt(document.getElementById('s_mlim').value), atmLimit: parseInt(document.getElementById('s_alim').value)
            };
            syncToGoogleSheets('settings', state.settings); // Sync
            alert('บันทึกสำเร็จ');
        }

        // Init
        window.onload = () => initFrontend();
    </script>
</body>
</html>
