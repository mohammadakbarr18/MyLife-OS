{{-- Delete Confirmation Modal (matches todo delete design) --}}
<div x-show="deleteModalOpen" style="display: none;" class="relative z-[100]" role="dialog" aria-modal="true">
    {{-- Backdrop --}}
    <div x-show="deleteModalOpen"
         x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity z-[100]"></div>

    <div class="fixed inset-0 z-[110] w-screen overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            {{-- Panel --}}
            <div x-show="deleteModalOpen"
                 @click.away="closeDeleteModal()"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95"
                 class="relative transform overflow-hidden rounded-[2rem] bg-white shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-[400px] border border-white/60">

                <div class="bg-white px-5 pb-4 pt-6 sm:px-8 sm:pb-6 sm:pt-8">
                    <div class="flex flex-col items-center text-center">
                        {{-- Red Trash Icon --}}
                        <div class="flex h-12 w-12 sm:h-16 sm:w-16 flex-shrink-0 items-center justify-center rounded-xl sm:rounded-2xl bg-red-50 mb-3 sm:mb-5">
                            <svg class="h-6 w-6 sm:h-8 sm:w-8 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </div>
                        {{-- Title --}}
                        <h3 class="text-xl font-bold text-[#3E2723]" style="font-family: 'Poppins', sans-serif;">
                            Hapus Kategori
                        </h3>
                        {{-- Description --}}
                        <p class="text-sm text-gray-500 mt-2 leading-relaxed">
                            Apakah kamu yakin ingin menghapus
                            <span class="font-semibold text-[#3E2723]" x-text="deleteTarget.icon + ' ' + deleteTarget.name"></span>?
                            Tindakan ini tidak dapat dibatalkan.
                        </p>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="px-5 pb-5 pt-3 sm:px-8 sm:pb-8 sm:pt-4 flex items-center justify-center gap-3">
                    <button type="button" @click="closeDeleteModal()"
                            class="flex-1 inline-flex justify-center items-center rounded-2xl bg-gray-100 px-6 py-3 text-sm font-bold text-gray-600 hover:bg-gray-200 transition-all">
                        Batal
                    </button>
                    <button type="button" @click="confirmDelete()"
                            class="flex-1 inline-flex justify-center items-center rounded-2xl bg-red-500 px-6 py-3 text-sm font-bold text-white hover:bg-red-600 shadow-sm hover:shadow-md transition-all">
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
