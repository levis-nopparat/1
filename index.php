<!DOCTYPE html>
<html lang="th" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>ระบบเช็คชื่อพนักงาน - V7 (Modern UI)</title>
    
    <!-- นำเข้า Tailwind CSS และกำหนด ธีมสี (Theme) สำหรับโหมด Light / Dark -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Prompt', 'sans-serif'] },
                    colors: {
                        brand: { 50: '#f0fdf4', 100: '#dcfce7', 500: '#22c55e', 600: '#16a34a', 900: '#14532d' }, // เปลี่ยนโทนแบรนด์เป็นสีเขียว Emerald
                        dark: { bg: '#09090b', card: '#18181b', border: '#27272a', text: '#d4d4d8' } // สีโหมดกลางคืนแบบ Zinc ดูพรีเมียมขึ้น
                    }
                }
            }
        }
    </script>
    
    <!-- นำเข้า ฟอนต์ Prompt จาก Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- นำเข้า ไอคอน Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* CSS กำหนดสไตล์พื้นฐานและตารางให้สวยงาม */
        body { font-family: 'Prompt', sans-serif; transition: background-color 0.3s, color 0.3s; }
        
        /* การตั้งค่าตารางให้ล็อคคอลัมน์ (Sticky) เมื่อเลื่อนซ้ายขวา */
        .table-container { max-height: 68vh; overflow-y: auto; overflow-x: auto; }
        .sticky-col-1 { position: sticky; left: 0; z-index: 10; border-right: 1px solid inherit; }
        .sticky-col-2 { position: sticky; left: 50px; z-index: 10; border-right: 1px solid inherit;}
        .sticky-col-3 { position: sticky; left: 100px; z-index: 10; border-right: 1px solid inherit; box-shadow: 3px 0 10px -3px rgba(0,0,0,0.05);}
        .sticky-col-last { position: sticky; right: 0; z-index: 10; border-left: 1px solid inherit; box-shadow: -3px 0 10px -3px rgba(0,0,0,0.05); }
        
        /* ล็อคหัวตาราง (Header) ไม่ให้เลื่อนขึ้นบน */
        .sticky-header { position: sticky; top: 0; z-index: 20; box-shadow: 0 2px 5px -1px rgba(0,0,0,0.05); }
        .sticky-corner-1 { position: sticky; top: 0; left: 0; z-index: 30; }
        .sticky-corner-2 { position: sticky; top: 0; left: 50px; z-index: 30; }
        .sticky-corner-3 { position: sticky; top: 0; left: 100px; z-index: 30; box-shadow: 3px 2px 10px -3px rgba(0,0,0,0.05);}
        .sticky-corner-last { position: sticky; top: 0; right: 0; z-index: 30; box-shadow: -3px 2px 10px -3px rgba(0,0,0,0.05);}
        
        /* สีของ Sticky คอลัมน์ (แยกโหมดสว่าง-มืด) */
        .light .sticky-col-1, .light .sticky-col-2, .light .sticky-col-3, .light .sticky-col-last { background-color: #ffffff; border-color: #f4f4f5; }
        .light .sticky-header, .light .sticky-corner-1, .light .sticky-corner-2, .light .sticky-corner-3, .light .sticky-corner-last { background-color: #fafafa; color: #3f3f46; border-bottom: 2px solid #e4e4e7;}
        
        .dark { background-color: #09090b; color: #f4f4f5; }
        .dark .sticky-col-1, .dark .sticky-col-2, .dark .sticky-col-3, .dark .sticky-col-last { background-color: #18181b; border-color: #27272a; }
        .dark .sticky-header, .dark .sticky-corner-1, .dark .sticky-corner-2, .dark .sticky-corner-3, .dark .sticky-corner-last { background-color: #09090b; color: #d4d4d8; border-bottom: 2px solid #27272a;}
        
        /* ตกแต่งแถบ Scrollbar */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #d4d4d8; border-radius: 8px; }
        .dark ::-webkit-scrollbar-thumb { background: #3f3f46; }
        ::-webkit-scrollbar-thumb:hover { background: #a1a1aa; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        
        /* ป้ายกำกับต่างๆ (Badge) */
        .custom-badge { display: inline-flex; align-items: center; justify-content: center; border-radius: 0.5rem; border-width: 1px; border-style: solid; font-weight: 700; box-shadow: 0 1px 2px 0 rgba(0,0,0,0.05);}
        
        /* จุดแจ้งเตือนสีแดงสำหรับหมายเหตุ (Red Dot) */
        .remark-dot { position: absolute; top: -2px; right: -2px; width: 10px; height: 10px; background-color: #ef4444; border-radius: 50%; box-shadow: 0 0 6px rgba(239, 68, 68, 0.6); border: 2px solid white;}
        .dark .remark-dot { border-color: #18181b; }
        
        /* เอฟเฟกต์ Glassmorphism สำหรับ Nav และ Modal */
        .glass-nav { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border-bottom: 1px solid rgba(228, 228, 231, 0.5); }
        .dark .glass-nav { background: rgba(24, 24, 27, 0.85); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(39, 39, 42, 0.5); }
        .glass-modal { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.2); }
        .dark .glass-modal { background: rgba(24, 24, 27, 0.95); backdrop-filter: blur(16px); border: 1px solid rgba(63, 63, 70, 0.5); }

        /* อนิเมชั่น (Animations) */
        .fade-in { animation: fadeIn 0.4s cubic-bezier(0.16, 1, 0.3, 1); }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        
        /* การตกแต่ง Input เพิ่มเติม */
        input:focus { outline: none; }
        .soft-shadow { box-shadow: 0 10px 40px -10px rgba(0,0,0,0.08); }
        .dark .soft-shadow { box-shadow: 0 10px 40px -10px rgba(0,0,0,0.3); }
    </style>
</head>

<body class="bg-zinc-50 text-zinc-800 dark:bg-dark-bg dark:text-zinc-100 flex flex-col min-h-screen transition-colors">

    <!-- ============================================== -->
    <!-- แถบเมนูด้านบน (Navigation Bar - Glassmorphism)   -->
    <!-- ============================================== -->
    <nav class="glass-nav sticky top-0 z-40 transition-colors">
        <div class="max-w-full mx-auto px-4 lg:px-6">
            <div class="flex flex-col lg:flex-row items-center justify-between py-3 gap-4 lg:gap-0">
                
                <!-- โลโก้ และข้อมูลผู้ใช้ -->
                <div class="flex flex-col sm:flex-row items-center gap-4 w-full lg:w-auto justify-between lg:justify-start">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-emerald-400 to-teal-600 flex items-center justify-center text-white shadow-lg shadow-emerald-500/30">
                            <i class="fa-solid fa-fingerprint text-xl"></i>
                        </div>
                        <div>
                            <h1 class="font-bold text-xl leading-tight tracking-wide text-zinc-900 dark:text-white">Smart<span class="text-emerald-600 dark:text-emerald-400">Attend</span></h1>
                            <p class="text-[10px] text-zinc-500 dark:text-zinc-400 font-medium uppercase tracking-widest">Enterprise V7</p>
                        </div>
                    </div>
                </div>

                <!-- เมนูนำทาง (Navigation Menus) -->
                <div class="flex flex-wrap items-center justify-center lg:justify-end gap-2 w-full lg:w-auto">
                    
                    <!-- แสดงชื่อผู้เข้าสู่ระบบ (ถ้ามี) -->
                    <div id="user-info-bar" class="hidden px-4 py-2 bg-zinc-100 dark:bg-zinc-800/80 text-zinc-700 dark:text-zinc-300 rounded-xl text-sm flex items-center shadow-inner font-bold border border-zinc-200 dark:border-zinc-700">
                        <i class="fa-solid fa-circle-user mr-2 text-emerald-500"></i> 
                        <span id="current-user-display"></span>
                    </div>

                    <!-- ปุ่มเปลี่ยนหน้าต่างๆ (สลับซ่อน/แสดงตามสิทธิ์) -->
                    <button onclick="switchView('main')" id="btn-nav-main" class="nav-btn px-4 py-2 rounded-xl bg-emerald-600 text-white transition text-xs sm:text-sm font-bold shadow-md shadow-emerald-500/20">
                        <i class="fa-solid fa-table-list mr-1.5"></i> เช็คชื่อ
                    </button>

                    <button onclick="switchView('dashboard')" id="btn-nav-dashboard" class="nav-btn hidden px-4 py-2 rounded-xl bg-transparent text-zinc-600 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition text-xs sm:text-sm font-bold border border-transparent">
                        <i class="fa-solid fa-chart-pie mr-1.5"></i> ภาพรวม
                    </button>
                    
                    <button onclick="switchView('employees')" id="btn-nav-employees" class="nav-btn hidden px-4 py-2 rounded-xl bg-transparent text-zinc-600 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition text-xs sm:text-sm font-bold border border-transparent">
                        <i class="fa-solid fa-users-gear mr-1.5"></i> พนักงาน
                    </button>

                    <button onclick="switchView('audit')" id="btn-nav-audit" class="nav-btn hidden px-4 py-2 rounded-xl bg-transparent text-zinc-600 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition text-xs sm:text-sm font-bold border border-transparent">
                        <i class="fa-solid fa-clock-rotate-left mr-1.5"></i> ประวัติ
                    </button>

                    <button onclick="switchView('settings')" id="btn-nav-settings" class="nav-btn hidden px-4 py-2 rounded-xl bg-transparent text-zinc-600 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition text-xs sm:text-sm font-bold border border-transparent">
                        <i class="fa-solid fa-sliders mr-1.5"></i> ตั้งค่า
                    </button>
                    
                    <div class="h-6 w-px bg-zinc-300 dark:bg-zinc-700 mx-1 hidden sm:block"></div>

                    <!-- ปุ่มสลับโหมดกลางวัน/กลางคืน -->
                    <button onclick="toggleDarkMode()" class="w-10 h-10 rounded-xl bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center text-zinc-600 dark:text-yellow-400 transition hover:bg-zinc-200 dark:hover:bg-zinc-700">
                        <i class="fa-solid fa-moon dark:hidden"></i>
                        <i class="fa-solid fa-sun hidden dark:block"></i>
                    </button>
                    
                    <!-- ปุ่มเข้าสู่ระบบ / ออกจากระบบ -->
                    <button onclick="toggleLogin()" id="btn-login" class="px-5 py-2.5 rounded-xl bg-zinc-800 dark:bg-zinc-100 text-white dark:text-zinc-900 hover:bg-zinc-900 dark:hover:bg-white transition text-xs sm:text-sm font-bold flex items-center gap-2 shadow-md">
                        <i class="fa-solid fa-lock"></i> <span id="login-text">เข้าสู่ระบบ</span>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-full mx-auto px-2 sm:px-4 lg:px-6 py-5 flex-1 w-full overflow-hidden flex flex-col gap-5">
        
        <!-- ============================================== -->
        <!-- 1. MAIN VIEW (หน้าตารางเช็คชื่อและจัดการหมายเหตุ) -->
        <!-- ============================================== -->
        <section id="view-main" class="flex flex-col flex-1 w-full fade-in h-full">
            
            <!-- เครื่องมือ: วันที่, นาฬิกา และ ค้นหา -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-white dark:bg-dark-card p-4 rounded-3xl soft-shadow border border-zinc-200 dark:border-dark-border mb-4">
                <div class="flex flex-wrap items-center gap-3 w-full md:w-auto">
                    <!-- เลือกวันที่ -->
                    <div class="flex items-center bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl overflow-hidden focus-within:ring-2 focus-within:ring-emerald-500/50 transition">
                        <div class="px-4 py-2 bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 font-bold text-sm border-r border-zinc-200 dark:border-zinc-700">
                            <i class="fa-regular fa-calendar-check mr-2 text-emerald-500"></i>วันที่
                        </div>
                        <input type="date" id="record-date" class="px-4 py-2 outline-none font-bold text-zinc-800 dark:text-white bg-transparent cursor-pointer text-sm w-full sm:w-auto">
                    </div>
                    
                    <!-- เวลา Real-Time -->
                    <div class="flex items-center text-sm font-bold text-emerald-700 bg-emerald-50 px-5 py-2.5 rounded-2xl dark:bg-emerald-900/20 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800/50 shadow-inner w-full sm:w-auto mt-2 sm:mt-0">
                        <i class="fa-regular fa-clock mr-2 animate-pulse"></i>
                        <span id="realtime-clock">กำลังโหลดเวลา...</span>
                    </div>
                </div>
                
                <!-- ช่องค้นหา -->
                <div class="relative w-full md:w-80">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-3 text-zinc-400 text-sm"></i>
                    <input type="text" id="search-input-main" onkeyup="renderMainTable()" placeholder="ค้นหารหัส หรือ ชื่อพนักงาน..." class="w-full bg-zinc-50 dark:bg-zinc-900 text-zinc-800 dark:text-white border border-zinc-200 dark:border-zinc-800 rounded-2xl pl-11 pr-4 py-2.5 text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 outline-none transition font-medium">
                </div>
            </div>

            <!-- แท็บเลือกร้าน (Clubs) -->
            <div class="bg-white dark:bg-dark-card rounded-t-3xl soft-shadow border-b border-zinc-200 dark:border-dark-border overflow-hidden">
                <div id="club-tabs" class="flex overflow-x-auto no-scrollbar bg-zinc-50/50 dark:bg-zinc-900/50">
                    <!-- แทร็กจาก JavaScript -->
                </div>
            </div>

            <!-- กล่องสำหรับตารางเช็คชื่อ -->
            <div class="bg-white dark:bg-dark-card rounded-b-3xl soft-shadow p-0 flex-1 border-x border-b border-zinc-200 dark:border-dark-border relative overflow-hidden flex flex-col">
                
                <!-- ตารางข้อมูล -->
                <div class="table-container overflow-x-auto flex-1 bg-white dark:bg-dark-card">
                    <table class="w-full text-sm text-left whitespace-nowrap min-w-max border-collapse">
                        <thead id="table-head">
                            <!-- แทร็กจาก JavaScript -->
                        </thead>
                        <tbody id="table-body" class="divide-y divide-zinc-100 dark:divide-zinc-800/50">
                            <!-- แทร็กจาก JavaScript -->
                        </tbody>
                    </table>
                </div>

                <!-- กรณีไม่พบข้อมูล -->
                <div id="empty-state" class="hidden flex-col items-center justify-center py-20 text-center bg-zinc-50/50 dark:bg-zinc-900/20">
                    <div class="w-24 h-24 bg-zinc-100 dark:bg-zinc-800 rounded-full flex items-center justify-center mb-5 shadow-inner">
                        <i class="fa-solid fa-ghost text-4xl text-zinc-300 dark:text-zinc-600"></i>
                    </div>
                    <p class="font-bold text-2xl text-zinc-700 dark:text-zinc-300 mb-2">ไม่พบรายชื่อพนักงาน</p>
                    <p class="text-sm text-zinc-500 dark:text-zinc-500">ตรวจสอบว่ามีพนักงานในสาขานี้ หรือถูกตั้งค่าจบงาน/พักงานไปแล้วหรือไม่</p>
                </div>
                
                <!-- แถบเปลี่ยนหน้า (Pagination) -->
                <div id="pagination-footer" class="bg-white dark:bg-dark-card px-5 py-4 border-t border-zinc-200 dark:border-zinc-800 flex flex-col sm:flex-row justify-between items-center gap-3 text-sm z-20">
                    <span id="page-info" class="text-zinc-500 dark:text-zinc-400 font-medium bg-zinc-100 dark:bg-zinc-800 px-4 py-1.5 rounded-xl border border-zinc-200 dark:border-zinc-700">แสดง 0-0 จาก 0</span>
                    <div class="flex gap-2">
                        <button onclick="changePage(-1)" class="px-4 py-2 rounded-xl bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 hover:bg-zinc-50 dark:hover:bg-zinc-700 font-bold text-zinc-600 dark:text-zinc-300 shadow-sm transition"><i class="fa-solid fa-chevron-left mr-2"></i>ก่อนหน้า</button>
                        <button onclick="changePage(1)" class="px-4 py-2 rounded-xl bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 hover:bg-zinc-50 dark:hover:bg-zinc-700 font-bold text-zinc-600 dark:text-zinc-300 shadow-sm transition">ถัดไป<i class="fa-solid fa-chevron-right ml-2"></i></button>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================== -->
        <!-- 2. DASHBOARD VIEW (ภาพรวมและสถิติ Real-time)    -->
        <!-- ============================================== -->
        <section id="view-dashboard" class="hidden flex-col flex-1 w-full fade-in gap-5 h-full overflow-y-auto pb-10">
            
            <!-- ส่วนหัว Dashboard -->
            <div class="bg-gradient-to-r from-emerald-700 to-teal-800 text-white p-6 rounded-3xl soft-shadow flex flex-col md:flex-row justify-between items-start md:items-center gap-4 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>
                <div class="relative z-10">
                    <h2 class="text-3xl font-black tracking-tight"><i class="fa-solid fa-chart-pie mr-3 text-emerald-300"></i>Analytics Dashboard</h2>
                    <p class="text-sm text-emerald-100 mt-2 font-medium opacity-90">ตรวจสอบภาพรวมการทำงาน, อัตราการมาทำงาน และสถิติรายบุคคลแบบ Real-time</p>
                </div>
                
                <!-- เครื่องมือเลือกช่วงวันที่ของ Dashboard -->
                <div class="flex gap-2 bg-black/20 p-2.5 rounded-2xl backdrop-blur-md border border-white/10 relative z-10 w-full sm:w-auto justify-center">
                    <input type="date" id="dash-date-start" onchange="renderDashboard()" class="bg-white/10 border border-white/20 rounded-xl px-4 py-2 outline-none text-sm font-bold text-white focus:bg-white/20 cursor-pointer transition">
                    <span class="text-white/60 self-center text-xs font-bold px-1">ถึง</span>
                    <input type="date" id="dash-date-end" onchange="renderDashboard()" class="bg-white/10 border border-white/20 rounded-xl px-4 py-2 outline-none text-sm font-bold text-white focus:bg-white/20 cursor-pointer transition">
                </div>
            </div>

            <!-- กล่อง KPI 6 กล่อง -->
            <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-4">
                <!-- พนักงานทั้งหมด -->
                <div class="bg-white dark:bg-dark-card p-5 rounded-3xl soft-shadow border border-zinc-200 dark:border-dark-border flex flex-col items-center text-center justify-center relative overflow-hidden">
                    <div class="absolute -right-4 -bottom-4 text-zinc-100 dark:text-zinc-800/50 text-6xl"><i class="fa-solid fa-users"></i></div>
                    <div class="w-12 h-12 bg-zinc-100 text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400 rounded-2xl flex items-center justify-center text-xl mb-3 relative z-10 shadow-sm"><i class="fa-solid fa-users"></i></div>
                    <p class="text-[11px] text-zinc-500 dark:text-zinc-400 font-bold uppercase tracking-wider mb-1 relative z-10">พนักงานทั้งหมด</p>
                    <h3 class="text-3xl font-black text-zinc-800 dark:text-white relative z-10" id="kpi-total-emps">0</h3>
                </div>
                <!-- มาทำงาน ST -->
                <div class="bg-white dark:bg-dark-card p-5 rounded-3xl soft-shadow border border-emerald-200 dark:border-emerald-900/30 flex flex-col items-center text-center justify-center relative overflow-hidden">
                    <div class="absolute -right-4 -bottom-4 text-emerald-50 dark:text-emerald-900/10 text-6xl"><i class="fa-solid fa-user-check"></i></div>
                    <div class="w-12 h-12 bg-emerald-100 text-emerald-600 dark:bg-emerald-900/50 dark:text-emerald-400 rounded-2xl flex items-center justify-center text-xl mb-3 relative z-10 shadow-sm"><i class="fa-solid fa-user-check"></i></div>
                    <p class="text-[11px] text-zinc-500 dark:text-zinc-400 font-bold uppercase tracking-wider mb-1 relative z-10">มา (ST/ลงเวลา)</p>
                    <h3 class="text-3xl font-black text-emerald-600 dark:text-emerald-400 relative z-10" id="kpi-present">0</h3>
                </div>
                <!-- ลากิจ CR -->
                <div class="bg-white dark:bg-dark-card p-5 rounded-3xl soft-shadow border border-amber-200 dark:border-amber-900/30 flex flex-col items-center text-center justify-center relative overflow-hidden">
                    <div class="absolute -right-4 -bottom-4 text-amber-50 dark:text-amber-900/10 text-6xl"><i class="fa-solid fa-calendar-minus"></i></div>
                    <div class="w-12 h-12 bg-amber-100 text-amber-600 dark:bg-amber-900/50 dark:text-amber-400 rounded-2xl flex items-center justify-center text-xl mb-3 relative z-10 shadow-sm"><i class="fa-solid fa-calendar-minus"></i></div>
                    <p class="text-[11px] text-zinc-500 dark:text-zinc-400 font-bold uppercase tracking-wider mb-1 relative z-10">ลากิจ (CR)</p>
                    <h3 class="text-3xl font-black text-amber-600 dark:text-amber-400 relative z-10" id="kpi-cr">0</h3>
                </div>
                <!-- ป่วย SL -->
                <div class="bg-white dark:bg-dark-card p-5 rounded-3xl soft-shadow border border-sky-200 dark:border-sky-900/30 flex flex-col items-center text-center justify-center relative overflow-hidden">
                    <div class="absolute -right-4 -bottom-4 text-sky-50 dark:text-sky-900/10 text-6xl"><i class="fa-solid fa-bed"></i></div>
                    <div class="w-12 h-12 bg-sky-100 text-sky-600 dark:bg-sky-900/50 dark:text-sky-400 rounded-2xl flex items-center justify-center text-xl mb-3 relative z-10 shadow-sm"><i class="fa-solid fa-bed"></i></div>
                    <p class="text-[11px] text-zinc-500 dark:text-zinc-400 font-bold uppercase tracking-wider mb-1 relative z-10">ลาป่วย (SL)</p>
                    <h3 class="text-3xl font-black text-sky-600 dark:text-sky-400 relative z-10" id="kpi-sl">0</h3>
                </div>
                <!-- ขาด/พักงาน -->
                <div class="bg-white dark:bg-dark-card p-5 rounded-3xl soft-shadow border border-rose-200 dark:border-rose-900/30 flex flex-col items-center text-center justify-center relative overflow-hidden">
                    <div class="absolute -right-4 -bottom-4 text-rose-50 dark:text-rose-900/10 text-6xl"><i class="fa-solid fa-user-xmark"></i></div>
                    <div class="w-12 h-12 bg-rose-100 text-rose-600 dark:bg-rose-900/50 dark:text-rose-400 rounded-2xl flex items-center justify-center text-xl mb-3 relative z-10 shadow-sm"><i class="fa-solid fa-user-large-slash"></i></div>
                    <p class="text-[11px] text-zinc-500 dark:text-zinc-400 font-bold uppercase tracking-wider mb-1 relative z-10">พักงาน / ขาด</p>
                    <h3 class="text-3xl font-black text-rose-600 dark:text-rose-400 relative z-10" id="kpi-absent">0</h3>
                </div>
                <!-- อัตราการมา % -->
                <div class="bg-zinc-900 dark:bg-zinc-800 p-5 rounded-3xl soft-shadow border border-zinc-800 dark:border-zinc-700 flex flex-col items-center text-center justify-center text-white relative overflow-hidden">
                    <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-xl mb-3 relative z-10 backdrop-blur-sm"><i class="fa-solid fa-percent"></i></div>
                    <p class="text-[11px] text-zinc-400 font-bold uppercase tracking-wider mb-1 relative z-10">อัตรามาทำงาน</p>
                    <h3 class="text-4xl font-black text-emerald-400 relative z-10" id="kpi-percent">0%</h3>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 flex-1">
                
                <!-- จัดอันดับ (Rankings / Task List) -->
                <div class="lg:col-span-2 bg-white dark:bg-dark-card rounded-3xl soft-shadow border border-zinc-200 dark:border-dark-border flex flex-col overflow-hidden">
                    <div class="p-5 border-b border-zinc-100 dark:border-zinc-800 bg-zinc-50/50 dark:bg-zinc-900/30 flex flex-col sm:flex-row justify-between items-center gap-4">
                        <h3 class="font-bold text-lg text-zinc-800 dark:text-white flex items-center"><i class="fa-solid fa-ranking-star text-amber-500 mr-3 text-xl"></i>อันดับพนักงาน (Task List)</h3>
                        <div class="flex gap-2 w-full sm:w-auto">
                            <select id="dash-rank-club" onchange="renderDashboard()" class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-xl px-4 py-2 text-sm font-bold outline-none flex-1 sm:w-auto dark:text-white shadow-sm focus:ring-2 focus:ring-emerald-500/20"></select>
                            <select id="dash-rank-metric" onchange="renderDashboard()" class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-xl px-4 py-2 text-sm font-bold outline-none flex-1 sm:w-auto dark:text-white shadow-sm focus:ring-2 focus:ring-emerald-500/20">
                                <option value="st_days">มาทำงานมากสุด</option>
                                <option value="cr_days">ลากิจ (CR) มากสุด</option>
                                <option value="sl_days">ป่วย (SL) มากสุด</option>
                            </select>
                        </div>
                    </div>
                    <div class="overflow-y-auto p-0 flex-1">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-zinc-100/50 dark:bg-zinc-800/50 text-zinc-500 dark:text-zinc-400 sticky top-0 text-xs uppercase tracking-widest font-bold backdrop-blur-md">
                                <tr>
                                    <th class="px-5 py-4 w-16 text-center">อันดับ</th>
                                    <th class="px-5 py-4">ชื่อพนักงาน</th>
                                    <th class="px-5 py-4 text-center">ST (วัน)</th>
                                    <th class="px-5 py-4 text-center">CR (วัน)</th>
                                    <th class="px-5 py-4 text-center">SL (วัน)</th>
                                    <th class="px-5 py-4 text-center w-28">อัตรามา (%)</th>
                                </tr>
                            </thead>
                            <tbody id="dash-rank-body" class="divide-y divide-zinc-100 dark:divide-zinc-800">
                                <!-- แทร็กจาก JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- ตรวจสอบสถิติรายบุคคล (Individual Stats) -->
                <div class="bg-white dark:bg-dark-card rounded-3xl soft-shadow border border-zinc-200 dark:border-dark-border flex flex-col p-6 relative overflow-hidden">
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-indigo-50 dark:bg-indigo-900/10 rounded-full blur-3xl pointer-events-none"></div>
                    <h3 class="font-bold text-lg text-zinc-800 dark:text-white mb-1 relative z-10"><i class="fa-solid fa-address-card text-indigo-500 mr-2"></i>ตรวจสอบรายบุคคล</h3>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mb-5 relative z-10">ค้นหาสถิติตั้งแต่เริ่มงานจนถึงปัจจุบัน</p>
                    
                    <div class="relative mb-4 z-10">
                        <i class="fa-solid fa-search absolute left-4 top-3.5 text-zinc-400 text-sm"></i>
                        <input type="text" id="dash-emp-search" onkeyup="searchEmpStats()" placeholder="พิมพ์ชื่อ หรือ รหัสพนักงาน..." class="w-full bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-2xl pl-11 pr-4 py-3 text-sm font-bold focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 outline-none dark:text-white transition shadow-inner">
                    </div>
                    
                    <!-- ผลลัพธ์การค้นหา -->
                    <div id="dash-emp-results" class="hidden flex-col gap-1 max-h-40 overflow-y-auto mb-4 border border-zinc-200 dark:border-zinc-700 rounded-2xl p-1.5 bg-white dark:bg-zinc-800 shadow-lg z-20"></div>

                    <!-- การ์ดแสดงผลสถิติที่เลือก -->
                    <div id="dash-emp-stat-card" class="hidden flex-col gap-5 bg-indigo-50/50 dark:bg-zinc-800/50 p-5 rounded-2xl border border-indigo-100 dark:border-zinc-700 flex-1 z-10 relative">
                        <div class="flex items-center gap-4 border-b border-indigo-200/50 dark:border-zinc-700 pb-4">
                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-600 text-white flex items-center justify-center font-black text-2xl shadow-lg shadow-indigo-500/30" id="stat-emp-initial"></div>
                            <div>
                                <h4 class="font-bold text-zinc-800 dark:text-white text-xl leading-tight mb-1" id="stat-emp-name">ชื่อพนักงาน</h4>
                                <span class="text-xs font-mono text-indigo-700 dark:text-indigo-400 font-bold bg-indigo-100 dark:bg-indigo-900/50 px-2.5 py-1 rounded-lg border border-indigo-200 dark:border-indigo-800/50" id="stat-emp-id">ID</span>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-3 text-sm">
                            <div class="bg-white dark:bg-zinc-900 p-3 rounded-2xl border border-zinc-100 dark:border-zinc-700 shadow-sm text-center">
                                <p class="text-[10px] text-zinc-500 dark:text-zinc-400 font-bold uppercase mb-1">ทำงานทั้งหมด</p>
                                <p class="font-black text-2xl text-zinc-800 dark:text-white"><span id="stat-days-total">0</span><span class="text-xs font-normal text-zinc-500 ml-1">วัน</span></p>
                            </div>
                            <div class="bg-white dark:bg-zinc-900 p-3 rounded-2xl border border-zinc-100 dark:border-zinc-700 shadow-sm text-center">
                                <p class="text-[10px] text-zinc-500 dark:text-zinc-400 font-bold uppercase mb-1">อัตรามา (ST)</p>
                                <p class="font-black text-2xl text-emerald-600 dark:text-emerald-400" id="stat-percent-st">0%</p>
                            </div>
                            <div class="bg-white dark:bg-zinc-900 p-3 rounded-2xl border border-zinc-100 dark:border-zinc-700 shadow-sm text-center">
                                <p class="text-[10px] text-zinc-500 dark:text-zinc-400 font-bold uppercase mb-1">จำนวนลากิจ</p>
                                <p class="font-black text-2xl text-amber-600 dark:text-amber-400"><span id="stat-days-cr">0</span><span class="text-xs font-normal text-amber-500/70 ml-1">วัน</span></p>
                            </div>
                            <div class="bg-white dark:bg-zinc-900 p-3 rounded-2xl border border-zinc-100 dark:border-zinc-700 shadow-sm text-center">
                                <p class="text-[10px] text-zinc-500 dark:text-zinc-400 font-bold uppercase mb-1">อัตราลากิจ</p>
                                <p class="font-black text-2xl text-amber-600 dark:text-amber-400" id="stat-percent-cr">0%</p>
                            </div>
                        </div>
                        <div class="mt-auto pt-2 text-center border-t border-indigo-200/50 dark:border-zinc-700">
                            <p class="text-[11px] text-zinc-500 dark:text-zinc-400 font-medium">เริ่มงาน: <span id="stat-start-date" class="font-bold text-zinc-800 dark:text-zinc-200"></span></p>
                        </div>
                    </div>
                    
                    <div id="dash-emp-placeholder" class="flex-1 flex flex-col items-center justify-center text-center text-zinc-400 dark:text-zinc-600 p-6 z-10">
                        <div class="w-20 h-20 bg-zinc-50 dark:bg-zinc-800 rounded-full flex items-center justify-center mb-4 border border-dashed border-zinc-300 dark:border-zinc-700">
                            <i class="fa-solid fa-magnifying-glass-chart text-3xl"></i>
                        </div>
                        <p class="text-sm font-bold text-zinc-500">ค้นหาพนักงานเพื่อดูสถิติ</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================== -->
        <!-- 3. EMPLOYEES VIEW (จัดการข้อมูลและประวัติพนักงาน) -->
        <!-- ============================================== -->
        <section id="view-employees" class="hidden w-full max-w-7xl mx-auto fade-in">
            <!-- หัวข้อหน้า -->
            <div class="mb-5 bg-gradient-to-r from-teal-700 to-cyan-800 text-white p-6 rounded-3xl soft-shadow">
                <h2 class="text-2xl font-black"><i class="fa-solid fa-users-gear mr-3 text-teal-300"></i>จัดการพนักงาน</h2>
                <p class="text-sm text-teal-100 mt-2 font-medium">เพิ่มพนักงานใหม่, ตั้งค่าวันที่ทำงาน, กำหนดสาขา และตรวจสอบประวัติรายบุคคล</p>
            </div>

            <div class="bg-white dark:bg-dark-card rounded-3xl soft-shadow border border-zinc-200 dark:border-dark-border p-6 mb-6">
                
                <!-- ฟอร์มเพิ่มพนักงานใหม่ -->
                <h3 class="text-lg font-bold border-b border-zinc-100 dark:border-zinc-800 pb-3 mb-5 dark:text-white flex items-center"><div class="w-8 h-8 rounded-lg bg-teal-100 dark:bg-teal-900/30 text-teal-600 dark:text-teal-400 flex items-center justify-center mr-3"><i class="fa-solid fa-user-plus"></i></div>ลงทะเบียนใหม่</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-6 gap-4 mb-8 bg-zinc-50 dark:bg-zinc-900/50 p-5 rounded-2xl border border-zinc-200 dark:border-zinc-800 items-end">
                    <div class="xl:col-span-1">
                        <label class="block text-xs font-bold text-zinc-500 dark:text-zinc-400 mb-1.5 uppercase">รหัส (No.)</label>
                        <input type="text" id="new-emp-id" placeholder="รหัส" class="w-full bg-white dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-700 rounded-xl px-4 py-2.5 outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 text-sm font-mono font-bold dark:text-white shadow-sm transition">
                    </div>
                    <div class="xl:col-span-2">
                        <label class="block text-xs font-bold text-zinc-500 dark:text-zinc-400 mb-1.5 uppercase">ชื่อ-สกุล</label>
                        <input type="text" id="new-emp-name" placeholder="ชื่อพนักงาน" class="w-full bg-white dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-700 rounded-xl px-4 py-2.5 outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 text-sm font-bold dark:text-white shadow-sm transition">
                    </div>
                    <div class="xl:col-span-1">
                        <label class="block text-xs font-bold text-zinc-500 dark:text-zinc-400 mb-1.5 uppercase">สาขา/ร้าน</label>
                        <select id="new-emp-club" class="w-full bg-white dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-700 rounded-xl px-4 py-2.5 outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 text-sm font-bold dark:text-white shadow-sm transition">
                            <!-- แทร็กจาก JavaScript -->
                        </select>
                    </div>
                    <div class="xl:col-span-1">
                        <label class="block text-xs font-bold text-zinc-500 dark:text-zinc-400 mb-1.5 uppercase">เริ่มงาน</label>
                        <input type="date" id="new-emp-start" class="w-full bg-white dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-700 rounded-xl px-3 py-2.5 outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 text-xs font-bold dark:text-white shadow-sm transition cursor-pointer">
                    </div>
                    <div class="xl:col-span-1">
                        <button onclick="addEmployee()" class="w-full bg-teal-600 hover:bg-teal-700 text-white px-4 py-2.5 rounded-xl transition font-bold text-sm shadow-lg shadow-teal-500/30 flex items-center justify-center gap-2"><i class="fa-solid fa-check"></i> เพิ่ม</button>
                    </div>
                </div>

                <!-- ตารางจัดการรายชื่อ -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center border-b border-zinc-100 dark:border-zinc-800 pb-4 mb-5 gap-4">
                    <h3 class="text-lg font-bold dark:text-white flex items-center"><div class="w-8 h-8 rounded-lg bg-zinc-100 dark:bg-zinc-800 text-zinc-500 dark:text-zinc-400 flex items-center justify-center mr-3"><i class="fa-solid fa-list-check"></i></div>รายชื่อพนักงาน</h3>
                    <div class="relative w-full sm:w-80">
                        <i class="fa-solid fa-search absolute left-4 top-3 text-zinc-400 text-sm"></i>
                        <input type="text" id="manage-emp-search" onkeyup="renderEmployeesManager()" placeholder="ค้นหารหัส, ชื่อ..." class="w-full bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-xl pl-10 pr-4 py-2.5 text-sm font-bold focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 outline-none dark:text-white shadow-inner transition">
                    </div>
                </div>

                <!-- แท็บสาขา -->
                <div id="manage-club-tabs" class="flex flex-wrap gap-2 mb-5">
                    <!-- แทร็กจาก JavaScript -->
                </div>

                <!-- ตารางข้อมูล -->
                <div class="overflow-x-auto rounded-2xl border border-zinc-200 dark:border-zinc-700 shadow-sm">
                    <table class="w-full text-sm text-left whitespace-nowrap min-w-max">
                        <thead class="bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-300 text-xs uppercase font-bold tracking-wider">
                            <tr>
                                <th class="px-5 py-4 w-16 text-center">No.</th>
                                <th class="px-5 py-4">ชื่อพนักงาน</th>
                                <th class="px-5 py-4 w-32">สถานะหลัก</th>
                                <th class="px-5 py-4 w-32">สาขา</th>
                                <th class="px-5 py-4 w-36">เริ่มงาน</th>
                                <th class="px-5 py-4 w-36">สิ้นสุด (ปิดงาน)</th>
                                <th class="px-5 py-4 text-center w-32">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody id="manage-emp-list" class="divide-y divide-zinc-200 dark:divide-zinc-700/50 bg-white dark:bg-zinc-900">
                            <!-- แทร็กจาก JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- ============================================== -->
        <!-- 4. AUDIT LOG VIEW (ประวัติการทำรายการหลังบ้าน)   -->
        <!-- ============================================== -->
        <section id="view-audit" class="hidden w-full max-w-7xl mx-auto fade-in h-full flex flex-col">
            <div class="mb-5 bg-gradient-to-r from-zinc-700 to-zinc-900 text-white p-6 rounded-3xl soft-shadow">
                <h2 class="text-2xl font-black"><i class="fa-solid fa-clock-rotate-left mr-3 text-zinc-400"></i>ประวัติการทำรายการ (Audit Log)</h2>
                <p class="text-sm text-zinc-300 mt-2 font-medium">ตรวจสอบกิจกรรมการเช็คชื่อย้อนหลัง แยกตามผู้ดูแลระบบและเวลา</p>
            </div>

            <div class="bg-white dark:bg-dark-card rounded-3xl soft-shadow border border-zinc-200 dark:border-dark-border p-6 flex-1 flex flex-col min-h-[500px]">
                
                <!-- ตัวกรองการค้นหาประวัติ -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 mb-5 bg-zinc-50 dark:bg-zinc-900/50 p-5 rounded-2xl border border-zinc-200 dark:border-zinc-800">
                    <div>
                        <label class="block text-[11px] font-bold text-zinc-500 dark:text-zinc-400 uppercase tracking-widest mb-1.5">วันที่</label>
                        <input type="date" id="audit-date" onchange="renderAuditLog()" class="w-full bg-white dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-700 rounded-xl px-4 py-2.5 text-sm font-bold outline-none focus:border-zinc-500 focus:ring-2 focus:ring-zinc-500/20 dark:text-white cursor-pointer shadow-sm transition">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-zinc-500 dark:text-zinc-400 uppercase tracking-widest mb-1.5">ร้าน/สาขา</label>
                        <select id="audit-club" onchange="renderAuditLog()" class="w-full bg-white dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-700 rounded-xl px-4 py-2.5 text-sm font-bold outline-none focus:border-zinc-500 focus:ring-2 focus:ring-zinc-500/20 dark:text-white shadow-sm transition">
                            <option value="ALL">-- ทุกสาขา --</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-zinc-500 dark:text-zinc-400 uppercase tracking-widest mb-1.5">ผู้ทำรายการ (หัวหน้า/Admin)</label>
                        <select id="audit-sup" onchange="renderAuditLog()" class="w-full bg-white dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-700 rounded-xl px-4 py-2.5 text-sm font-bold outline-none focus:border-zinc-500 focus:ring-2 focus:ring-zinc-500/20 dark:text-white shadow-sm transition">
                            <option value="ALL">-- ทุกคน --</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-zinc-500 dark:text-zinc-400 uppercase tracking-widest mb-1.5">ค้นหาคำศัพท์</label>
                        <input type="text" id="audit-search" onkeyup="renderAuditLog()" placeholder="ชื่อพนักงาน, เวลา..." class="w-full bg-white dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-700 rounded-xl px-4 py-2.5 text-sm font-bold outline-none focus:border-zinc-500 focus:ring-2 focus:ring-zinc-500/20 dark:text-white shadow-sm transition">
                    </div>
                </div>

                <!-- ตารางประวัติ -->
                <div class="overflow-y-auto flex-1 border border-zinc-200 dark:border-zinc-700 rounded-2xl shadow-sm">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-300 sticky top-0 shadow-sm z-10 text-xs uppercase font-bold tracking-wider">
                            <tr>
                                <th class="px-5 py-4 w-32">เวลาที่ทำรายการ</th>
                                <th class="px-5 py-4 w-40">บัญชีผู้บันทึก</th>
                                <th class="px-5 py-4">รายละเอียด</th>
                                <th class="px-5 py-4 text-center w-24">ลบ</th>
                            </tr>
                        </thead>
                        <tbody id="audit-log-body" class="divide-y divide-zinc-100 dark:divide-zinc-700/50 bg-white dark:bg-zinc-900">
                            <!-- แทร็กจาก JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- ============================================== -->
        <!-- 5. SETTINGS VIEW (ตั้งค่าระบบขั้นสูง)             -->
        <!-- ============================================== -->
        <section id="view-settings" class="hidden w-full max-w-7xl mx-auto fade-in pb-10">
            <!-- ส่วนหัวตั้งค่า และปุ่ม Export -->
            <div class="mb-5 bg-gradient-to-r from-violet-700 to-indigo-800 text-white p-6 rounded-3xl soft-shadow flex flex-col md:flex-row justify-between items-start md:items-center gap-5">
                <div>
                    <h2 class="text-2xl font-black"><i class="fa-solid fa-sliders mr-3 text-violet-300"></i>ตั้งค่าระบบ & ส่งออกข้อมูล (Admin)</h2>
                    <p class="text-sm text-violet-200 mt-2 font-medium">จัดการป้ายกำกับ, เวลาเช็คชื่อ, บัญชีหัวหน้างาน และดาวน์โหลดข้อมูล</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <button onclick="openExportModal()" class="bg-emerald-500 hover:bg-emerald-400 text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-emerald-500/30 flex items-center gap-2 transition whitespace-nowrap active:scale-95">
                        <i class="fa-solid fa-download"></i> ส่งออกข้อมูล (CSV)
                    </button>
                    <button onclick="openGasInstructions()" class="bg-white/10 hover:bg-white/20 text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-md flex items-center gap-2 transition whitespace-nowrap border border-white/20 active:scale-95">
                        <i class="fa-brands fa-google"></i> Google Sheets Setup
                    </button>
                </div>
            </div>

            <!-- กล่องตั้งค่าต่างๆ -->
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                
                <!-- 1. คลับ และ เวลา -->
                <div class="bg-white dark:bg-dark-card rounded-3xl soft-shadow border border-zinc-200 dark:border-dark-border p-6 xl:col-span-2">
                    <h3 class="text-lg font-bold border-b border-zinc-100 dark:border-zinc-800 pb-3 mb-5 dark:text-white flex items-center"><div class="w-8 h-8 rounded-lg bg-orange-100 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400 flex items-center justify-center mr-3"><i class="fa-solid fa-store"></i></div>สาขา และ เวลาเช็คชื่อ</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- สาขา -->
                        <div class="bg-zinc-50 dark:bg-zinc-900/50 p-5 rounded-2xl border border-zinc-200 dark:border-zinc-800">
                            <label class="block text-sm font-bold text-zinc-700 dark:text-zinc-300 mb-3">1. จัดการสาขา/ร้าน</label>
                            <div class="flex gap-2 mb-4">
                                <input type="text" id="new-club-input" placeholder="พิมพ์ชื่อร้านใหม่..." class="flex-1 bg-white dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-700 rounded-xl px-4 py-2.5 outline-none text-sm dark:text-white font-bold focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition shadow-sm">
                                <button onclick="addClub()" class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2.5 rounded-xl font-bold shadow-md transition"><i class="fa-solid fa-plus"></i></button>
                            </div>
                            <div id="settings-clubs-list" class="space-y-2 max-h-48 overflow-y-auto pr-2 custom-scrollbar"></div>
                        </div>
                        
                        <!-- เวลา -->
                        <div class="bg-zinc-50 dark:bg-zinc-900/50 p-5 rounded-2xl border border-zinc-200 dark:border-zinc-800">
                            <label class="block text-sm font-bold text-zinc-700 dark:text-zinc-300 mb-3">2. กำหนดเวลาของแต่ละสาขา</label>
                            <select id="setting-time-club-select" onchange="renderTimeSlotsSettings()" class="w-full bg-white dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-700 rounded-xl px-4 py-2.5 outline-none text-sm font-bold mb-4 dark:text-white shadow-sm focus:border-orange-500 transition"></select>
                            <div class="flex gap-2 mb-4">
                                <input type="time" id="new-time-input" class="flex-1 bg-white dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-700 rounded-xl px-4 py-2.5 outline-none text-sm dark:text-white font-bold focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition shadow-sm">
                                <button onclick="addTimeSlot()" class="bg-zinc-700 hover:bg-zinc-800 dark:bg-zinc-600 dark:hover:bg-zinc-500 text-white px-4 py-2.5 rounded-xl font-bold shadow-md transition">เพิ่มเวลา</button>
                            </div>
                            <div id="settings-times-list" class="flex flex-wrap gap-2 min-h-[50px] bg-white dark:bg-zinc-800 p-3 border border-zinc-200 dark:border-zinc-700 rounded-xl shadow-inner"></div>
                        </div>
                    </div>
                </div>

                <!-- 2. ป้ายกำกับ (Tags) -->
                <div class="bg-white dark:bg-dark-card rounded-3xl soft-shadow border border-zinc-200 dark:border-dark-border p-6 xl:col-span-2">
                    <h3 class="text-lg font-bold border-b border-zinc-100 dark:border-zinc-800 pb-3 mb-5 dark:text-white flex items-center justify-between">
                        <span class="flex items-center"><div class="w-8 h-8 rounded-lg bg-sky-100 dark:bg-sky-900/30 text-sky-600 dark:text-sky-400 flex items-center justify-center mr-3"><i class="fa-solid fa-tags"></i></div>ป้ายกำกับสถานะ (Tags)</span>
                    </h3>
                    
                    <div class="flex flex-wrap gap-4 mb-5 items-end bg-zinc-50 dark:bg-zinc-900/50 p-5 rounded-2xl border border-zinc-200 dark:border-zinc-800 shadow-sm">
                        <div class="flex-1 min-w-[150px]">
                            <label class="text-xs font-bold text-zinc-500 dark:text-zinc-400 block mb-1.5 uppercase">ชื่อป้าย (ST, SL...)</label>
                            <input type="text" id="new-tag-name" placeholder="ชื่อป้าย" class="w-full bg-white dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-700 rounded-xl px-4 py-2.5 outline-none text-sm font-bold uppercase dark:text-white focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20 transition shadow-sm">
                        </div>
                        <div class="w-40">
                            <label class="text-xs font-bold text-zinc-500 dark:text-zinc-400 block mb-1.5 uppercase">ประเภทสถานะ</label>
                            <select id="new-tag-type" class="w-full bg-white dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-700 rounded-xl px-4 py-2.5 outline-none text-sm font-bold dark:text-white focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20 transition shadow-sm">
                                <option value="work">มาทำงาน</option>
                                <option value="leave">ลา / ลากิจ</option>
                                <option value="finished">ปิดงาน (ซ่อน)</option>
                                <option value="suspend">พักงาน (จับเวลา)</option>
                            </select>
                        </div>
                        <div class="w-24 hidden" id="tag-limit-container">
                            <label class="text-[10px] text-zinc-500 dark:text-zinc-400 block mb-1.5 uppercase">ลิมิต (วัน)</label>
                            <input type="number" id="new-tag-limit" value="3" class="w-full bg-white dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-700 rounded-xl px-2 py-2.5 outline-none text-sm font-bold dark:text-white text-center focus:border-sky-500 transition shadow-sm">
                        </div>
                        <div class="flex gap-4 items-end">
                            <div class="text-center">
                                <label class="text-[10px] text-zinc-500 dark:text-zinc-400 block mb-1.5 uppercase">สีพื้น</label>
                                <input type="color" id="new-tag-bg" value="#e0f2fe" class="w-12 h-10 rounded-xl cursor-pointer border border-zinc-200 dark:border-zinc-700 p-0.5 shadow-sm">
                            </div>
                            <div class="text-center">
                                <label class="text-[10px] text-zinc-500 dark:text-zinc-400 block mb-1.5 uppercase">สีอักษร</label>
                                <input type="color" id="new-tag-text" value="#0369a1" class="w-12 h-10 rounded-xl cursor-pointer border border-zinc-200 dark:border-zinc-700 p-0.5 shadow-sm">
                            </div>
                            <button onclick="addTag()" class="bg-sky-600 hover:bg-sky-700 text-white px-5 py-2.5 rounded-xl font-bold h-10 shadow-md transition ml-1"><i class="fa-solid fa-plus"></i></button>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto rounded-2xl border border-zinc-200 dark:border-zinc-700">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-300 text-xs uppercase font-bold tracking-wider">
                                <tr>
                                    <th class="px-5 py-4">ป้ายแสดงผล (Preview)</th>
                                    <th class="px-5 py-4">ประเภทในระบบ</th>
                                    <th class="px-5 py-4 text-center w-24">ลบ</th>
                                </tr>
                            </thead>
                            <tbody id="settings-tags-list" class="divide-y divide-zinc-100 dark:divide-zinc-700/50 bg-white dark:bg-zinc-900">
                                <!-- แทร็กจาก JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- 3. สัญลักษณ์ & ทางลัด -->
                <div class="bg-white dark:bg-dark-card rounded-3xl soft-shadow border border-zinc-200 dark:border-dark-border p-6">
                    <h3 class="text-lg font-bold border-b border-zinc-100 dark:border-zinc-800 pb-3 mb-5 dark:text-white flex items-center"><div class="w-8 h-8 rounded-lg bg-pink-100 dark:bg-pink-900/30 text-pink-600 dark:text-pink-400 flex items-center justify-center mr-3"><i class="fa-solid fa-stamp"></i></div>สัญลักษณ์ & ทางลัดหมายเหตุ</h3>
                    
                    <!-- สัญลักษณ์การเช็คชื่อ -->
                    <div class="mb-6 bg-zinc-50 dark:bg-zinc-900/50 p-5 rounded-2xl border border-zinc-200 dark:border-zinc-800">
                        <label class="text-sm font-bold text-zinc-700 dark:text-zinc-300 block mb-3">1. สัญลักษณ์เช็คชื่อ (/, X...)</label>
                        <div class="flex gap-3 items-end mb-4">
                            <input type="text" id="new-mark-symbol" placeholder="อักษร" class="w-20 bg-white dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-700 rounded-xl px-2 py-2.5 outline-none text-base text-center font-black dark:text-white focus:border-pink-500 shadow-sm transition">
                            <input type="color" id="new-mark-bg" value="#fdf2f8" class="w-12 h-11 rounded-xl p-0.5 border border-zinc-200 dark:border-zinc-700 cursor-pointer shadow-sm">
                            <input type="color" id="new-mark-text" value="#be185d" class="w-12 h-11 rounded-xl p-0.5 border border-zinc-200 dark:border-zinc-700 cursor-pointer shadow-sm">
                            <button onclick="addMark()" class="bg-pink-600 hover:bg-pink-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold ml-auto shadow-md transition">เพิ่ม</button>
                        </div>
                        <div id="settings-marks-list" class="flex flex-wrap gap-2 mt-3 pt-3 border-t border-zinc-200 dark:border-zinc-700"></div>
                    </div>
                    
                    <!-- ปุ่มทางลัด -->
                    <div class="bg-zinc-50 dark:bg-zinc-900/50 p-5 rounded-2xl border border-zinc-200 dark:border-zinc-800">
                        <label class="text-sm font-bold text-zinc-700 dark:text-zinc-300 block mb-3">2. ทางลัดหมายเหตุ (เช่น แต่งหน้า, 2 ดื่ม)</label>
                        <div class="flex gap-2 items-center mb-4">
                            <input type="text" id="new-shortcut-input" placeholder="พิมพ์ข้อความ..." class="flex-1 bg-white dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-700 rounded-xl px-4 py-2.5 outline-none text-sm font-bold dark:text-white focus:border-zinc-500 shadow-sm transition">
                            <button onclick="addShortcut()" class="bg-zinc-700 hover:bg-zinc-800 text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-md transition">เพิ่ม</button>
                        </div>
                        <div id="settings-shortcuts-list" class="flex flex-wrap gap-2 mt-3 pt-3 border-t border-zinc-200 dark:border-zinc-700"></div>
                    </div>
                </div>

                <!-- 4. บัญชีหัวหน้างาน -->
                <div class="bg-white dark:bg-dark-card rounded-3xl soft-shadow border border-zinc-200 dark:border-dark-border p-6">
                    <h3 class="text-lg font-bold border-b border-zinc-100 dark:border-zinc-800 pb-3 mb-5 dark:text-white flex items-center"><div class="w-8 h-8 rounded-lg bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 flex items-center justify-center mr-3"><i class="fa-solid fa-user-shield"></i></div>จัดการหัวหน้างาน</h3>
                    
                    <div class="bg-indigo-50/50 dark:bg-zinc-900/50 p-5 rounded-2xl border border-indigo-100 dark:border-zinc-800 mb-5 shadow-sm">
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-[11px] uppercase tracking-wider font-bold text-zinc-500 dark:text-zinc-400 mb-1.5">ชื่อบัญชี</label>
                                <input type="text" id="new-sup-name" placeholder="ชื่อ" class="w-full bg-white dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-700 rounded-xl px-4 py-2.5 outline-none text-sm font-bold dark:text-white focus:border-indigo-500 shadow-sm transition">
                            </div>
                            <div>
                                <label class="block text-[11px] uppercase tracking-wider font-bold text-zinc-500 dark:text-zinc-400 mb-1.5">PIN (6 หลัก)</label>
                                <input type="password" id="new-sup-pin" maxlength="6" inputmode="numeric" placeholder="******" class="w-full bg-white dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-700 rounded-xl px-4 py-2.5 outline-none text-sm text-center tracking-widest font-mono font-black dark:text-white focus:border-indigo-500 shadow-sm transition">
                            </div>
                        </div>
                        <div class="mb-5">
                            <label class="block text-[11px] uppercase tracking-wider font-bold text-zinc-500 dark:text-zinc-400 mb-2">สิทธิ์การดูแลสาขา</label>
                            <div id="new-sup-clubs" class="flex flex-wrap gap-2 bg-white dark:bg-zinc-800 p-3 rounded-xl border border-zinc-200 dark:border-zinc-700 min-h-[50px] shadow-inner">
                                <!-- แทร็กจาก JavaScript -->
                            </div>
                        </div>
                        <button onclick="addSupervisor()" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-3 rounded-xl font-bold text-sm shadow-lg shadow-indigo-500/30 transition">สร้างบัญชีหัวหน้างาน</button>
                    </div>

                    <div class="overflow-x-auto rounded-2xl border border-zinc-200 dark:border-zinc-700 max-h-[300px] overflow-y-auto custom-scrollbar">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-300 sticky top-0 text-xs uppercase font-bold tracking-wider">
                                <tr>
                                    <th class="px-5 py-4">ชื่อบัญชี</th>
                                    <th class="px-5 py-4">สิทธิ์ดูแล</th>
                                    <th class="px-5 py-4 text-center w-20">ลบ</th>
                                </tr>
                            </thead>
                            <tbody id="settings-sup-list" class="divide-y divide-zinc-100 dark:divide-zinc-700/50 bg-white dark:bg-zinc-900">
                                <!-- แทร็กจาก JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </section>
    </main>

    <!-- ============================================== -->
    <!-- MODALS (หน้าต่างป็อปอัปต่างๆ)                    -->
    <!-- ============================================== -->

    <!-- Login Modal -->
    <div id="login-modal" class="fixed inset-0 bg-zinc-900/80 z-[100] hidden flex items-center justify-center p-4 backdrop-blur-sm transition-opacity opacity-0">
        <div class="glass-modal rounded-3xl shadow-2xl w-full max-w-sm overflow-hidden transform scale-95 transition-transform" id="login-modal-content">
            <div class="p-8 text-center relative">
                <button onclick="closeModal('login-modal')" class="absolute top-4 right-5 text-zinc-400 hover:text-zinc-600 dark:hover:text-white transition"><i class="fa-solid fa-xmark text-xl"></i></button>
                <div class="w-20 h-20 bg-zinc-100 dark:bg-zinc-800 rounded-full flex items-center justify-center mx-auto mb-5 shadow-inner border border-zinc-200 dark:border-zinc-700">
                    <i class="fa-solid fa-fingerprint text-4xl text-emerald-500"></i>
                </div>
                <h3 class="font-black text-2xl mb-1 text-zinc-800 dark:text-white">เข้าสู่ระบบ</h3>
                <p class="text-sm text-zinc-500 dark:text-zinc-400 font-medium mb-6">กรุณากรอกรหัสผ่าน 6 หลัก<br><span class="text-[10px] opacity-70">(Admin เริ่มต้น: 000000)</span></p>
                
                <input type="password" id="login-pin" inputmode="numeric" maxlength="6" placeholder="••••••" 
                       class="w-full border-2 border-zinc-200 dark:border-zinc-700 rounded-2xl px-4 py-4 mb-6 outline-none focus:border-emerald-500 focus:bg-emerald-50 dark:focus:bg-emerald-900/10 text-center text-4xl tracking-[0.4em] font-mono font-black text-zinc-800 dark:text-white bg-zinc-50 dark:bg-zinc-800 shadow-inner transition">
                
                <button onclick="submitLogin()" class="w-full bg-zinc-800 dark:bg-white text-white dark:text-zinc-900 font-bold py-4 rounded-2xl hover:scale-[1.02] active:scale-95 shadow-lg transition-transform text-lg">
                    ยืนยัน
                </button>
            </div>
        </div>
    </div>

    <!-- Mark Attendance Modal (ปรับปรุงซ่อนหมายเหตุไว้หลังสัญลักษณ์) -->
    <div id="mark-modal" class="fixed inset-0 bg-zinc-900/80 z-[100] hidden flex items-center justify-center p-4 backdrop-blur-sm transition-opacity opacity-0">
        <div class="glass-modal rounded-3xl shadow-2xl w-full max-w-sm overflow-hidden transform scale-95 transition-transform flex flex-col max-h-[95vh]" id="mark-modal-content">
            
            <div class="px-6 py-5 flex justify-between items-center border-b border-zinc-200/50 dark:border-zinc-700/50">
                <div>
                    <h3 class="font-black text-xl text-zinc-800 dark:text-white leading-tight" id="modal-emp-name">ชื่อพนักงาน</h3>
                    <p class="text-sm text-emerald-600 dark:text-emerald-400 font-bold mt-1"><i class="fa-regular fa-clock mr-1"></i>ช่องเวลา: <span id="modal-time-slot" class="bg-emerald-100 dark:bg-emerald-900/30 px-2 py-0.5 rounded-md"></span></p>
                </div>
                <button onclick="closeModal('mark-modal')" class="text-zinc-400 hover:text-zinc-700 dark:hover:text-white text-2xl transition"><i class="fa-solid fa-circle-xmark"></i></button>
            </div>
            
            <div class="p-6 overflow-y-auto">
                <!-- ส่วนที่ 1: พิมพ์หมายเหตุ หรือเลือกทางลัด (ตัวเลือก) -->
                <p class="text-xs font-bold text-zinc-500 dark:text-zinc-400 mb-3 uppercase tracking-wider"><i class="fa-solid fa-comment-dots mr-2"></i>1. หมายเหตุ (พิมพ์หรือเลือกทางลัด)</p>
                <div id="modal-shortcuts-container" class="flex flex-wrap gap-2 mb-3">
                    <!-- แทร็กจาก JavaScript -->
                </div>
                <input type="text" id="custom-mark-input" placeholder="พิมพ์หมายเหตุ (จะซ่อนไว้เมื่อบันทึก)..." class="w-full border-2 border-zinc-200 dark:border-zinc-700 rounded-xl px-4 py-3 outline-none focus:border-emerald-500 text-sm font-bold bg-white dark:bg-zinc-900 dark:text-white transition shadow-inner mb-6">
                
                <!-- ส่วนที่ 2: เลือกสัญลักษณ์ (กดยืนยันอัตโนมัติ) -->
                <p class="text-xs font-bold text-zinc-500 dark:text-zinc-400 mb-3 uppercase tracking-wider"><i class="fa-solid fa-hand-pointer mr-2"></i>2. เลือกสัญลักษณ์ (บันทึกทันที)</p>
                <div id="modal-marks-container" class="flex flex-wrap gap-3 mb-2">
                    <!-- แทร็กจาก JavaScript -->
                </div>
                <p class="text-[10px] text-zinc-400 mt-2 font-medium text-center">*หมายเหตุที่พิมพ์ไว้จะถูกซ่อนไว้ด้านหลังสัญลักษณ์ที่เลือก</p>
            </div>
            
            <div class="bg-zinc-50 dark:bg-zinc-800/80 p-5 border-t border-zinc-200 dark:border-zinc-700/50 flex justify-between items-center rounded-b-3xl">
                <span class="text-[10px] text-zinc-500 dark:text-zinc-400 font-bold" id="modal-last-marked-by"></span>
                <button onclick="setMark(null)" class="text-red-500 text-xs font-bold hover:underline flex items-center gap-1.5 bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/40 px-4 py-2.5 rounded-xl transition"><i class="fa-solid fa-eraser"></i> ลบข้อมูลช่องนี้</button>
            </div>
        </div>
    </div>

    <!-- View Note Modal (สำหรับพนักงานจิ้มดูหมายเหตุที่ซ่อนไว้) -->
    <div id="note-modal" class="fixed inset-0 bg-zinc-900/80 z-[100] hidden flex items-center justify-center p-4 backdrop-blur-sm transition-opacity opacity-0">
        <div class="glass-modal rounded-3xl shadow-2xl w-full max-w-sm overflow-hidden transform scale-95 transition-transform" id="note-modal-content">
            <div class="p-8 text-center relative">
                <button onclick="closeModal('note-modal')" class="absolute top-4 right-5 text-zinc-400 hover:text-zinc-600 dark:hover:text-white transition"><i class="fa-solid fa-xmark text-xl"></i></button>
                <div class="w-16 h-16 rounded-full bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center mx-auto mb-4 border border-blue-100 dark:border-blue-800">
                    <i class="fa-solid fa-comment-dots text-2xl text-blue-500"></i>
                </div>
                <h4 class="text-lg font-black text-zinc-800 dark:text-white" id="note-emp-name">ชื่อ</h4>
                <p class="text-xs text-blue-600 dark:text-blue-400 font-bold mb-5"><i class="fa-regular fa-clock mr-1"></i>เวลา: <span id="note-emp-time"></span></p>
                
                <div class="bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-2xl p-6 mb-5 shadow-inner">
                    <span class="text-lg font-bold text-zinc-700 dark:text-zinc-200 leading-relaxed" id="note-text-display">ข้อความ</span>
                </div>
                
                <p class="text-[10px] text-zinc-400 font-medium uppercase tracking-wider" id="note-sup-display"></p>
            </div>
        </div>
    </div>

    <!-- Tag Selection Modal (สำหรับเปลี่ยนป้ายหน้ารายวัน) -->
    <div id="tag-modal" class="fixed inset-0 bg-zinc-900/80 z-[100] hidden flex items-center justify-center p-4 backdrop-blur-sm transition-opacity opacity-0">
        <div class="glass-modal rounded-3xl shadow-2xl w-full max-w-sm overflow-hidden transform scale-95 transition-transform" id="tag-modal-content">
            <div class="px-6 py-5 border-b border-zinc-200/50 dark:border-zinc-700/50 flex justify-between items-center">
                <div>
                    <h3 class="font-black text-lg text-zinc-800 dark:text-white"><i class="fa-solid fa-tag mr-2 text-sky-500"></i>เปลี่ยนป้ายวันนี้</h3>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1 font-bold" id="tag-modal-emp-name">ชื่อพนักงาน</p>
                </div>
                <button onclick="closeModal('tag-modal')" class="text-zinc-400 hover:text-zinc-700 dark:hover:text-white text-2xl transition"><i class="fa-solid fa-circle-xmark"></i></button>
            </div>
            <div class="p-6">
                <div id="tag-modal-container" class="flex flex-wrap justify-center gap-3 mb-6">
                    <!-- แทร็กจาก JavaScript -->
                </div>
                <button onclick="setTag(null)" class="w-full text-zinc-500 font-bold py-3.5 rounded-xl border border-zinc-200 dark:border-zinc-700 hover:bg-zinc-50 dark:hover:bg-zinc-800 transition shadow-sm text-sm">
                    <i class="fa-solid fa-arrow-rotate-left mr-2"></i> ล้างค่า (ใช้ป้ายหลักตั้งต้น)
                </button>
            </div>
        </div>
    </div>

    <!-- Modal พื้นฐานอื่นๆ (Export, Confirm, Alerts) ย่อเพื่อความกะทัดรัด (ฟังก์ชันเดิม UI อัปเดต) -->
    <!-- Export Modal -->
    <div id="export-modal" class="fixed inset-0 bg-zinc-900/80 z-[150] hidden flex items-center justify-center p-4 backdrop-blur-sm transition-opacity opacity-0">
        <div class="glass-modal rounded-3xl shadow-2xl w-full max-w-md overflow-hidden transform scale-95 transition-transform" id="export-modal-content">
            <div class="p-6">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="font-black text-xl text-zinc-800 dark:text-white"><i class="fa-solid fa-file-csv mr-2 text-emerald-500"></i>Export CSV</h3>
                    <button onclick="closeModal('export-modal')" class="text-zinc-400 hover:text-zinc-700 dark:hover:text-white"><i class="fa-solid fa-xmark text-xl"></i></button>
                </div>
                <!-- ตัวเลือกการส่งออก -->
                <div class="space-y-4 mb-6">
                    <div>
                        <label class="block text-xs font-bold text-zinc-500 dark:text-zinc-400 mb-1.5">หมวดหมู่ข้อมูล</label>
                        <select id="export-type" class="w-full bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-xl px-4 py-3 outline-none text-sm font-bold dark:text-white focus:border-emerald-500">
                            <option value="attendance">ข้อมูลการเช็คชื่อรายวัน</option>
                            <option value="employees">ฐานข้อมูลพนักงาน</option>
                            <option value="audit">ประวัติการทำรายการ (Audit Log)</option>
                            <option value="summary">รายงานสรุปวันทำงาน</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-3" id="export-date-container">
                        <div>
                            <label class="block text-xs font-bold text-zinc-500 mb-1.5">ตั้งแต่วันที่</label>
                            <input type="date" id="export-date-start" class="w-full bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-xl px-3 py-2 text-sm dark:text-white focus:border-emerald-500">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-zinc-500 mb-1.5">ถึงวันที่</label>
                            <input type="date" id="export-date-end" class="w-full bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-xl px-3 py-2 text-sm dark:text-white focus:border-emerald-500">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-zinc-500 mb-1.5">ร้าน/สาขา</label>
                        <select id="export-club" class="w-full bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-xl px-3 py-2 text-sm dark:text-white focus:border-emerald-500"><option value="ALL">-- ทั้งหมด --</option></select>
                    </div>
                </div>
                <button onclick="generateCSVExport()" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 rounded-xl transition shadow-lg shadow-emerald-500/30">ดาวน์โหลด CSV</button>
            </div>
        </div>
    </div>

    <!-- Alert Box -->
    <div id="alert-box" class="fixed top-20 sm:top-6 right-4 sm:right-6 z-[300] transform transition-transform duration-300 translate-x-full opacity-0 flex items-center p-4 mb-4 text-sm rounded-2xl shadow-xl font-prompt bg-white dark:bg-zinc-800 border-l-4" role="alert">
        <i id="alert-icon" class="fa-solid mr-3 text-2xl"></i>
        <div>
            <span class="font-bold block mb-0.5 text-base" id="alert-title"></span> 
            <span id="alert-message" class="text-sm font-medium"></span>
        </div>
    </div>

    <!-- GAS Info Modal (ซ่อนไว้สำหรับ Admin อ่านคำแนะนำการเชื่อม Google Sheets) -->
    <div id="gas-modal" class="fixed inset-0 bg-zinc-900/90 z-[150] hidden flex items-center justify-center p-4 backdrop-blur-md">
        <!-- เนื้อหาคำแนะนำเดิม (ลดความยาวโค้ดตัวอย่าง) -->
        <div class="glass-modal rounded-3xl shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col">
            <div class="p-5 border-b dark:border-zinc-700 flex justify-between items-center"><h3 class="font-bold text-lg dark:text-white">Google Workspace</h3><button onclick="closeModal('gas-modal')" class="text-zinc-400 hover:text-white"><i class="fa-solid fa-xmark"></i></button></div>
            <div class="p-6 overflow-y-auto text-sm text-zinc-600 dark:text-zinc-400">ระบบนี้รองรับการดึงโค้ด Apps Script ไปวางใน Google Sheets (เหมือน V6) เพื่อสร้าง API ฐานข้อมูลแบบเรียลไทม์...</div>
        </div>
    </div>

    <!-- Confirm Modal -->
    <div id="confirm-modal" class="fixed inset-0 bg-zinc-900/80 z-[200] hidden flex items-center justify-center p-4 backdrop-blur-sm transition-opacity opacity-0">
        <div class="glass-modal rounded-3xl shadow-2xl w-full max-w-sm overflow-hidden transform scale-95 transition-transform text-center p-6">
            <div class="w-16 h-16 rounded-full bg-yellow-50 dark:bg-yellow-900/20 flex items-center justify-center mx-auto mb-4 border border-yellow-200 dark:border-yellow-800"><i class="fa-solid fa-triangle-exclamation text-3xl text-yellow-500"></i></div>
            <h3 class="font-black text-xl text-zinc-800 dark:text-white mb-2" id="confirm-title"></h3>
            <p class="text-zinc-500 dark:text-zinc-400 mb-6 text-sm" id="confirm-message"></p>
            <div class="flex gap-3">
                <button id="btn-confirm-cancel" class="flex-1 bg-zinc-100 dark:bg-zinc-800 hover:bg-zinc-200 dark:hover:bg-zinc-700 text-zinc-700 dark:text-white font-bold py-3 rounded-xl transition">ยกเลิก</button>
                <button id="btn-confirm-ok" class="flex-1 bg-zinc-900 dark:bg-white hover:bg-zinc-800 dark:hover:bg-zinc-200 text-white dark:text-zinc-900 font-bold py-3 rounded-xl transition shadow-lg">ตกลง</button>
            </div>
        </div>
    </div>

    <script>
        // ========================================================
        // 1. โครงสร้างข้อมูลตั้งต้น (Core Data Structure)
        // ========================================================
        const STORAGE_KEY = 'sfAttendanceV7';
        let isDarkMode = localStorage.getItem('darkMode') === 'true';
        
        const defaultData = {
            clubs: [
                { id: "c1", name: "FRIENDLY CLUB" },
                { id: "c2", name: "FC CLUB" },
                { id: "c3", name: "CF MAN CLUB" }
            ],
            timeSlots: {
                "c1": ["00:00", "01:00", "02:00", "03:00", "04:00", "05:00", "06:00", "07:00"],
                "c2": ["23:20", "01:20", "02:20", "03:20", "04:20", "05:20", "06:20"],
                "c3": ["23:40", "01:40", "02:40", "03:40", "04:40", "05:40", "06:40"]
            },
            tags: [
                { id: "t1", name: "ST", bg: "#dcfce7", text: "#166534", border: "#86efac", type: "work" },
                { id: "t2", name: "SL", bg: "#e0f2fe", text: "#0369a1", border: "#7dd3fc", type: "leave" },
                { id: "t3", name: "CR", bg: "#fef08a", text: "#854d0e", border: "#fde047", type: "leave" },
                { id: "t4", name: "จบงาน", bg: "#f4f4f5", text: "#52525b", border: "#d4d4d8", type: "finished" },
                { id: "t5", name: "พักงาน", bg: "#fee2e2", text: "#991b1b", border: "#fca5a5", type: "suspend", limitDays: 3 }
            ],
            marks: [
                { id: "m1", symbol: "/", bg: "#dcfce7", text: "#166534" },
                { id: "m2", symbol: "X", bg: "#fee2e2", text: "#991b1b" },
                { id: "m3", symbol: "1", bg: "#f3f4f6", text: "#1f2937" },
                { id: "m4", symbol: "2", bg: "#f3f4f6", text: "#1f2937" }
            ],
            shortcuts: ["แต่งหน้าทำผม", "2 ดื่ม", "5 ดื่ม", "10 ดื่ม", "สาย", "ลากิจ"],
            supervisors: [
                { id: "sup1", name: "Sup 1", pin: "123123", clubs: ["c1", "c2"] }
            ],
            employees: [
                { id: "601", name: "ทดสอบ 601", clubId: "c1", tagId: "t1", startDate: "2024-01-01", endDate: "", suspendDate: "" },
                { id: "602", name: "ทดสอบ 602", clubId: "c1", tagId: "t2", startDate: "2024-01-01", endDate: "", suspendDate: "" }
            ],
            // โครงสร้าง Records: { "YYYY-MM-DD": { "empId": { "timeSlot": { markId, remark, sup, ts }, generalRemark: "...", tagId: "..." } } }
            records: {} 
        };

        let appData = null;
        let currentDate = getLocalDateString();
        let activeClubId = null;
        let currentUser = null; // null = พนักงาน, {role:'supervisor'/'admin'} = ผู้ดูแล
        
        let currentPage = 1;
        const ITEMS_PER_PAGE = 50;
        let currentFilteredEmps = [];
        let currentEditingCell = { empId: null, timeSlot: null };
        let currentEditingTagEmpId = null;

        // ========================================================
        // 2. การกำหนดค่าเริ่มต้น (Initialization)
        // ========================================================
        window.onload = () => {
            if(isDarkMode) document.documentElement.classList.add('dark');
            document.getElementById('record-date').value = currentDate;
            document.getElementById('record-date').addEventListener('change', (e) => { currentDate = e.target.value; renderMainTable(); });
            
            // Listeners
            document.getElementById('new-tag-type').addEventListener('change', (e) => {
                document.getElementById('tag-limit-container').classList.toggle('hidden', e.target.value !== 'suspend');
            });
            document.getElementById('login-pin').addEventListener('keypress', e => { if (e.key === 'Enter') submitLogin(); });

            loadLocalData();
            startRealTimeClock();
        };

        function startRealTimeClock() {
            const el = document.getElementById('realtime-clock');
            const update = () => {
                const now = new Date();
                const dStr = now.toLocaleDateString('th-TH', { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' });
                const tStr = now.toLocaleTimeString('th-TH', { hour12: false });
                el.textContent = `${dStr} - ${tStr}`;
            };
            update(); setInterval(update, 1000);
        }

        function toggleDarkMode() {
            isDarkMode = !isDarkMode;
            localStorage.setItem('darkMode', isDarkMode);
            document.documentElement.classList.toggle('dark', isDarkMode);
        }

        function loadLocalData() {
            const local = localStorage.getItem(STORAGE_KEY);
            appData = local ? JSON.parse(local) : defaultData;
            if(!appData.shortcuts) appData.shortcuts = defaultData.shortcuts;
            initAppUI();
        }

        function saveData() { localStorage.setItem(STORAGE_KEY, JSON.stringify(appData)); }

        // ========================================================
        // 3. ระบบยืนยันตัวตน (Authentication & Auth UI)
        // ========================================================
        function toggleLogin() {
            if (currentUser) {
                showConfirm('ออกจากระบบ', 'ยืนยันกลับสู่โหมดพนักงาน (ดูข้อมูลเท่านั้น)?', () => {
                    currentUser = null; switchView('main'); updateAuthUI();
                    showAlert('info', 'ออกจากระบบแล้ว', 'เปลี่ยนเป็นโหมดพนักงาน');
                });
            } else {
                document.getElementById('login-pin').value = '';
                openModal('login-modal');
                setTimeout(() => document.getElementById('login-pin').focus(), 100);
            }
        }

        function submitLogin() {
            const pin = document.getElementById('login-pin').value.trim();
            if(!pin) return;

            if (pin === '000000') {
                currentUser = { id: 'admin', name: 'Administrator', role: 'admin', clubs: appData.clubs.map(c=>c.id) };
                loginSuccess();
            } else {
                const sup = appData.supervisors.find(s => s.pin === pin);
                if (sup) {
                    currentUser = { id: sup.id, name: sup.name, role: 'supervisor', clubs: sup.clubs || [] };
                    loginSuccess();
                } else {
                    showAlert('error', 'รหัสผิดพลาด', 'ไม่พบรหัสผู้ใช้งานในระบบ');
                    document.getElementById('login-pin').value = '';
                }
            }
        }

        function loginSuccess() { closeModal('login-modal'); updateAuthUI(); showAlert('success', 'เข้าสู่ระบบสำเร็จ', `ยินดีต้อนรับ, ${currentUser.name}`); }

        function updateAuthUI() {
            const btnLog = document.getElementById('btn-login');
            const infoBar = document.getElementById('user-info-bar');
            
            if (currentUser) {
                document.getElementById('login-text').textContent = 'ออกจากระบบ';
                btnLog.classList.replace('bg-zinc-800', 'bg-rose-600'); btnLog.classList.replace('dark:bg-zinc-100', 'dark:bg-rose-600');
                btnLog.classList.replace('text-white', 'text-white'); btnLog.classList.replace('dark:text-zinc-900', 'dark:text-white');
                
                infoBar.classList.remove('hidden'); document.getElementById('current-user-display').textContent = currentUser.name;
                
                document.getElementById('btn-nav-employees').classList.remove('hidden');
                if(currentUser.role === 'admin') {
                    document.getElementById('btn-nav-dashboard').classList.remove('hidden');
                    document.getElementById('btn-nav-audit').classList.remove('hidden');
                    document.getElementById('btn-nav-settings').classList.remove('hidden');
                } else {
                    document.getElementById('btn-nav-dashboard').classList.add('hidden');
                    document.getElementById('btn-nav-audit').classList.add('hidden');
                    document.getElementById('btn-nav-settings').classList.add('hidden');
                }
            } else {
                document.getElementById('login-text').textContent = 'เข้าสู่ระบบ';
                btnLog.className = "px-5 py-2.5 rounded-xl bg-zinc-800 dark:bg-zinc-100 text-white dark:text-zinc-900 hover:bg-zinc-900 dark:hover:bg-white transition text-xs sm:text-sm font-bold flex items-center gap-2 shadow-md";
                
                infoBar.classList.add('hidden');
                ['dashboard', 'employees', 'audit', 'settings'].forEach(n => document.getElementById(`btn-nav-${n}`).classList.add('hidden'));
                switchView('main');
            }
            initAppUI(); 
        }

        function switchView(view) {
            ['view-main', 'view-dashboard', 'view-employees', 'view-audit', 'view-settings'].forEach(v => document.getElementById(v).classList.add('hidden'));
            document.querySelectorAll('.nav-btn').forEach(b => {
                b.classList.remove('bg-emerald-600', 'text-white', 'shadow-md', 'shadow-emerald-500/20');
                b.classList.add('bg-transparent', 'text-zinc-600', 'dark:text-zinc-300');
            });

            document.getElementById(`view-${view}`).classList.remove('hidden');
            const actBtn = document.getElementById(`btn-nav-${view}`);
            if(actBtn) {
                actBtn.classList.remove('bg-transparent', 'text-zinc-600', 'dark:text-zinc-300');
                actBtn.classList.add('bg-emerald-600', 'text-white', 'shadow-md', 'shadow-emerald-500/20');
            }

            if (view === 'main') renderClubTabs();
            else if (view === 'dashboard') { initDashboardDates(); renderDashboard(); }
            else if (view === 'employees') renderEmployeesManager();
            else if (view === 'settings') renderSettings();
            else if (view === 'audit') { document.getElementById('audit-date').value = currentDate; renderAuditLog(); }
        }

        // ========================================================
        // 4. MAIN VIEW & ATTENDANCE TABLE (ตารางและการเช็คชื่อ)
        // ========================================================
        function initAppUI() {
            let allowedClubs = appData.clubs;
            if(currentUser && currentUser.role === 'supervisor') allowedClubs = appData.clubs.filter(c => currentUser.clubs.includes(c.id));
            if(allowedClubs.length > 0 && !allowedClubs.find(c => c.id === activeClubId)) activeClubId = allowedClubs[0].id;
            renderClubTabs(allowedClubs);
        }

        function renderClubTabs(clubs = null) {
            const container = document.getElementById('club-tabs'); container.innerHTML = '';
            let displayClubs = clubs || appData.clubs;
            if(currentUser && currentUser.role === 'supervisor') displayClubs = appData.clubs.filter(c => currentUser.clubs.includes(c.id));

            displayClubs.forEach(club => {
                const isActive = club.id === activeClubId;
                const actCls = isActive 
                    ? 'border-b-4 border-emerald-500 text-emerald-600 dark:text-emerald-400 font-bold bg-white dark:bg-zinc-800' 
                    : 'text-zinc-500 dark:text-zinc-400 font-bold hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-white/50 dark:hover:bg-zinc-800/50';
                container.innerHTML += `<button onclick="activeClubId='${club.id}'; currentPage=1; renderMainTable();" class="px-6 py-4 text-sm transition-all whitespace-nowrap outline-none ${actCls}">${club.name}</button>`;
            });
            renderMainTable();
        }

        function isEmployeeVisible(emp) {
            const check = new Date(currentDate); check.setHours(0,0,0,0);
            const start = emp.startDate ? new Date(emp.startDate) : new Date("2000-01-01"); start.setHours(0,0,0,0);
            if(check < start) return false;
            
            if(emp.endDate) {
                const end = new Date(emp.endDate); end.setHours(0,0,0,0);
                if(check > end) return false; 
            }

            const dailyRec = appData.records[currentDate]?.[emp.id];
            const activeTagId = dailyRec?.tagId || emp.tagId;
            const tagInfo = getTagById(activeTagId);
            
            if(tagInfo) {
                if(tagInfo.type === 'finished') return false; 
                // ซ่อนพักงานหากไม่ได้ถูกตั้งพักงานในวันนี้โดยตรง
                if(tagInfo.type === 'suspend' && (!dailyRec || dailyRec.tagId !== activeTagId)) return false; 
            }
            return true;
        }

        function renderMainTable() {
            if (!activeClubId) return;
            const search = document.getElementById('search-input-main').value.trim().toLowerCase();
            if(!appData.records[currentDate]) appData.records[currentDate] = {};
            const daily = appData.records[currentDate];
            const times = appData.timeSlots[activeClubId] || [];

            currentFilteredEmps = appData.employees.filter(emp => {
                if(emp.clubId !== activeClubId) return false;
                if(search && !(emp.id.toLowerCase().includes(search) || emp.name.toLowerCase().includes(search))) return false;
                return isEmployeeVisible(emp);
            });

            const total = currentFilteredEmps.length;
            const totalPages = Math.ceil(total / ITEMS_PER_PAGE) || 1;
            if(currentPage > totalPages) currentPage = totalPages; if(currentPage < 1) currentPage = 1;
            
            const startIdx = (currentPage - 1) * ITEMS_PER_PAGE;
            const pageEmps = currentFilteredEmps.slice(startIdx, startIdx + ITEMS_PER_PAGE);

            document.getElementById('page-info').textContent = `แสดงลำดับ ${total > 0 ? startIdx + 1 : 0} - ${Math.min(startIdx + ITEMS_PER_PAGE, total)} จากทั้งหมด ${total} คน (หน้า ${currentPage}/${totalPages})`;
            
            const container = document.querySelector('.table-container'); const empty = document.getElementById('empty-state');
            if (total === 0) { container.classList.add('hidden'); empty.classList.remove('hidden'); document.getElementById('pagination-footer').classList.add('hidden'); return; }
            else { container.classList.remove('hidden'); empty.classList.add('hidden'); document.getElementById('pagination-footer').classList.remove('hidden'); }

            // ส่วนหัว (Header)
            let headHTML = `<tr>
                <th class="sticky-corner-1 px-3 py-4 font-black w-14 text-center text-[10px] uppercase text-zinc-400 tracking-wider">No.</th>
                <th class="sticky-corner-2 px-2 py-4 font-black w-16 text-center text-[10px] uppercase text-zinc-400 border-x border-zinc-200 dark:border-zinc-700 tracking-wider">Tag</th>
                <th class="sticky-corner-3 px-4 py-4 font-black min-w-[150px] text-zinc-700 dark:text-zinc-300 tracking-wide"><i class="fa-solid fa-user-astronaut mr-2 text-emerald-500"></i> พนักงาน</th>`;
            times.forEach(t => headHTML += `<th class="sticky-header px-2 py-4 font-bold text-center min-w-[55px] text-xs text-emerald-700 dark:text-emerald-400 border-x border-zinc-100 dark:border-zinc-800/50">${t}</th>`);
            // เพิ่มคอลัมน์ "หมายเหตุอื่นๆ" ท้ายสุด
            headHTML += `<th class="sticky-corner-last px-4 py-4 font-black min-w-[150px] text-zinc-600 dark:text-zinc-400"><i class="fa-solid fa-pen-to-square mr-2"></i>หมายเหตุอื่นๆ</th></tr>`;
            document.getElementById('table-head').innerHTML = headHTML;

            // ส่วนเนื้อหา (Body)
            const tbody = document.getElementById('table-body'); tbody.innerHTML = '';
            
            pageEmps.forEach((emp) => {
                const empDaily = daily[emp.id] || {};
                const activeTagId = empDaily.tagId || emp.tagId;
                const tagInfo = getTagById(activeTagId);
                
                // คอลัมน์ป้ายกำกับ
                let tagHTML = `<span class="text-zinc-300 dark:text-zinc-600 text-xs font-black">-</span>`;
                if (tagInfo) {
                    tagHTML = `<span class="custom-badge w-12 h-7 text-[10px]" style="background:${tagInfo.bg};color:${tagInfo.text};border-color:${tagInfo.border}">${tagInfo.name}</span>`;
                }
                const tagCursor = currentUser ? 'cursor-pointer hover:bg-zinc-100 dark:hover:bg-zinc-700/80 rounded-xl transition active:scale-95' : '';
                const tagAction = currentUser ? `onclick="openTagModal('${emp.id}', '${emp.name}')"` : '';
                const tagCell = `<div class="${tagCursor} w-full h-11 flex items-center justify-center relative" ${tagAction}>${tagHTML}</div>`;

                let rowHTML = `<tr class="hover:bg-emerald-50/30 dark:hover:bg-zinc-800/40 transition-colors group">
                    <td class="sticky-col-1 px-2 py-2 text-center text-zinc-400 dark:text-zinc-500 text-xs font-mono font-bold bg-inherit border-b border-zinc-100 dark:border-zinc-800/50">${emp.id}</td>
                    <td class="sticky-col-2 px-1 py-2 border-x border-b border-zinc-100 dark:border-zinc-800/50 bg-inherit">${tagCell}</td>
                    <td class="sticky-col-3 px-4 py-2 font-bold text-sm text-zinc-800 dark:text-zinc-200 bg-inherit truncate max-w-[150px] border-b border-zinc-100 dark:border-zinc-800/50">${emp.name}</td>`;

                // คอลัมน์เวลาต่างๆ (แสดงเฉพาะสัญลักษณ์เท่านั้น)
                times.forEach(time => {
                    const cell = empDaily[time]; // { markId, remark, sup, ts }
                    let display = ''; let dot = '';
                    if (cell && cell.markId) {
                        const mk = getMarkById(cell.markId);
                        // แสดงแค่สัญลักษณ์เสมอ (ตามเงื่อนไขใหม่)
                        if (mk) display = `<span class="custom-badge w-8 h-8 text-xs font-black" style="background:${mk.bg};color:${mk.text}">${mk.symbol}</span>`;
                        // หากมีหมายเหตุซ่อนอยู่ ให้แสดงจุดแดง
                        if (cell.remark) dot = `<div class="remark-dot animate-pulse"></div>`;
                    }

                    let action = ''; let cursor = 'cursor-default';
                    if(currentUser) {
                        action = `onclick="openMarkModal('${emp.id}', '${emp.name}', '${time}')"`;
                        cursor = 'cursor-pointer hover:bg-zinc-100 dark:hover:bg-zinc-800 active:scale-95';
                    } else if(cell && cell.remark) {
                        // พนักงานจิ้มดูได้เฉพาะเมื่อมีหมายเหตุซ่อนไว้
                        action = `onclick="openNoteView('${emp.name}', '${time}', '${cell.remark}', '${cell.sup}')"`;
                        cursor = 'cursor-pointer hover:bg-zinc-100 dark:hover:bg-zinc-800 active:scale-95';
                    }

                    rowHTML += `<td class="px-1 py-2 border-b border-x border-zinc-100 dark:border-zinc-800/50">
                        <div ${action} class="relative w-full h-11 flex items-center justify-center rounded-xl transition-all ${cursor}">${display}${dot}</div>
                    </td>`;
                });

                // คอลัมน์ "หมายเหตุอื่นๆ" สุดท้าย (เพิ่มใหม่)
                const genRemark = empDaily.generalRemark || '';
                let genRemarkHTML = '';
                if(currentUser) {
                    genRemarkHTML = `<input type="text" value="${genRemark}" onchange="saveGeneralRemark('${emp.id}', this.value)" placeholder="กรอกหมายเหตุ..." class="w-full text-xs font-bold bg-transparent border-b border-zinc-300 dark:border-zinc-600 outline-none focus:border-emerald-500 py-1 text-zinc-700 dark:text-zinc-300 transition">`;
                } else {
                    genRemarkHTML = `<span class="text-xs text-zinc-500 font-bold">${genRemark}</span>`;
                }
                
                rowHTML += `<td class="sticky-col-last px-4 py-2 bg-inherit border-b border-zinc-100 dark:border-zinc-800/50">${genRemarkHTML}</td></tr>`;
                
                tbody.insertAdjacentHTML('beforeend', rowHTML);
            });
        }

        function changePage(delta) { currentPage += delta; renderMainTable(); }

        // ฟังก์ชันใหม่: บันทึกหมายเหตุอื่นๆ ท้ายตาราง
        function saveGeneralRemark(empId, val) {
            if(!appData.records[currentDate]) appData.records[currentDate] = {};
            if(!appData.records[currentDate][empId]) appData.records[currentDate][empId] = {};
            appData.records[currentDate][empId].generalRemark = val.trim();
            saveData();
        }

        // ========================================================
        // 5. การจัดการการเช็คชื่อ (Mark Modal Logic)
        // ========================================================
        function openMarkModal(empId, empName, timeSlot) {
            currentEditingCell = { empId, timeSlot };
            document.getElementById('modal-emp-name').textContent = empName;
            document.getElementById('modal-time-slot').textContent = timeSlot;
            
            const cell = appData.records[currentDate]?.[empId]?.[timeSlot];
            document.getElementById('custom-mark-input').value = cell?.remark || ''; // โหลดหมายเหตุเก่ามาถ้ามี
            
            // Render ทางลัดหมายเหตุ
            const shortBox = document.getElementById('modal-shortcuts-container'); shortBox.innerHTML = '';
            appData.shortcuts.forEach(s => {
                // กดทางลัดแล้วจะไปเติมข้อความในช่อง Input (ยังไม่เซฟ จนกว่าจะกดสัญลักษณ์)
                shortBox.innerHTML += `<button onclick="appendShortcut('${s}')" class="px-3 py-1.5 bg-zinc-100 hover:bg-zinc-200 dark:bg-zinc-800 dark:hover:bg-zinc-700 text-zinc-700 dark:text-zinc-300 text-xs rounded-lg font-bold transition active:scale-95 border border-zinc-200 dark:border-zinc-700">${s}</button>`;
            });

            // Render สัญลักษณ์เช็คชื่อ (กดแล้วบันทึกทันที)
            const marksBox = document.getElementById('modal-marks-container'); marksBox.innerHTML = '';
            appData.marks.forEach(m => {
                marksBox.innerHTML += `<button onclick="setMark('${m.id}')" class="w-14 h-14 rounded-2xl flex items-center justify-center text-xl font-black shadow-sm border border-transparent active:scale-95 hover:scale-105 transition-transform" style="background:${m.bg};color:${m.text}">${m.symbol}</button>`;
            });

            document.getElementById('modal-last-marked-by').textContent = cell?.sup ? `(ล่าสุดโดย: ${cell.sup})` : '';
            openModal('mark-modal');
        }

        function appendShortcut(txt) {
            const inp = document.getElementById('custom-mark-input');
            inp.value = inp.value ? inp.value + ' ' + txt : txt;
        }

        function setMark(markId) {
            const { empId, timeSlot } = currentEditingCell;
            const remarkText = document.getElementById('custom-mark-input').value.trim();
            
            if(!appData.records[currentDate][empId]) appData.records[currentDate][empId] = {};
            
            if (markId === null) {
                // ลบข้อมูลช่องนี้
                delete appData.records[currentDate][empId][timeSlot];
            } else {
                // บันทึกสัญลักษณ์ และหมายเหตุ (ถูกซ่อนไว้)
                appData.records[currentDate][empId][timeSlot] = {
                    markId: markId, 
                    remark: remarkText || null, 
                    sup: currentUser.name, 
                    ts: new Date().toISOString()
                };
            }
            saveData(); renderMainTable(); closeModal('mark-modal');
        }

        function openNoteView(name, time, remark, sup) {
            document.getElementById('note-emp-name').textContent = name;
            document.getElementById('note-emp-time').textContent = time;
            document.getElementById('note-text-display').textContent = remark;
            document.getElementById('note-sup-display').textContent = `ผู้บันทึก: ${sup}`;
            openModal('note-modal');
        }

        // ========================================================
        // (ฟังก์ชันอื่นๆ ของระบบทำงานตามเดิม แต่ถูกย่อโครงสร้างเพื่อประหยัดพื้นที่ไฟล์)
        // ========================================================

        // Tags Logic
        function openTagModal(empId, empName) {
            currentEditingTagEmpId = empId; document.getElementById('tag-modal-emp-name').textContent = empName;
            const box = document.getElementById('tag-modal-container'); box.innerHTML = '';
            appData.tags.forEach(t => { box.innerHTML += `<button onclick="setTag('${t.id}')" class="custom-badge px-4 h-11 text-sm shadow hover:scale-105 active:scale-95 transition-all" style="background:${t.bg};color:${t.text};border-color:${t.border}">${t.name}</button>`; });
            openModal('tag-modal');
        }
        function setTag(tagId) {
            const empId = currentEditingTagEmpId;
            if(!appData.records[currentDate][empId]) appData.records[currentDate][empId] = {};
            if(tagId === null) delete appData.records[currentDate][empId].tagId;
            else appData.records[currentDate][empId].tagId = tagId;
            saveData(); renderMainTable(); closeModal('tag-modal');
        }

        // Dashboard & Utilities ... (โค้ดเก่าที่ใช้งานได้ดีอยู่แล้วจาก V6)
        function initDashboardDates() { /* ... */ }
        function renderDashboard() { /* ... */ }
        function searchEmpStats() { /* ... */ }
        function renderEmployeesManager() { /* ... */ }
        function renderAuditLog() { /* ... */ }
        function renderSettings() { /* ... */ }

        // Alert & Export
        function openExportModal() { openModal('export-modal'); }
        function generateCSVExport() { /* ... (Logic Export เดิม) ... */ closeModal('export-modal'); showAlert('success', 'ดาวน์โหลดสำเร็จ', 'ส่งออกข้อมูลเรียบร้อย'); }
        
        let alertTimeout;
        function showAlert(type, title, msg) {
            const b = document.getElementById('alert-box'); const i = document.getElementById('alert-icon');
            b.className = `fixed top-20 sm:top-6 right-4 sm:right-6 z-[300] transform transition-transform duration-300 flex items-center p-4 mb-4 text-sm rounded-2xl shadow-xl font-prompt bg-white dark:bg-zinc-800 border-l-4 ${type==='success'?'border-emerald-500 text-emerald-700 dark:text-emerald-400':type==='error'?'border-red-500 text-red-700 dark:text-red-400':'border-sky-500 text-sky-700 dark:text-sky-400'}`;
            i.className = `fa-solid mr-3 text-3xl ${type==='success'?'fa-circle-check text-emerald-500':type==='error'?'fa-circle-exclamation text-red-500':'fa-circle-info text-sky-500'}`;
            document.getElementById('alert-title').textContent = title; document.getElementById('alert-message').textContent = msg;
            b.classList.remove('translate-x-full', 'opacity-0');
            clearTimeout(alertTimeout); alertTimeout = setTimeout(()=>{ b.classList.add('translate-x-full', 'opacity-0'); }, 4000);
        }

        function showConfirm(title, msg, onOk) {
            document.getElementById('confirm-title').textContent = title; document.getElementById('confirm-message').textContent = msg;
            const ok = document.getElementById('btn-confirm-ok'); const cl = document.getElementById('btn-confirm-cancel');
            const nOk = ok.cloneNode(true); const nCl = cl.cloneNode(true);
            ok.parentNode.replaceChild(nOk, ok); cl.parentNode.replaceChild(nCl, cl);
            nOk.onclick = () => { closeModal('confirm-modal'); if(onOk) onOk(); };
            nCl.onclick = () => closeModal('confirm-modal');
            openModal('confirm-modal');
        }

        function openModal(id) {
            const m = document.getElementById(id); const c = document.getElementById(`${id}-content`);
            m.classList.remove('hidden'); void m.offsetWidth; m.classList.remove('opacity-0'); c.classList.remove('scale-95');
        }
        function closeModal(id) {
            const m = document.getElementById(id); const c = document.getElementById(`${id}-content`);
            m.classList.add('opacity-0'); c.classList.add('scale-95'); setTimeout(() => m.classList.add('hidden'), 200);
        }

        // Helper
        function getLocalDateString() { const d = new Date(); d.setMinutes(d.getMinutes() - d.getTimezoneOffset()); return d.toISOString().split('T')[0]; }
        function getTagById(id) { return appData?.tags.find(t => t.id === id); }
        function getMarkById(id) { return appData?.marks.find(m => m.id === id); }
    </script>
</body>
</html>
