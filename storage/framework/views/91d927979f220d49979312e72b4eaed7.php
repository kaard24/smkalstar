

<?php $__env->startSection('title', 'Struktur Organisasi - Admin Panel'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto">
    <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Struktur Organisasi</h1>
            <p class="text-slate-600">Kelola struktur organisasi sekolah dengan section dan anggota.</p>
        </div>
        <button onclick="openSectionModal()" class="btn btn-primary shadow-md hover:shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah Section
        </button>
    </div>

    <?php if(session('success')): ?>
    <div class="mb-6 p-4 bg-[#047857]/10 border border-[#047857]/20 text-[#047857] rounded-xl flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
    <div class="mb-6 p-4 bg-[#991B1B]/10 border border-[#991B1B]/20 text-[#991B1B] rounded-xl">
        <ul class="list-disc pl-5 space-y-1">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>

    <?php if($sections->isEmpty()): ?>
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-12 text-center">
        <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        <h3 class="text-lg font-semibold text-slate-700 mb-2">Belum Ada Section</h3>
        <p class="text-slate-500 mb-4">Mulai dengan menambahkan section pertama, misalnya "Tenaga Pendidik".</p>
        <button onclick="openSectionModal()" class="btn btn-primary shadow-md hover:shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah Section Pertama
        </button>
    </div>
    <?php else: ?>
    <div class="space-y-6">
        <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
            
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50 flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <span class="bg-[#4276A3]/10 text-[#4276A3] p-2 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </span>
                    <div>
                        <h2 class="font-semibold text-slate-800"><?php echo e($section->nama); ?></h2>
                        <span class="text-xs text-slate-500"><?php echo e($section->members->count()); ?> anggota · Urutan: <?php echo e($section->urutan); ?></span>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button onclick="openMemberModal(<?php echo e($section->id); ?>, '<?php echo e(addslashes($section->nama)); ?>')" class="btn btn-sm btn-primary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Tambah Anggota
                    </button>
                    <button onclick="openEditSectionModal(<?php echo e($section->id); ?>, '<?php echo e(addslashes($section->nama)); ?>', <?php echo e($section->urutan); ?>)" class="btn-icon btn-icon-edit btn-icon-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </button>
                    <form action="<?php echo e(route('admin.struktur-organisasi.section.destroy', $section->id)); ?>" method="POST" class="inline" onsubmit="return confirm('Hapus section ini beserta semua anggotanya?')">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn-icon btn-icon-delete btn-icon-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </form>
                </div>
            </div>

            
            <div class="p-6">
                <?php if($section->members->isEmpty()): ?>
                <div class="bg-slate-50 border-2 border-dashed border-slate-200 rounded-xl p-8 text-center">
                    <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    <p class="text-slate-500 text-sm">Belum ada anggota di section ini</p>
                </div>
                <?php else: ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <?php $__currentLoopData = $section->members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-slate-50 rounded-xl p-4 text-center relative group">
                        
                        <div class="absolute top-2 right-2 flex gap-1 opacity-0 group-hover:opacity-100 transition">
                            <button onclick="openEditMemberModal(<?php echo e($member->id); ?>, '<?php echo e(addslashes($member->nama)); ?>', '<?php echo e(addslashes($member->keterangan ?? '')); ?>', <?php echo e($member->urutan); ?>, '<?php echo e($member->foto_url ?? ''); ?>')" class="btn-icon btn-icon-edit btn-icon-sm">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </button>
                            <form action="<?php echo e(route('admin.struktur-organisasi.member.destroy', $member->id)); ?>" method="POST" class="inline" onsubmit="return confirm('Hapus anggota ini?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn-icon btn-icon-delete btn-icon-sm">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>

                        
                        <div class="w-24 h-24 mx-auto mb-3 rounded-full overflow-hidden bg-slate-200 flex items-center justify-center">
                            <?php if($member->foto_url): ?>
                            <img src="<?php echo e($member->foto_url); ?>" alt="<?php echo e($member->nama); ?>" class="w-full h-full object-cover" loading="lazy" decoding="async">
                            <?php else: ?>
                            <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            <?php endif; ?>
                        </div>

                        
                        <h4 class="font-semibold text-slate-800 text-sm"><?php echo e($member->nama); ?></h4>
                        <?php if($member->keterangan): ?>
                        <p class="text-slate-500 text-xs mt-1"><?php echo e($member->keterangan); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>

    <div class="mt-6 flex justify-end">
        <a href="<?php echo e(url('/profil')); ?>#struktur-organisasi" target="_blank" class="btn btn-outline-secondary btn-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
            Lihat Halaman Publik
        </a>
    </div>
</div>


<div id="sectionModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-black/50 transition-opacity" onclick="closeSectionModal()"></div>
        <div class="relative bg-white rounded-2xl shadow-xl max-w-md w-full p-6 z-10">
            <h3 id="sectionModalTitle" class="text-lg font-bold text-slate-800 mb-4">Tambah Section</h3>
            <form id="sectionForm" method="POST">
                <?php echo csrf_field(); ?>
                <div id="sectionMethodField"></div>
                <div class="space-y-4">
                    <div>
                        <label for="section_nama" class="block text-sm font-medium text-slate-700 mb-1">Nama Section</label>
                        <input type="text" id="section_nama" name="nama" required
                            class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-[#4276A3] focus:border-[#4276A3] transition"
                            placeholder="Contoh: Tenaga Pendidik">
                    </div>
                    <div>
                        <label for="section_urutan" class="block text-sm font-medium text-slate-700 mb-1">Urutan</label>
                        <input type="number" id="section_urutan" name="urutan" min="0"
                            class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-[#4276A3] focus:border-[#4276A3] transition"
                            placeholder="0">
                    </div>
                </div>
                <div class="mt-6 flex gap-3 justify-end">
                    <button type="button" onclick="closeSectionModal()" class="btn btn-secondary">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary shadow-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="memberModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-black/50 transition-opacity" onclick="closeMemberModal()"></div>
        <div class="relative bg-white rounded-2xl shadow-xl max-w-md w-full p-6 z-10">
            <h3 id="memberModalTitle" class="text-lg font-bold text-slate-800 mb-4">Tambah Anggota</h3>
            <form id="memberForm" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div id="memberMethodField"></div>
                <input type="hidden" id="member_section_id" name="section_id">
                <div class="space-y-4">
                    <div>
                        <label for="member_nama" class="block text-sm font-medium text-slate-700 mb-1">Nama</label>
                        <input type="text" id="member_nama" name="nama" required
                            class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-[#4276A3] focus:border-[#4276A3] transition"
                            placeholder="Nama lengkap">
                    </div>
                    <div>
                        <label for="member_keterangan" class="block text-sm font-medium text-slate-700 mb-1">Keterangan/Jabatan</label>
                        <input type="text" id="member_keterangan" name="keterangan"
                            class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-[#4276A3] focus:border-[#4276A3] transition"
                            placeholder="Contoh: Kepala Sekolah">
                    </div>
                    <div>
                        <label for="member_foto" class="block text-sm font-medium text-slate-700 mb-1">Foto</label>
                        <div id="memberFotoPreview" class="mb-2 hidden">
                            <img id="memberFotoImg" src="" alt="Preview" class="w-20 h-20 rounded-full object-cover mx-auto" loading="lazy" decoding="async">
                        </div>
                        <input type="file" id="member_foto" name="foto" accept="image/*"
                            class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-[#4276A3] focus:border-[#4276A3] transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#4276A3]/10 file:text-[#4276A3] hover:file:bg-[#4276A3]/20">
                        <p class="mt-1 text-xs text-slate-500">Format: JPG, PNG, WebP. Maks. 2MB.</p>
                    </div>
                    <div>
                        <label for="member_urutan" class="block text-sm font-medium text-slate-700 mb-1">Urutan</label>
                        <input type="number" id="member_urutan" name="urutan" min="0"
                            class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-[#4276A3] focus:border-[#4276A3] transition"
                            placeholder="0">
                    </div>
                </div>
                <div class="mt-6 flex gap-3 justify-end">
                    <button type="button" onclick="closeMemberModal()" class="btn btn-secondary">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary shadow-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Section Modal Functions
    function openSectionModal() {
        document.getElementById('sectionModalTitle').textContent = 'Tambah Section';
        document.getElementById('sectionForm').action = '<?php echo e(route("admin.struktur-organisasi.section.store")); ?>';
        document.getElementById('sectionMethodField').innerHTML = '';
        document.getElementById('section_nama').value = '';
        document.getElementById('section_urutan').value = '';
        document.getElementById('sectionModal').classList.remove('hidden');
    }

    function openEditSectionModal(id, nama, urutan) {
        document.getElementById('sectionModalTitle').textContent = 'Edit Section';
        document.getElementById('sectionForm').action = '/admin/struktur-organisasi/section/' + id;
        document.getElementById('sectionMethodField').innerHTML = '<?php echo method_field("PUT"); ?>';
        document.getElementById('section_nama').value = nama;
        document.getElementById('section_urutan').value = urutan;
        document.getElementById('sectionModal').classList.remove('hidden');
    }

    function closeSectionModal() {
        document.getElementById('sectionModal').classList.add('hidden');
    }

    // Member Modal Functions
    function openMemberModal(sectionId, sectionName) {
        document.getElementById('memberModalTitle').textContent = 'Tambah Anggota - ' + sectionName;
        document.getElementById('memberForm').action = '<?php echo e(route("admin.struktur-organisasi.member.store")); ?>';
        document.getElementById('memberMethodField').innerHTML = '';
        document.getElementById('member_section_id').value = sectionId;
        document.getElementById('member_nama').value = '';
        document.getElementById('member_keterangan').value = '';
        document.getElementById('member_urutan').value = '';
        document.getElementById('member_foto').value = '';
        document.getElementById('memberFotoPreview').classList.add('hidden');
        document.getElementById('memberModal').classList.remove('hidden');
    }

    function openEditMemberModal(id, nama, keterangan, urutan, fotoUrl) {
        document.getElementById('memberModalTitle').textContent = 'Edit Anggota';
        document.getElementById('memberForm').action = '/admin/struktur-organisasi/member/' + id;
        document.getElementById('memberMethodField').innerHTML = '<?php echo method_field("PUT"); ?>';
        document.getElementById('member_section_id').value = '';
        document.getElementById('member_nama').value = nama;
        document.getElementById('member_keterangan').value = keterangan;
        document.getElementById('member_urutan').value = urutan;
        document.getElementById('member_foto').value = '';
        
        if (fotoUrl) {
            document.getElementById('memberFotoImg').src = fotoUrl;
            document.getElementById('memberFotoPreview').classList.remove('hidden');
        } else {
            document.getElementById('memberFotoPreview').classList.add('hidden');
        }
        
        document.getElementById('memberModal').classList.remove('hidden');
    }

    function closeMemberModal() {
        document.getElementById('memberModal').classList.add('hidden');
    }

    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeSectionModal();
            closeMemberModal();
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views/admin/profil-struktur.blade.php ENDPATH**/ ?>