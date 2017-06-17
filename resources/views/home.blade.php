@extends('template.layout')
@section('title', 'Home')
@section('content')
    <div class="container">
        <div class="columns personal-menu text-center vertical-center margin0">
            <div class="column">
                Zona de pruebas
            </div>
        </div>
        <div class="columns margin0 tile">
            <div class="column is-2 line-der">
                <aside class="menu">
                    <p class="menu-label">
                        Menu Principal
                    </p>
                    <ul class="menu-list">
                        <li @click="menu=0" class="hand-option"><a
                                    :class="{'is-active' : menu==0 }">Dashboard</a></li>
                        <li @click="menu=1" class="hand-option"><a :class="{'is-active' : menu==1 }">Departamentos</a>
                        </li>
                        <li @click="menu=2" class="hand-option"><a
                                    :class="{'is-active' : menu==2 }">Cargos</a></li>
                        <li @click="menu=3" class="hand-option"><a
                                    :class="{'is-active' : menu==3 }">Empleados</a></li>
                    </ul>
                </aside>
            </div>
            <div class="column personal-content" v-if="menu==0">
                <div class="columns text-center">
                    <div class="column">
                        <h3>Dashboard</h3>
                    </div>
                </div>
                <div class="columns text-center">
                    <div class="column">
                        <h1>Bienvenido</h1>
                    </div>
                </div>
            </div>
            <div class="column" v-if="menu==1">
                <div class="columns">
                    <div class="column text-center">
                        <h3>Departamentos</h3>
                    </div>
                </div>
                <div class="columns">
                    <div class="column">
                        Tabla de departamentos
                    </div>
                </div>
            </div>
            <div class="column" v-if="menu==2">
                <div class="columns">
                    <div class="column text-center">
                        <h3>Cargos</h3>
                    </div>
                </div>
                <div class="columns">
                    <div class="column">
                        Tabla Cargos
                    </div>
                </div>
            </div>
            <div class="column" v-if="menu==3">
                <div class="columns">
                    <div class="column text-center">
                        <h3>Empleado</h3>
                    </div>
                    <div class="column">
                        Tabla Empleados
                    </div>
                </div>
            </div>
        </div>
        <div class="columns margin0 text-center vertical-center personal-menu">
            <div class="column">Empleados 0</div>
            <div class="column">Departamentos 0</div>
            <div class="column">Cargo 0</div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal" :class="{'is-active' : modalGeneral}">
        <div class="modal-background"></div>
        <div class="modal-content">
            <div class="content">
                <h3 class="text-center">@{{titleModal}}</h3>
                <div class="field">
                    <label class="label">@{{messageModal}}</label>
                    <p class="control" v-if="modalDeparture!=0">
                        <input class="input" placeholder="Departamento" v-model="titleDeparture"
                               v-if="modalDeparture==1">
                    </p>
                    <div v-show="errorTitleDeparture" class="columns text-center">
                        <div class="column text-center text-danger">
                            El nombre del Departamento no puede estar vacio
                        </div>
                    </div>
                    <div class="columns button-content">
                        <div class="column">
                            <a class="button is-success" @click="createDeparture()" v-if="modalDeparture==1">Aceptar</a>
                        </div>
                        <div class="column">
                            <a class="button is-danger" @click="closeModal()">Cancelar</a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="modal-close" @click="closeModal()"></button>
        </div>
    </div>
    <!-- -->
@endsection
@section('script')
    <script>
        let elemento = new Vue({
            el: '.app',
            data: {
                menu: 0,
                modalGeneral:0,
                titleModal:'',
                messageModal:'',
                modalDeparture:0,
                titleDeparture:'',
                errorTitleDeparture:0
            },
            methods: {
                closeModal(){
                },
                createDeparture(){
                }
            },
        })
    </script>
@endsection