<script>
    import Datepicker from 'vue-datepicker'

    export default {
        props               : {
            today                  : {
                type                  : String,
                default               : '',
                required              : false
            }
        },
        data() {
            return {
                startTime: {
                    time: this.today
                },
                endtime: {
                    time: ''
                },
                option: {
                    type: 'day',
                    week: ['Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa', 'Do'],
                    month: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    format: 'DD-MM-YYYY',
                    placeholder: 'Fecha de nacimiento',
                    inputStyle: {
                        'display': 'inline-block',
                        'padding': '6px',
                        'line-height': '22px',
                        'font-size': '16px',
                        'border': '2px solid #fff',
                        'box-shadow': '0 1px 3px 0 rgba(0, 0, 0, 0.2)',
                        'border-radius': '2px',
                        'color': '#5F5F5F'
                    },
                    color: {
                        header: '#ccc',
                        headerText: '#2813ff'
                    },
                    buttons: {
                        ok: 'Aceptar',
                        cancel: 'Cancelar'
                    },
                    overlayOpacity: 0.5, // 0.5 as default
                    dismissible: true // as true as default
                },
            }
        },
        methods: {
            updateData() {
                this.$emit('update:birthday', this.startTime.time)
            },
        },
        components: {
            'date-picker': Datepicker
        }
    }
</script>
<template>
        <div class="content">
            <date-picker :date="startTime" :option="option"  v-on:change="updateData"></date-picker>
        </div>
</template>