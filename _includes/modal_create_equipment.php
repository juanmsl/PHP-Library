<section class="pw-modal" id="modal-create-equipment-target">
    <span class="pw-modal-close pwi pwi-times-circle" id="modal-create-equipment-target-close"></span>
    <section class="pw-form-container">
        <form class="pw-form" id="create-equipment-form">
            <h1 class="pw-form-title">Agregar un equipo</h1>
            <section class="modal-image-preview">
                <img id="modal-equipment-image-preview"></img>
            </section>
            <input type="text" name="name" class="pw-form-item" placeholder="Nombre del equipo" required />
            <input type="number" name="serial_number" class="pw-form-item" placeholder="Número serial" required />
            <input type="text" name="manufacturer" class="pw-form-item" placeholder="Fabricante" required />
            <input type="number" name="quantity" class="pw-form-item" placeholder="Cantidad" required />
            <button class="pw-form-file-container pw-button thin transparent">
                Subir imagen
                <input type="file" name="image_equipment" class="pw-form-file" placeholder="Imagen" id="modal-image-input" required />
            </button>
            
            <input type="hidden" name="create-equipment-form"/>
            <output class="pw-form-message" id="create-equipment-form-message"></output>
            <button class="pw-form-button">Crear equipo</button>
        </form>
    </section>
</section>