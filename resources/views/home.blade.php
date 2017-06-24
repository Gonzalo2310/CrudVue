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
                    <div class="column">
                        <a class="button is-success" @click="openModal('departure','create')">Agregar Departamento</a>
                    </div>
                </div>
                <div class="columns">
                    <div class="column">
                        <div v-if="!departures.length">
                            No hay departamentos
                        </div>
                        <table v-else class="table">
                            <thead>
                            <th>#</th>
                            <th>Titulo</th>
                            <th>Eliminar</th>
                            <th>Editar</th>
                            </thead>
                            <tbody>
                            <tr v-for="departure in departures">
                                <td>@{{ departure.id }}</td>
                                <td>@{{ departure.title }}</td>
                                <td @click="openModal('departure','delete',departure)">
                                    <i class="fa fa-ban" aria-hidden="true"></i>
                                </td>
                                <td @click="openModal('departure','update',departure)">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="column" v-if="menu==2">
                <div class="columns">
                    <div class="column text-center">
                        <h3>Cargos</h3>
                    </div>
                    <div class="column" v-if="departures.length">
                        <a class="button is-success" @click="openModal('position','create')">Agregar Cargo</a>
                    </div>
                    <div class="column" v-else>
                        <span class="text-danger">Debe existir un departamento por lo menos</span>
                    </div>
                </div>
                <div class="columns">
                    <div class="column">
                        <div v-if="!positions.length">
                            No hay Cargos
                        </div>
                        <table v-else class="table">
                            <thead>
                            <th>#</th>
                            <th>Titulo</th>
                            <th>Departamento</th>
                            <th>Eliminar</th>
                            <th>Editar</th>
                            </thead>
                            <tbody>
                            <tr v-for="position in positions">
                                <td>@{{ position.id }}</td>
                                <td>@{{ position.title }}</td>
                                <td>@{{ position.departure.title }}</td>
                                <td @click="openModal('position','delete',position)">
                                    <i class="fa fa-ban" aria-hidden="true"></i>
                                </td>
                                <td @click="openModal('position','update',position)">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="column" v-if="menu==3">
                <div class="columns">
                    <div class="column text-center">
                        <h3>Empleado</h3>
                    </div>
                    <div class="column" v-if="positions.length">
                        <a class="button is-success" @click="openModal('employee','create')">Agregar Empleado</a>
                    </div>
                    <div class="column" v-else>
                        <span class="text-danger">Debe existir un cargo por lo menos</span>
                    </div>
                </div>
                <div class="columns">
                    Tabla Empleados
                </div>
            </div>
        </div>
        <div class="columns margin0 text-center vertical-center personal-menu">
            <div class="column">Empleados 0</div>
            <div class="column">Departamentos @{{ departures.length }}</div>
            <div class="column">Cargo @{{ positions.length }}</div>
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
                    <p class="control" v-if="modalDeparture">
                        <input class="input" placeholder="Departamento" v-model="titleDeparture"
                               :readonly="modalDeparture==3">
                    </p>
                    <div v-show="errorTitleDeparture" class="columns text-center">
                        <div class="column text-center text-danger">
                            El nombre del Departamento no puede estar vacio
                        </div>
                    </div>
                    <p class="control" v-if="modalPosition">
                        <input class="input" placeholder="Cargo" v-model="titlePosition" :readonly="modalPosition==3">
                        <select class="select" :disabled="modalPosition==3" v-model="idDeparturePosition">
                            <option v-for="departure in  departures" :value="departure.id">@{{ departure.title }}
                            </option>
                        </select>
                    </p>
                    <div v-show="errorTitlePosition" class="columns text-center">
                        <div class="column text-center text-danger">
                            El nombre del Cargo no puede estar vacio
                        </div>
                    </div>
                    <p class="control" v-if="modalEmployee">
                        <input class="input" :readonly="modalEmployee==3" placeholder="Nombre" v-model="nameEmployee">
                        <input class="input" :readonly="modalEmployee==3" placeholder="Apellido"
                               v-model="lastnameEmployee">
                        <input class="input" :readonly="modalEmployee==3" placeholder="Correo" v-model="emailEmployee">
                        <birthdayPicker :birthday.sync="birthdayEmployee"></birthdayPicker>
                        <label>Departamento: </label>
                        <select class="select" :disabled="modalEmployee==3" v-model="idFilterDeparture">
                            <option v-for="departure in filterDeparture" :value="departure.id">@{{ departure.title }}
                            </option>
                        </select>
                        <label>Cargo: </label>
                        <select class="select" :disabled="modalEmployee==3" v-model="idFilterPosition">
                            <option v-for="position in filterPosition" :value="position.id">@{{ position.title }}
                            </option>
                        </select>
                    </p>
                    <div v-show="errorEmployee" class="columns text-center">
                        <div class="column text-center text-danger">
                            <div v-for="error in errorMessageEmployee">
                            @{{ error }}
                            </div>
                        </div>
                    </div>
                    <div class="columns button-content">
                        <div class="column">
                            <a class="button is-success" @click="createDeparture()" v-if="modalDeparture==1">Aceptar</a>
                            <a class="button is-success" @click="updateDeparture()" v-if="modalDeparture==2">Aceptar</a>
                            <a class="button is-success" @click="destroyDeparture()" v-if="modalDeparture==3">Aceptar</a>
                            <a class="button is-success" @click="createPosition()" v-if="modalPosition==1">Aceptar</a>
                            <a class="button is-success" @click="updatePosition()" v-if="modalPosition==2">Aceptar</a>
                            <a class="button is-success" @click="destroyPosition()" v-if="modalPosition==3">Aceptar</a>
                            <a class="button is-success" @click="createEmployee()" v-if="modalEmployee==1">Aceptar</a>
                            <a class="button is-success" @click="updateEmployee()" v-if="modalEmployee==2">Aceptar</a>
                            <a class="button is-success" @click="destroyEmployee()" v-if="modalEmployee==3">Aceptar</a>
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
            mounted: function () {
                this.allQuery();
            },
            data: {
                menu: 0,
                modalGeneral: 0,
                titleModal: '',
                messageModal: '',
                /***** Departure *****/
                modalDeparture: 0,
                titleDeparture: '',
                errorTitleDeparture: 0,
                departures: [],
                /********* Position ***********/
                positions: [],
                modalPosition: 0,
                titlePosition: '',
                errorTitlePosition: 0,
                idDeparturePosition: 0,
                idPosition: 0,
                /*************** Employee **********/
                idEmployee: 0,
                employee: [],
                modalEmployee: 0,
                nameEmployee: '',
                lastnameEmployee: '',
                emailEmployee: '',
                birthdayEmployee: '',
                idFilterDeparture: 0,
                filterDeparture: [],
                idFilterPosition: 0,
                filterPosition: [],
                errorEmployee: 0,
                errorMessageEmployee: [],
            },
            watch: {
                modalGeneral: function (value) {
                    if (!value) this.allQuery();
                },
                idFilterDeparture: function (value) {
                    let me = this;
                    this.filterDeparture.map(function (x) {
                        if (x.id === value) {
                            me.filterPosition = x.positions;
                            me.idFilterPosition = me.filterPosition[0].id;
                        }
                    });
                }
            },
            methods: {
                validateEmployee(){
                    this.errorEmployee=0;
                    this.errorMessageEmployee=[];
                    if (!this.nameEmployee) this.errorMessageEmployee.push('El nombre no puede estar vacio');
                    if (!this.lastnameEmployee) this.errorMessageEmployee.push("El apellido no puede estar vacio");
                    if (!this.emailEmployee) this.errorMessageEmployee.push('El correo electronico no puede estar vacio');
                    if (!this.birthdayEmployee) this.errorMessageEmployee.push('La fecha de nacimiento no puede estar vacia');
                    if (this.errorMessageEmployee.length) this.errorEmployee=1;
                    return this.errorEmployee;
                },
                allQuery() {
                    let me = this;
                    axios.get('{{route('allQuery')}}')
                        .then(function (response) {
                            let answer = response.data;
                            me.departures = answer.departures;
                            me.positions = answer.positions;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },
                createEmployee() {
                    if (this.validateEmployee()){
                        return;
                    }
                    let me=this;
                    axios.post('{{route('employeecreate')}}', {
                        'name':this.nameEmployee,
                        'lastname':this.lastnameEmployee,
                        'email':this.emailEmployee,
                        'birthday':this.birthdayEmployee,
                        'position':this.idFilterPosition
                    })
                        .then(function (response) {
                            me.errorMessageEmployee=[];
                            me.errorEmployee=0;
                            if (response.data.date){
                                me.errorEmployee=1;
                                me.errorMessageEmployee.push(response.data.date[0]);
                            }else {
                                me.nameEmployee = '';
                                me.lastnameEmployee = '';
                                me.emailEmployee = '';
                                me.birthdayEmployee = '';
                                me.idFilterPosition = 0;
                                me.errorEmployee = 0;
                                me.errorMessageEmployee = [];
                                me.modalEmployee = 0;
                                me.closeModal();
                            }
                        })
                        .catch(function (error) {
                            me.errorMessageEmployee=[];
                            me.errorEmployee=0;
                            if (error.response && error.response.status===500){
                                console.log(error.response.data)
                            }
                            if (error.response && error.response.status===422){
                                me.errorEmployee=1;
                                error.response.data.email.forEach(function(element){
                                    me.errorMessageEmployee.push(element);
                                });
                                console.clear();
                            }else {
                                console.log(error);
                            }

                        });
                },
                updateEmployee() {
                },
                destroyEmployee() {
                },
                updatePosition() {
                    if (this.titlePosition == '') {
                        this.errorTitlePosition = 1;
                        return;
                    }
                    let me = this;
                    axios.put('{{route('positionupdate')}}', {
                        'id': this.idPosition,
                        'title': this.titlePosition,
                        'departure': this.idDeparturePosition
                    })
                        .then(function (response) {
                            me.titlePosition = '';
                            me.errorTitlePosition = 0;
                            me.modalPosition = 0;
                            me.idDeparturePosition = 0;
                            me.idPosition = 0;
                            me.closeModal();
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },
                destroyPosition() {
                    let me = this;
                    axios.delete('{{url('/position/delete')}}' + '/' + this.idPosition)
                        .then(function (response) {
                            me.titlePosition = '';
                            me.errorTitlePosition = 0;
                            me.modalPosition = 0;
                            me.idDeparturePosition = 0;
                            me.idPosition = 0;
                            me.closeModal();
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },
                createPosition() {
                    if (this.titlePosition == '') {
                        this.errorTitlePosition = 1;
                        return;
                    }
                    let me = this;
                    axios.post('{{route('positioncreate')}}', {
                        'title': this.titlePosition,
                        'departure': this.idDeparturePosition
                    })
                        .then(function (response) {
                            me.titlePosition = '';
                            me.errorTitlePosition = 0;
                            me.modalPosition = 0;
                            me.idDeparturePosition = 0;
                            me.closeModal();
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },
                updateDeparture() {
                    if (this.titleDeparture == '') {
                        this.errorTitleDeparture = 1;
                        return;
                    }
                    let me = this;
                    axios.put('{{route('departureupdate')}}', {
                        'title': this.titleDeparture,
                        'id': this.idDeparture
                    })
                        .then(function (response) {
                            me.titleDeparture = '';
                            me.idDeparture = 0;
                            me.errorTitleDeparture = 0;
                            me.modalDeparture = 0;
                            me.closeModal();
                        })
                        .catch(function (error) {
                            console.log('error: ' + error);
                        });
                },
                closeModal() {
                    this.modalGeneral = 0;
                    this.titleModal = '';
                    this.messageModal = '';
                    this.modalDeparture = 0;
                    this.modalPosition = 0;
                    this.modalEmployee = 0;
                },
                destroyDeparture() {
                    let me = this;
                    axios.delete('{{url('/departure/delete')}}' + '/' + this.idDeparture)
                        .then(function (response) {
                            me.idDeparture = 0;
                            me.titleDeparture = '';
                            me.modalDeparture = 0;
                            me.closeModal();
                        })
                        .catch(function (error) {
                            console.log('error: ' + error);
                        });
                },
                createDeparture() {
                    if (this.titleDeparture == '') {
                        this.errorTitleDeparture = 1;
                        return;
                    }
                    let me = this;
                    axios.post('{{route('departurecreate')}}', {
                        'title': this.titleDeparture
                    })
                        .then(function (response) {
                            me.titleDeparture = '';
                            me.errorTitleDeparture = 0;
                            me.modalDeparture = 0;
                            me.closeModal();
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },
                openModal(type, action, data = []) {
                    switch (type) {
                        case "departure": {
                            switch (action) {
                                case 'create': {
                                    this.modalGeneral = 1;
                                    this.titleModal = 'Creación de Departamento';
                                    this.messageModal = 'Ingrese el titulo del departamento';
                                    this.modalDeparture = 1;
                                    this.titleDeparture = '';
                                    this.errorTitleDeparture = 0;
                                    break;
                                }
                                case 'update': {
                                    this.modalGeneral = 1;
                                    this.titleModal = 'Modificación de Departamento';
                                    this.messageModal = 'Modifique el titulo del departamento';
                                    this.modalDeparture = 2;
                                    this.titleDeparture = data['title'];
                                    this.errorTitleDeparture = 0;
                                    this.idDeparture = data['id'];
                                    break;
                                }
                                case 'delete': {
                                    this.titleModal = 'Eliminación del Departamento';
                                    this.messageModal = 'Titulo del departamento';
                                    this.modalDeparture = 3;
                                    this.modalGeneral = 1;
                                    this.titleDeparture = data['title'];
                                    this.idDeparture = data['id'];
                                    break;
                                }

                            }
                            break;
                        }
                        case "position": {
                            switch (action) {
                                case 'create': {
                                    this.modalGeneral = 1;
                                    this.titleModal = 'Creación de Cargo';
                                    this.messageModal = 'Ingrese el titulo del Cargo';
                                    this.modalPosition = 1;
                                    this.titlePosition = '';
                                    this.errorTitlePosition = 0;
                                    this.idDeparturePosition = this.departures[0].id;
                                    break;
                                }
                                case 'update': {
                                    this.modalGeneral = 1;
                                    this.titleModal = 'Modificacion del Cargo';
                                    this.messageModal = 'Ingrese el nuevo titulo';
                                    this.modalPosition = 2;
                                    this.titlePosition = data['title'];
                                    this.idPosition = data['id'];
                                    this.errorTitlePosition = 0;
                                    this.idDeparturePosition = data['departure']['id'];
                                    break;
                                }
                                case 'delete': {
                                    this.modalGeneral = 1;
                                    this.titleModal = 'Eliminacion de un Cargo';
                                    this.messageModal = 'Confirme';
                                    this.modalPosition = 3;
                                    this.titlePosition = data['title'];
                                    this.idPosition = data['id'];
                                    this.errorTitlePosition = 0;
                                    this.idDeparturePosition = data['departure']['id'];
                                    break;
                                }

                            }
                            break;
                        }
                        case "employee": {
                            switch (action) {
                                case 'create': {
                                    this.modalGeneral = 1;
                                    this.titleModal = 'Creación de Empleado';
                                    this.messageModal = 'Ingrese los datos del Empleado';
                                    this.modalEmployee = 1;
                                    this.nameEmployee = '';
                                    this.lastnameEmployee = '';
                                    this.emailEmployee = '';
                                    this.birthdayEmployee = '';
                                    this.filterDeparture = [];
                                    this.filterPosition = [];
                                    let me = this;
                                    this.departures.map(function (x) {
                                        if (x.positions.length) {
                                            if (me.filterDeparture.indexOf(x)) me.filterDeparture.push(x);
                                        }
                                    });
                                    if (this.filterDeparture.length) {
                                        this.idFilterDeparture = this.filterDeparture[0].id;
                                        this.filterPosition = this.filterDeparture[0].positions;
                                        this.idFilterPosition = this.filterDeparture[0].positions[0].id;
                                    } else {
                                        this.idFilterDeparture = 0;
                                        this.idFilterPosition = 0;
                                        this.filterPosition = [];
                                    }
                                    break;
                                }
                                case 'update': {
                                    break;
                                }
                                case 'delete': {
                                    break;
                                }

                            }
                            break;
                        }
                    }

                },
            },
        })
    </script>
@endsection