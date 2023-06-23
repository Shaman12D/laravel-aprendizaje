<template>
    <div>
        <o-field  label="Título">
            <o-input value=""></o-input>
        </o-field>
        <o-field  label="Descripción">
            <o-input type="textarea" value=""></o-input>
        </o-field>
        <o-field  label="Contenido">
            <o-input type="textarea" value=""></o-input>
        </o-field>
        <o-field  label="Categoría">
            <o-select placeholder="Seleccionar categoría">
                <option value="">Cate1</option>
            </o-select>
        </o-field>
        <o-field  label="Posted">
            <o-select placeholder="Seleccionar estado">
                <option value="yes">Yes</option>
                <option value="not">Not</option>
            </o-select>
        </o-field>
        <o-button variant="primary">Enviar</o-button>
    </div>
</template>
