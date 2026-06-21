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
                                        <i class="fas fa-inbox text-4xl text-gray-400 mb-3 block"></i>
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
                        <button onclick="editItem(${item.id})" class="text-indigo-600 hover:text-indigo-800 p-1 rounded-full" title="Editar">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="deleteItem(${item.id})" class="text-red-500 hover:text-red-700 p-1 rounded-full" title="Eliminar">
                            <i class="fas fa-trash-alt"></i>
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
    if (itemCounterSpan) itemCounterSpan.textContent = items.length;
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
        submitBtn.innerHTML = `<i class="fas fa-save mr-2"></i> Actualizar`;
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
    submitBtn.innerHTML = `<i class="fas fa-save mr-2"></i> Guardar elemento`;
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