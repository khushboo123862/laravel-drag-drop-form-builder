# 🛠️ Full-Stack Drag & Drop Form Builder

A professional, high-performance, and responsive **Drag-and-Drop Form Builder** built strictly using the **Laravel Ecosystem (Blade Components)** and **Tailwind CSS**. This application features a dual-panel layout allowing seamless form creation, dynamic live property configuration, and instant evaluation-ready JSON schema compilation.

Developed as a showcase project focusing on modular architecture, clean code practices, and advanced frontend-to-backend state synchronization.

---

## 🚀 Core Features & Implementation

### 1. Interactive Drag & Drop Workflow
* **Dynamic Canvas:** A dashed-border drop zone that tracks field drops in real-time, updates layouts instantly, and features a clean placeholder state when empty.
* **Two-Column Field Palette:** A neatly structured sidebar containing draggable architectural, input, and selection fields.

### 2. Strict Laravel Blade Component Architecture
Adhering to strict production guidelines, **zero raw HTML inputs are used**. Every element is fully encapsulated within reusable Blade Components utilizing `@props`, `@if`, and `@foreach` loops for absolute maintainability:
* **Inputs:** Text Input, Numeric Input, Email Input (with format validation), Date Picker.
* **Selections:** Dropdown, Radio Select Toggles, Checkbox Groups (with add/remove row capabilities).
* **Structure & Files:** File Upload Asset, Text Area (Large Description), Section Head Title, Page Break.

### 3. Placed Field Shortcuts (In-Canvas Actions)
Once dropped onto the canvas, each element is rendered inside an interactive wrapper containing three vital shortcuts:
* **Drag Handle:** Re-orders the internal field-order array dynamically.
* **Edit Icon:** Switches the right panel to the **Property Configurer** sub-tab for active customization.
* **Duplicate Icon:** Instantly clones the field structure right below it, preserving all active state configurations.
* **Delete Icon:** Flawlessly removes the field from the current canvas layout state.

### 4. Live Property Configurer Panel
Clicking the edit icon opens a powerful structural sub-panel that mutates the active component's state with **live preview** synchronization:
* Modify Field Labels, Placeholders, Default Values, Required/Optional toggles, and inject custom Tailwind utility classes (`w-full`, etc.) seamlessly.

### 5. High-Fidelity JSON Schema Compilation
* Powered by a custom JavaScript engine that aggregates all layout states, clicking the **"COMPILE JSON SCHEMA"** button outputs a structured, clean JSON array of objects representing the fully custom-built form configuration inside the browser console or custom alert.

---

## 🛠️ Architecture & Tech Stack

* **Backend Engine:** Laravel 10.x / 11.x
* **Frontend Templating:** Laravel Blade (Component-Driven Architecture)
* **Styling Framework:** Tailwind CSS
* **State & Interaction Logic:** Vanilla JavaScript (Data-Transfer API)
* **Environment Setup:** Local development server powered by PHP Artisan

---

## 💾 System Installation & Local Setup

Prerequisites: Ensure you have **PHP >= 8.2**, **Composer**, and **Node.js** installed on your machine.

### 1. Clone the Repository
```bash
git clone https://github.com/khushboo123862/laravel-drag-drop-form-builder.git
cd laravel-drag-drop-form-builder
cd laravel-drag-drop-form-builder
``` <-- Ye teen backticks aapko line 55 par lagane hain
