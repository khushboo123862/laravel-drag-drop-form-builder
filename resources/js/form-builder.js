document.addEventListener("DOMContentLoaded", () => {
    const dropZone = document.getElementById("drop-zone");
    const nextBtn = document.getElementById("next-btn");
    let formSchema = [];

    // Drag start
    document.querySelectorAll("[draggable=true]").forEach(tile => {
        tile.addEventListener("dragstart", e => {
            e.dataTransfer.setData("field-type", tile.dataset.type);
        });
    });

    // Drop zone
    dropZone.addEventListener("dragover", e => e.preventDefault());
    dropZone.addEventListener("drop", e => {
        e.preventDefault();
        const type = e.dataTransfer.getData("field-type");

        // JSON object for field
        const field = {
            id: Date.now(),
            type: type,
            label: type + " field",
            placeholder: "Enter " + type,
            required: false,
            default: ""
        };

        formSchema.push(field);

        // UI render
        const fieldEl = document.createElement("div");
        fieldEl.className = "p-4 border rounded mb-2 bg-white shadow-sm flex justify-between items-center hover:bg-gray-50";
        fieldEl.innerHTML = `<span>${field.label}</span>`;
        dropZone.appendChild(fieldEl);
    });

    // Next button → JSON output
    nextBtn.addEventListener("click", () => {
        console.log(formSchema); // browser console me JSON
        alert(JSON.stringify(formSchema, null, 2)); // popup me JSON
    });
});
