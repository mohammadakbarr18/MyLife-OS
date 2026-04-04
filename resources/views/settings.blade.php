@extends('layouts.app')

@section('title', 'Settings')
@section('page-title', 'Settings')
@section('page-subtitle', 'Kelola akun dan preferensimu')

@section('content')

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h2 class="text-lg font-bold text-[#3E2723]" style="font-family: 'Poppins', sans-serif;">
                Kelola Kategori
            </h2>
            <p class="text-sm text-gray-400 mt-0.5">Buat dan kelola kategori Income & Expense-mu</p>
        </div>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="mb-6 px-5 py-3.5 rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-700 text-sm font-semibold flex items-center gap-3 shadow-sm">
            <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- 2-Column Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- ======== INCOME CATEGORIES ======== --}}
        <div x-data="categoryManager('income', {{ $incomeCategories->toJson() }})" class="bg-white rounded-3xl shadow-sm border border-gray-100/50 overflow-hidden">
            {{-- Card Header --}}
            <div class="px-4 sm:px-6 py-4 sm:py-5 border-b border-gray-100/80 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-emerald-100 to-emerald-50 flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5 text-emerald-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-[#3E2723]" style="font-family: 'Poppins', sans-serif;">Kategori Income</h3>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $incomeCategories->count() }} kategori</p>
                    </div>
                </div>
                <button @click="openAddModal()"
                        class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-emerald-50 text-emerald-700 text-xs font-bold hover:bg-emerald-100 transition-all duration-200 shadow-sm border border-emerald-100/50">
                    <svg class="w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Tambah Baru
                </button>
            </div>

            {{-- Category List --}}
            <div class="px-3 sm:px-4 py-2.5 sm:py-3 space-y-1.5 max-h-[400px] overflow-y-auto">
                @forelse($incomeCategories as $cat)
                    <div class="group flex items-center justify-between px-4 py-3 rounded-2xl hover:bg-[#FEF6EF] transition-all duration-200">
                        <div class="flex items-center gap-3 flex-1 min-w-0 pr-2">
                            <span class="text-xl leading-none flex-shrink-0">{{ $cat->icon }}</span>
                            <span class="text-sm font-semibold text-[#3E2723] truncate">{{ $cat->name }}</span>
                        </div>
                        <div class="flex items-center gap-1 opacity-100 pointer-events-auto md:opacity-0 md:pointer-events-none md:group-hover:opacity-100 md:group-hover:pointer-events-auto md:transition-all md:duration-200">
                            {{-- Edit Button --}}
                            <button @click="openEditModal({{ $cat->id }}, '{{ addslashes($cat->name) }}', '{{ $cat->icon }}')"
                                    class="p-2 rounded-xl text-gray-400 hover:text-amber-600 hover:bg-amber-50 transition-all duration-200" title="Edit">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </button>
                            {{-- Delete Button --}}
                            <button @click="openDeleteModal({{ $cat->id }}, '{{ addslashes($cat->name) }}', '{{ $cat->icon }}')"
                                    class="p-2 rounded-xl text-gray-400 hover:text-red-500 hover:bg-red-50 transition-all duration-200" title="Delete">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center py-12 text-gray-400">
                        <svg class="w-10 h-10 mb-3 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                        </svg>
                        <p class="text-sm font-medium">Belum ada kategori income</p>
                        <p class="text-xs mt-1">Klik "Tambah Baru" untuk membuatnya</p>
                    </div>
                @endforelse
            </div>

            {{-- Add/Edit Modal --}}
            @include('partials.category-modal')
            {{-- Delete Confirmation Modal --}}
            @include('partials.category-delete-modal')
        </div>

        {{-- ======== EXPENSE CATEGORIES ======== --}}
        <div x-data="categoryManager('expense', {{ $expenseCategories->toJson() }})" class="bg-white rounded-3xl shadow-sm border border-gray-100/50 overflow-hidden">
            {{-- Card Header --}}
            <div class="px-6 py-5 border-b border-gray-100/80 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-red-100 to-red-50 flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-[#3E2723]" style="font-family: 'Poppins', sans-serif;">Kategori Expense</h3>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $expenseCategories->count() }} kategori</p>
                    </div>
                </div>
                <button @click="openAddModal()"
                        class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-red-50 text-red-600 text-xs font-bold hover:bg-red-100 transition-all duration-200 shadow-sm border border-red-100/50">
                    <svg class="w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Tambah Baru
                </button>
            </div>

            {{-- Category List --}}
            <div class="px-4 py-3 space-y-1.5 max-h-[400px] overflow-y-auto">
                @forelse($expenseCategories as $cat)
                    <div class="group flex items-center justify-between px-4 py-3 rounded-2xl hover:bg-[#FEF6EF] transition-all duration-200">
                        <div class="flex items-center gap-3 flex-1 min-w-0 pr-2">
                            <span class="text-xl leading-none flex-shrink-0">{{ $cat->icon }}</span>
                            <span class="text-sm font-semibold text-[#3E2723] truncate">{{ $cat->name }}</span>
                        </div>
                        <div class="flex items-center gap-1 opacity-100 pointer-events-auto md:opacity-0 md:pointer-events-none md:group-hover:opacity-100 md:group-hover:pointer-events-auto md:transition-all md:duration-200">
                            {{-- Edit Button --}}
                            <button @click="openEditModal({{ $cat->id }}, '{{ addslashes($cat->name) }}', '{{ $cat->icon }}')"
                                    class="p-2 rounded-xl text-gray-400 hover:text-amber-600 hover:bg-amber-50 transition-all duration-200" title="Edit">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </button>
                            {{-- Delete Button --}}
                            <button @click="openDeleteModal({{ $cat->id }}, '{{ addslashes($cat->name) }}', '{{ $cat->icon }}')"
                                    class="p-2 rounded-xl text-gray-400 hover:text-red-500 hover:bg-red-50 transition-all duration-200" title="Delete">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center py-12 text-gray-400">
                        <svg class="w-10 h-10 mb-3 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                        <p class="text-sm font-medium">Belum ada kategori expense</p>
                        <p class="text-xs mt-1">Klik "Tambah Baru" untuk membuatnya</p>
                    </div>
                @endforelse
            </div>

            {{-- Add/Edit Modal --}}
            @include('partials.category-modal')
            {{-- Delete Confirmation Modal --}}
            @include('partials.category-delete-modal')
        </div>

    </div>

    {{-- Alpine.js Category Manager Component --}}
    <script>
        function categoryManager(type, categories) {
            return {
                modalOpen: false,
                isEditing: false,
                editId: null,
                form: {
                    icon: '',
                    name: '',
                },

                // Delete confirmation state
                deleteModalOpen: false,
                deleteTarget: {
                    id: null,
                    name: '',
                    icon: '',
                },

                openAddModal() {
                    this.isEditing = false;
                    this.editId = null;
                    this.form.icon = '';
                    this.form.name = '';
                    this.modalOpen = true;
                },

                openEditModal(id, name, icon) {
                    this.isEditing = true;
                    this.editId = id;
                    this.form.icon = icon;
                    this.form.name = name;
                    this.modalOpen = true;
                },

                closeModal() {
                    this.modalOpen = false;
                },

                openDeleteModal(id, name, icon) {
                    this.deleteTarget.id = id;
                    this.deleteTarget.name = name;
                    this.deleteTarget.icon = icon;
                    this.deleteModalOpen = true;
                },

                closeDeleteModal() {
                    this.deleteModalOpen = false;
                },

                confirmDelete() {
                    this.$refs['deleteForm' + this.deleteTarget.id].submit();
                },

                get formAction() {
                    if (this.isEditing) {
                        return '/settings/categories/' + this.editId;
                    }
                    return '{{ route("settings.categories.store") }}';
                },

                get deleteAction() {
                    return '/settings/categories/' + this.deleteTarget.id;
                },

                get categoryType() {
                    return type;
                }
            }
        }
    </script>

    {{-- Hidden delete forms for each category --}}
    @foreach($incomeCategories->merge($expenseCategories) as $cat)
        <form x-ref="deleteForm{{ $cat->id }}" action="{{ route('settings.categories.destroy', $cat) }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    @endforeach

@endsection
