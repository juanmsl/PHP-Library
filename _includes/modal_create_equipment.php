<section class="pw-modal" id="modal-create-equipment-target">
    <span class="pw-modal-close pwi pwi-times-circle" id="modal-create-equipment-target-close"></span>
    <section class="pw-form-container">
        <form class="pw-form" id="create-equipment-form">
            <h1 class="pw-form-title">Agregar un equipo</h1>
            <input type="text" name="name" class="pw-form-item" placeholder="Nombre del equipo" required />
            <input type="number" name="serial_number" class="pw-form-item" placeholder="Número serial" required />
            <input type="text" name="manufacturer" class="pw-form-item" placeholder="Fabricante" required />
            <input type="number" name="quantity" class="pw-form-item" placeholder="Cantidad" required />
            
            <input type="hidden" name="create-equipment-form"/>
            <output class="pw-form-message" id="create-equipment-form-message"></output>
            <button class="pw-form-button">Crear equipo</button>
        </form>
    </section>
</section>