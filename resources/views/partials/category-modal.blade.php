{{-- Category Add/Edit Modal (reusable partial) --}}
<div x-show="modalOpen" style="display: none;" class="relative z-[100]" aria-labelledby="category-modal-title" role="dialog" aria-modal="true">
    {{-- Backdrop --}}
    <div x-show="modalOpen"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity z-[100]"></div>

    <div class="fixed inset-0 z-[110] w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            {{-- Panel --}}
            <div x-show="modalOpen"
                 @click.away="closeModal()"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95"
                 class="relative transform overflow-hidden rounded-[2rem] bg-white text-left shadow-2xl transition-all sm:my-8 w-full sm:max-w-[420px] border border-white/60">

                <form :action="formAction" method="POST">
                    @csrf
                    <template x-if="isEditing">
                        <input type="hidden" name="_method" value="PUT">
                    </template>
                    <input type="hidden" name="type" :value="categoryType">

                    <div class="bg-white px-8 pb-8 pt-8 relative">
                        {{-- Close --}}
                        <button type="button" @click="closeModal()" class="absolute top-6 right-6 p-2 rounded-full text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition-colors">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>

                        <div class="flex flex-col items-center">
                            {{-- Header Icon --}}
                            <div class="w-16 h-16 rounded-3xl bg-gradient-to-br from-[#FCE2CE] to-[#F5D0B0] flex items-center justify-center shadow-sm mb-5">
                                <svg class="w-8 h-8 text-[#5F402D]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                                </svg>
                            </div>

                            <h3 class="text-2xl font-extrabold text-[#3E2723] tracking-tight" id="category-modal-title" style="font-family: 'Poppins', sans-serif;"
                                x-text="isEditing ? 'Edit Category' : 'New Category'"></h3>
                            <p class="text-sm text-gray-500 mt-1" x-text="isEditing ? 'Update the details below' : 'Create a custom category'"></p>

                            <div class="mt-8 space-y-5 text-left w-full">
                                {{-- Emoji Icon Input --}}
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Icon</label>
                                    <input type="text" name="icon" x-model="form.icon" required maxlength="10"
                                           placeholder="Paste an emoji here"
                                           class="block w-full rounded-[1.25rem] bg-gray-50 border border-gray-200/80 py-3.5 px-5 text-2xl text-center placeholder:text-gray-400 placeholder:text-sm hover:bg-gray-100/50 focus:bg-white focus:ring-4 focus:ring-[#FCE2CE]/50 focus:border-[#FCE2CE] transition-all shadow-sm">
                                    {{-- Quick Pick Emoji Row --}}
                                    <div class="flex items-center gap-1.5 mt-2.5 ml-1 flex-wrap">
                                        <span class="text-xs text-gray-400 mr-0.5">Quick pick:</span>
                                        <template x-for="e in ['💰','💼','🎉','🍔','🚗','📄','🎮','🛍️','🏠','💊','📚','✈️']" :key="e">
                                            <button type="button" @click="form.icon = e"
                                                    class="w-8 h-8 rounded-xl text-base hover:bg-[#FCE2CE]/50 hover:scale-110 transition-all duration-150 flex items-center justify-center"
                                                    :class="form.icon === e ? 'bg-[#FCE2CE] ring-2 ring-[#F5D0B0] scale-110' : 'bg-gray-100/60'"
                                                    x-text="e">
                                            </button>
                                        </template>
                                    </div>
                                </div>

                                {{-- Category Name Input --}}
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Name</label>
                                    <input type="text" name="name" x-model="form.name" required maxlength="50"
                                           placeholder="Salary, Food, Transport..."
                                           class="block w-full rounded-[1.25rem] bg-gray-50 border border-gray-200/80 py-3.5 px-5 text-gray-900 text-sm font-medium placeholder:text-gray-400 hover:bg-gray-100/50 focus:bg-white focus:ring-4 focus:ring-[#FCE2CE]/50 focus:border-[#FCE2CE] transition-all shadow-sm">
                                </div>

                                {{-- Live Preview --}}
                                <div x-show="form.icon || form.name" x-transition
                                     class="flex items-center gap-3 px-4 py-3 rounded-2xl bg-[#FEF6EF] border border-[#FCE2CE]/40">
                                    <span class="text-xl leading-none" x-text="form.icon || '❓'"></span>
                                    <span class="text-sm font-semibold text-[#3E2723]" x-text="form.name || 'Category name'"></span>
                                    <span class="ml-auto text-[10px] font-medium text-gray-400 uppercase tracking-wide">Preview</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="bg-gray-50/80 px-8 py-6 sm:flex sm:flex-row-reverse sm:px-8 border-t border-gray-100/80">
                        <button type="submit"
                                class="inline-flex w-full justify-center items-center gap-2 rounded-2xl bg-[#3E2723] px-8 py-3.5 text-sm font-bold text-white shadow-lg shadow-[#3E2723]/20 hover:bg-[#2A1A18] hover:-translate-y-0.5 sm:ml-3 sm:w-auto transition-all focus:ring-4 focus:ring-[#FCE2CE]/80"
                                x-text="isEditing ? 'Update Category' : 'Save Category'">
                        </button>
                        <button type="button" @click="closeModal()"
                                class="mt-3 inline-flex w-full justify-center items-center rounded-2xl bg-white px-8 py-3.5 text-sm font-bold text-gray-700 shadow-sm border border-gray-200 hover:bg-gray-50 hover:text-gray-900 sm:mt-0 sm:w-auto transition-all">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
