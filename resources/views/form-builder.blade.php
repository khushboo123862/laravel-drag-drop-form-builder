<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drag & Drop Form Builder</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">

    <div x-data="formBuilderEngine()" class="min-h-screen flex flex-col justify-between">
        
        <header class="bg-white border-b border-gray-200 px-6 py-4 shadow-sm flex justify-between items-center">
            <h1 class="text-xl font-bold text-gray-900 tracking-tight">Frontend UI Developer Assignment</h1>
            <span class="text-xs bg-emerald-50 text-emerald-600 font-bold px-3 py-1 rounded-full border border-emerald-200 uppercase tracking-wider">Laravel Blade Core</span>
        </header>

        <main class="flex-1 max-w-[1400px] w-full mx-auto p-6 grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            
            <section class="lg:col-span-7 bg-white rounded-xl border border-gray-200 shadow-sm p-6 min-h-[650px] flex flex-col">
                <h2 class="text-lg font-semibold text-gray-700 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-cubes text-blue-500"></i> Drop Canvas
                </h2>

                <div class="flex-1 rounded-xl border-2 border-dashed p-4 relative flex flex-col gap-4"
                     :class="dragOver ? 'border-blue-500 bg-blue-50/40 shadow-inner' : 'border-gray-300 bg-gray-50/50'"
                     @dragover.prevent="dragOver = true"
                     @dragleave.prevent="dragOver = false"
                     @drop.prevent="handleCanvasDrop($event)">

                    <template x-if="placedFields.length === 0">
                        <div class="absolute inset-0 flex flex-col justify-center items-center text-gray-400 p-6 pointer-events-none text-center">
                            <i class="fa-solid fa-arrow-pointer-to-element text-4xl mb-3 text-gray-300 animate-bounce"></i>
                            <p class="font-medium text-sm">Drag elements from the right panel to build your form &rarr;</p>
                        </div>
                    </template>

                    <template x-for="(field, index) in placedFields" :key="field.id">
                        <div class="group relative bg-white border rounded-xl p-5 shadow-sm hover:shadow-md border-gray-200"
                             :class="selectedField && selectedField.id === field.id ? 'ring-2 ring-blue-500 border-transparent bg-blue-50/5' : ''"
                             draggable="true"
                             @dragstart="handleSortStart(index)"
                             @dragover.prevent="handleSortOver(index)"
                             @drop.prevent="handleSortDrop(index)">
                            
                            <div class="absolute top-3 right-3 flex items-center gap-1.5 opacity-0 group-hover:opacity-100 transition-opacity bg-white shadow-sm border rounded-lg p-1 z-10">
                                <button type="button" class="p-1.5 text-gray-400 hover:text-gray-600 cursor-move"><i class="fa-solid fa-grip-vertical text-xs"></i></button>
                                <button type="button" @click="openConfigurator(field)" class="p-1.5 text-blue-500 hover:bg-blue-50 rounded"><i class="fa-solid fa-pen text-xs"></i></button>
                                <button type="button" @click="duplicateField(field.id)" class="p-1.5 text-green-500 hover:bg-green-50 rounded"><i class="fa-solid fa-copy text-xs"></i></button>
                                <button type="button" @click="removeField(field.id)" class="p-1.5 text-red-500 hover:bg-red-50 rounded"><i class="fa-solid fa-trash-can text-xs"></i></button>
                            </div>

                            <div>
                                <template x-if="field.type === 'text'"><x-text ::label="field.label" ::placeholder="field.placeholder" ::required="field.required" ::cssClass="field.css_class" /></template>
                                <template x-if="field.type === 'checkbox'"><x-checkbox ::label="field.label" ::options="field.options" ::required="field.required" ::cssClass="field.css_class" /></template>
                                <template x-if="field.type === 'date'"><x-date ::label="field.label" ::required="field.required" ::cssClass="field.css_class" /></template>
                                <template x-if="field.type === 'email'"><x-email ::label="field.label" ::placeholder="field.placeholder" ::required="field.required" ::cssClass="field.css_class" /></template>
                                <template x-if="field.type === 'file'"><x-file ::label="field.label" ::required="field.required" ::cssClass="field.css_class" /></template>
                                <template x-if="field.type === 'number'"><x-number ::label="field.label" ::placeholder="field.placeholder" ::required="field.required" ::cssClass="field.css_class" /></template>
                                <template x-if="field.type === 'radio'"><x-radio ::label="field.label" ::options="field.options" ::required="field.required" ::cssClass="field.css_class" /></template>
                                <template x-if="field.type === 'textarea'"><x-textarea ::label="field.label" ::placeholder="field.placeholder" ::required="field.required" ::cssClass="field.css_class" /></template>
                                <template x-if="field.type === 'title'"><x-title ::label="field.label" ::placeholder="field.placeholder" ::cssClass="field.css_class" /></template>
                            </div>

                        </div>
                    </template>
                </div>
            </section>

            <section class="lg:col-span-5 bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden min-h-[650px] flex flex-col">
                <div class="flex border-b border-gray-200 bg-gray-50/50 p-1.5 gap-1">
                    <button type="button" @click="activeTab = 'add_fields'"
                            class="flex-1 py-2 px-4 font-bold text-xs rounded-lg transition-all uppercase flex items-center justify-center gap-2"
                            :class="activeTab === 'add_fields' ? 'bg-white shadow-sm text-blue-600 border border-gray-200' : 'text-gray-400'">
                        <i class="fa-solid fa-square-plus"></i> Add Fields
                    </button>
                    <button type="button" @click="if(selectedField) activeTab = 'field_options'"
                            class="flex-1 py-2 px-4 font-bold text-xs rounded-lg transition-all uppercase flex items-center justify-center gap-2"
                            :class="activeTab === 'field_options' ? 'bg-white shadow-sm text-blue-600 border border-gray-200' : 'text-gray-300'"
                            :disabled="!selectedField">
                        <i class="fa-solid fa-sliders"></i> Field Options
                    </button>
                </div>

                <div class="p-6 flex-1 overflow-y-auto">
                    <div x-show="activeTab === 'add_fields'" class="grid grid-cols-2 gap-3">
                        <template x-for="item in fieldPalette">
                            <div class="border border-gray-200 rounded-xl p-3 bg-white shadow-sm hover:border-blue-500 cursor-grab active:cursor-grabbing flex items-center gap-3 group"
                                 draggable="true" @dragstart="handleDragStart(item.type)">
                                <div class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-blue-50 group-hover:text-blue-600">
                                    <i :class="item.icon" class="text-xs"></i>
                                </div>
                                <span class="text-xs font-bold text-gray-600 uppercase tracking-wide" x-text="item.name"></span>
                            </div>
                        </template>
                    </div>

                    <div x-show="activeTab === 'field_options'">
                        <template x-if="selectedField">
                            <div class="space-y-4">
                                <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                                    <h3 class="font-bold text-gray-400 text-[10px] tracking-widest uppercase">Property Configurer</h3>
                                    <button @click="activeTab = 'add_fields'; selectedField = null" class="text-gray-400 font-bold">&times; Close</button>
                                </div>
                                
                                <div>
                                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Field Label / Heading text</label>
                                    <input type="text" x-model="selectedField.label" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
                                </div>

                                <template x-if="['text', 'number', 'email', 'textarea', 'title'].includes(selectedField.type)">
                                    <div>
                                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Placeholder Support Text</label>
                                        <input type="text" x-model="selectedField.placeholder" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
                                    </div>
                                </template>

                                <template x-if="['checkbox', 'radio'].includes(selectedField.type)">
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider">Configure Rows List Options</label>
                                        <div class="flex flex-col gap-2">
                                            <template x-for="(opt, idx) in selectedField.options">
                                                <div class="flex gap-2 items-center">
                                                    <input type="text" x-model="selectedField.options[idx]" class="w-full px-2 py-1 text-xs border border-gray-300 rounded-md">
                                                    <button type="button" @click="selectedField.options.splice(idx, 1)" class="text-red-500 font-bold">&times;</button>
                                                </div>
                                            </template>
                                        </div>
                                        <button type="button" @click="selectedField.options.push('New Row Option')" class="text-xs font-bold text-blue-500">+ Add Row Option</button>
                                    </div>
                                </template>

                                <div>
                                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Tailwind CSS Utility Class</label>
                                    <input type="text" x-model="selectedField.css_class" class="w-full px-3 py-2 border border-gray-300 rounded-md text-xs font-mono">
                                </div>

                                <template x-if="selectedField.type !== 'title'">
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl border border-gray-200">
                                        <span class="text-[10px] font-bold text-gray-500 uppercase">Apply Field Validation Required Rule</span>
                                        <input type="checkbox" x-model="selectedField.required" class="w-4 h-4 rounded text-blue-600 focus:ring-0">
                                    </div>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>
            </section>
        </main>

        <footer class="bg-white border-t border-gray-200 px-6 py-4 flex justify-between items-center shadow-lg">
            <button type="button" @click="clearCanvas()" class="px-5 py-2 border border-gray-300 text-gray-600 text-xs font-bold uppercase rounded-lg hover:bg-gray-50">Clear Workspace</button>
            <button type="button" @click="compileSchemaJSON()" class="px-6 py-2 bg-blue-600 text-white text-xs font-bold uppercase rounded-lg hover:bg-blue-700 shadow-md shadow-blue-200">Compile JSON Schema</button>
        </footer>
    </div>

    <script>
        function formBuilderEngine() {
            return {
                activeTab: 'add_fields',
                dragOver: false,
                draggedType: null,
                selectedField: null,
                sortDragIndex: null,
                placedFields: JSON.parse(localStorage.getItem('form_components_state')) || [],

                fieldPalette: [
                    { name: 'Text Input', type: 'text', icon: 'fa-solid fa-font' },
                    { name: 'Checkboxes Options', type: 'checkbox', icon: 'fa-solid fa-square-check' },
                    { name: 'Date Picker Picker', type: 'date', icon: 'fa-solid fa-calendar-days' },
                    { name: 'Email Address Address', type: 'email', icon: 'fa-solid fa-envelope' },
                    { name: 'File Upload Asset', type: 'file', icon: 'fa-solid fa-cloud-arrow-up' },
                    { name: 'Numeric Input', type: 'number', icon: 'fa-solid fa-hashtag' },
                    { name: 'Radio Select Toggles', type: 'radio', icon: 'fa-solid fa-circle-dot' },
                    { name: 'Text Area Large', type: 'textarea', icon: 'fa-solid fa-paragraph' },
                    { name: 'Section Head Title', type: 'title', icon: 'fa-solid fa-heading' }
                ],

                handleDragStart(type) { this.draggedType = type; },
                handleCanvasDrop(event) {
                    this.dragOver = false;
                    if (!this.draggedType) return;
                    
                    const meta = this.fieldPalette.find(f => f.type === this.draggedType);
                    const newFieldNode = {
                        id: 'node_' + Date.now(),
                        type: this.draggedType,
                        label: meta.name,
                        placeholder: this.draggedType === 'title' ? 'Subheading descriptions here...' : 'Enter value...',
                        required: false,
                        css_class: 'w-full',
                        options: ['checkbox', 'radio'].includes(this.draggedType) ? ['Option Alpha', 'Option Beta'] : []
                    };
                    this.placedFields.push(newFieldNode);
                    this.syncStorage();
                    this.draggedType = null;
                },
                openConfigurator(field) { this.selectedField = field; this.activeTab = 'field_options'; },
                duplicateField(id) {
                    const idx = this.placedFields.findIndex(f => f.id === id);
                    if (idx === -1) return;
                    const clone = JSON.parse(JSON.stringify(this.placedFields[idx]));
                    clone.id = 'node_' + Date.now();
                    clone.label += ' (Copy)';
                    this.placedFields.splice(idx + 1, 0, clone);
                    this.syncStorage();
                },
                removeField(id) {
                    if (confirm('Remove this field element?')) {
                        this.placedFields = this.placedFields.filter(f => f.id !== id);
                        if (this.selectedField && this.selectedField.id === id) { this.selectedField = null; this.activeTab = 'add_fields'; }
                        this.syncStorage();
                    }
                },
                handleSortStart(idx) { this.sortDragIndex = idx; },
                handleSortOver(idx) {
                    if (this.sortDragIndex === null || this.sortDragIndex === idx) return;
                    const node = this.placedFields.splice(this.sortDragIndex, 1)[0];
                    this.placedFields.splice(idx, 0, node);
                    this.sortDragIndex = idx;
                },
                handleSortDrop(idx) { this.sortDragIndex = null; this.syncStorage(); },
                syncStorage() { localStorage.setItem('form_components_state', JSON.stringify(this.placedFields)); },
                clearCanvas() {
                    if (confirm('Reset form canvas workspace?')) {
                        this.placedFields = []; this.selectedField = null; this.activeTab = 'add_fields';
                        localStorage.removeItem('form_components_state');
                    }
                },
                compileSchemaJSON() {
                    const output = JSON.stringify(this.placedFields, null, 4);
                    console.log(output);
                    alert("JSON Schema mapping exported cleanly inside browser console developer logs!");
                }
            }
        }
    </script>
</body>
</html>