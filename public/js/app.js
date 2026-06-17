// public/js/app.js
const STORAGE_KEY = 'gestor_dinamico_items';

const itemsContainer = document.getElementById('itemsContainer');
const itemForm = document.getElementById('itemForm');
const titleInput = document.getElementById('title');
const contentInput = document.getElementById('content');
const editIdInput = document.getElementById('editId');
const submitBtn = document.getElementById('submitBtn');
const cancelEditBtn = document.getElementById('cancelEditBtn');
const itemCounterSpan = document.getElementById('itemCounter');
const clearAllBtn = document.getElementById('clearAllBtn');

function loadItemsFromStorage() {
    const stored = localStorage.getItem(STORAGE_KEY);
    if (stored) return JSON.parse(stored);
    const defaultItems = [
        { id: Date.now() + 1, title: '🎉 ¡Bienvenido!', content: 'Esto es un ejemplo de contenido persistente. Recarga la página y los datos seguirán aquí.' },
        { id: Date.now() + 2, title: '📌 Edición en tiempo real', content: 'Puedes añadir, editar o eliminar elementos. Todo se guarda automáticamente.' },
        { id: Date.now() + 3, title: '🚀 Próximo paso', content: 'Conectar con MySQL usando Laravel Eloquent.' }
    ];
    localStorage.setItem(STORAGE_KEY, JSON.stringify(defaultItems));
    return defaultItems;
}

let items = loadItemsFromStorage();

function persistAndRender() {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(items));
    renderItems();
    updateCounter();
}

function renderItems() {
    if (items.length === 0) {
        itemsContainer.innerHTML = `<div class="col-span-full text-center py-16 bg-gray-50 rounded-2xl border border-dashed border-gray-300">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 13h6m-3-3v6m-9 5h18a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                        <p class="mt-3 text-gray-500 font-medium">No hay elementos aún</p>
                                    </div>`;
        return;
    }
    const cardsHTML = items.map(item => `
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden card-hover flex flex-col h-full">
            <div class="p-5 flex-1">
                <div class="flex justify-between items-start gap-2">
                    <h4 class="text-xl font-bold text-gray-800 break-words pr-2">${escapeHtml(item.title)}</h4>
                    <div class="flex gap-1 shrink-0">
                        <button onclick="editItem(${item.id})" class="text-indigo-600 hover:text-indigo-800 p-1 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                        </button>
                        <button onclick="deleteItem(${item.id})" class="text-red-500 hover:text-red-700 p-1 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        </button>
                    </div>
                </div>
                <div class="mt-3 text-gray-600 whitespace-pre-wrap break-words text-sm leading-relaxed">${escapeHtml(item.content)}</div>
            </div>
        </div>
    `).join('');
    itemsContainer.innerHTML = cardsHTML;
}

function updateCounter() {
    if (itemCounterSpan) itemCounterSpan.innerText = items.length;
}

function escapeHtml(str) {
    if (!str) return '';
    return str.replace(/&/g, '&amp;')
              .replace(/</g, '&lt;')
              .replace(/>/g, '&gt;')
              .replace(/"/g, '&quot;')
              .replace(/'/g, '&#39;');
}

function addItem(title, content) {
    items.push({ id: Date.now(), title: title.trim(), content: content.trim() });
    persistAndRender();
}

function updateItem(id, newTitle, newContent) {
    const index = items.findIndex(item => item.id === id);
    if (index !== -1) {
        items[index] = { ...items[index], title: newTitle.trim(), content: newContent.trim() };
        persistAndRender();
    }
}

window.deleteItem = function(id) {
    if (confirm('¿Seguro que quieres eliminar este elemento?')) {
        items = items.filter(item => item.id !== id);
        persistAndRender();
        resetForm();
    }
};

window.editItem = function(id) {
    const item = items.find(i => i.id === id);
    if (item) {
        titleInput.value = item.title;
        contentInput.value = item.content;
        editIdInput.value = id;
        submitBtn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg> Actualizar`;
        submitBtn.classList.add('bg-emerald-600', 'hover:bg-emerald-700');
        submitBtn.classList.remove('bg-indigo-600', 'hover:bg-indigo-700');
        cancelEditBtn.classList.remove('hidden');
        document.querySelector('section:has(form)').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
};

function resetForm() {
    titleInput.value = '';
    contentInput.value = '';
    editIdInput.value = '';
    submitBtn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg> Guardar elemento`;
    submitBtn.classList.remove('bg-emerald-600', 'hover:bg-emerald-700');
    submitBtn.classList.add('bg-indigo-600', 'hover:bg-indigo-700');
    cancelEditBtn.classList.add('hidden');
}

itemForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const title = titleInput.value;
    const content = contentInput.value;
    if (!title.trim() || !content.trim()) {
        alert('❌ Completa ambos campos.');
        return;
    }
    const editId = editIdInput.value;
    if (editId) {
        updateItem(parseInt(editId), title, content);
        resetForm();
    } else {
        addItem(title, content);
        resetForm();
    }
});

cancelEditBtn.addEventListener('click', resetForm);

clearAllBtn.addEventListener('click', () => {
    if (items.length && confirm('⚠️ Esta acción eliminará TODOS los elementos. ¿Estás seguro?')) {
        items = [];
        persistAndRender();
        resetForm();
    }
});

renderItems();
updateCounter();