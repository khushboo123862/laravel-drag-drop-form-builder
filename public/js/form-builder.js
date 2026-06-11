document.addEventListener("DOMContentLoaded", () => {
    const dropZone = document.getElementById("drop-zone");
    const nextBtn = document.getElementById("next-btn");
    let formSchema = [];

    document.querySelectorAll("[draggable=true]").forEach(tile => {
        tile.addEventListener("dragstart", e => {
            e.dataTransfer.setData("field-type", tile.dataset.type);
        });
    });

    dropZone.addEventListener("dragover", e => e.preventDefault());
    dropZone.addEventListener("drop", e => {
        e.preventDefault();
        const type = e.dataTransfer.getData("field-type");

        const field = { id: Date.now(), type: type, label: type + " field" };
        formSchema.push(field);

        const fieldEl = document.createElement("div");
        fieldEl.className = "p-4 border rounded mb-2 bg-white flex justify-between items-center";
        fieldEl.innerHTML = `<span>${field.label}</span>
            <div>
                <button>✏️</button>
                <button>📑</button>
                <button>🗑️</button>
            </div>`;
        dropZone.appendChild(fieldEl);
    });

    nextBtn.addEventListener("click", () => {
        alert(JSON.stringify(formSchema, null, 2));
    });
});
