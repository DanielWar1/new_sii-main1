@extends('layouts.plantilla')
@section('content')
<div class="card alturabloque">
    <header class="card-header">
        <p class="card-header-title">
            Docentes
        </p>
    </header>
    <div class="card-content">
        <div class="columns is-multiline is-mobile">
            <div class="column buttons ">
                <a href="{{route('home')}}" class="button is-danger"><i class="fa-solid fa-arrow-left"></i>Regresar</a>
                <buttom class="button is-info js-modal-trigger" data-target="modal-nvo-docente"><i class="fa-solid fa-plus"></i>Nuevo Docente</a>
            </div>
        </div>
        @if (session('Correcto'))
        <div class="notification is-success">
            <button class="delete"></button>
            {{session('Correcto')}}
        </div>
        @endif
        @if (session('Error'))
        <div class="notification is-danger">
            <button class="delete"></button>
            {{session('Error')}}
        </div>
        @endif
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
            <tr class="has-text-centered">
                <th>RFC</th>
                <th>NOMBRE</th>
                <th class="is-hidden-mobile">A. PATERNO</th>
                <th class="is-hidden-mobile">A. MATERNO</th>
                <th class="is-hidden-mobile">CURP</th>
                <th class="is-hidden-mobile">EMAIL</th>
                <th>OPCIONES</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($docentes as $item)
                <tr>
                    <td>{{$item->rfc}}</td>
                    <td>{{$item->nombre}}</td>
                    <td class="is-hidden-mobile">{{$item->ap_paterno}}</td>
                    <td class="is-hidden-mobile">{{$item->ap_materno}}</td>
                    <td class="is-hidden-mobile">{{$item->curp}}</td>
                    <td class="is-hidden-mobile">{{$item->email}}</td>

                    <td>
                    <div class="field is-grouped">
                        <button class="button is-success js-modal-trigger" data-target="modal-{{$item->rfc}}"><i class="fa-solid fa-pen-to-square"></i></button>
                        <form action="{{ route('Docenteliminar', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="button is-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este Docente?')">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                    </div>
                    <div id="modal-{{$item->rfc}}" class="modal">
                        <div class="modal-background"></div>
                        <div class="modal-content">
                        <div class="box">
                            <p class="title is-5 has-text-centered">Modificar Docente</p>
                            <form method="POST" action="{{route('DocenteEditar', $item->id)}}"> {{-- item jala el id, route es de web --}}
                                @csrf
                                @method('PATCH')
                                <div class="field is-4">
                                    <label class="label">RFC</label>
                                    <input class="input" value="{{$item->rfc}}" name="UpRFCDocente">
                                </div>
                                <div class="field is-4">
                                    <label class="label">Nombre de Docente</label>
                                    <input class="input" value="{{$item->nombre}}" name="UpNombreDocente">
                                </div>
                                <div class="field is-4">
                                    <label class="label">Apellido Materno Docente</label>
                                    <input class="input" value="{{$item->ap_paterno}}" name="UpApPaternoDocente">
                                </div>
                                <div class="field is-4">
                                    <label class="label">Apellido Paterno Docente</label>
                                    <input class="input" value="{{$item->ap_materno}}" name="UpApMaternoDocente">
                                </div>
                                <div class="field is-4">
                                    <label class="label">CURP Docente</label>
                                    <input class="input" value="{{$item->curp}}" name="UpCurpDocente">
                                </div>
                                <div class="field is-4">
                                    <label class="label">Email Docente</label>
                                    <input class="input" value="{{$item->email}}" name="UpEmailDocente">
                                </div>
                                <div class="has-text-centered">
                                    <button class="button is-primary" type="submit">Modificar</button>
                                </div>
                            </form>
                        </div>
                        </div>
                        <button class="modal-close is-large" aria-label="close"></button>
                    </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
                    <!-- Modal crear  -->
        <div id="modal-nvo-docente" class="modal">
            <div class="modal-background"></div>
        
            <div class="modal-content">
                <div class="box">
                    <p class="title is-5 has-text-centered">Agregar Docente</p>
                    <form method="POST" action="{{ route('DocenteCrear') }}">
                        @csrf
                        @method('POST')
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">RFC del Docente:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name = "txtRFCDoc" value="{{ old('txtRFCDoc') }}">
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-key"></i>
                                    </span>
                                </div>
                            </div>
                            @error('txtRFCDoc')
                                <p class="help is-danger">Ingresa el RFC del Docente</p>
                            @enderror
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Nombre del Docente:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name = "txtNombreDoc" value="{{ old('txtNombreDoc') }}">
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                            </div>
                            @error('txtNombreDoc')
                                <p class="help is-danger">Ingresa el Nombre del Docente</p>
                            @enderror
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Apellido Paterno del Docente:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name = "txtApPaternoDoc" value="{{ old('txtApPaternoDoc') }}">
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                            </div>
                            @error('txtApPaternoDoc')
                                <p class="help is-danger">Ingresa el Apellido Paterno del Docente</p>
                            @enderror
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Apellido Materno del Docente:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name = "txtApMaternoDoc" value="{{ old('txtApMaternoDoc') }}">
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                            </div>
                            @error('txtApMaternoDoc')
                                <p class="help is-danger">Ingresa el Apellido Materno del Docente</p>
                            @enderror
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">CURP del Docente:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name = "txtCURPDoc" value="{{ old('txtCURPDoc') }}">
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                            </div>
                            @error('txtCURPDoc')
                                <p class="help is-danger">Ingresa el Apellido Materno del Docente</p>
                            @enderror
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Email del Docente:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="email" name = "txtEmailDoc" value="{{ old('txtEmailDoc') }}">
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                            </div>
                            @error('txtEmailDoc')
                                <p class="help is-danger">Ingresa el Email del Docente</p>
                            @enderror
                        </div>
                        <div class="has-text-centered">
                            <button class="button is-primary" type="submit"><i
                                    class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar</a>
                        </div>
                    </form>
                    <!-- Your content -->
                </div>
            </div>
        
            <button class="modal-close is-large" aria-label="close"></button>
        </div>

    </div>
    
    @if ($errors->has('txtRFCDoc')
    ||$errors->has('txtNombreDoc')
    ||$errors->has('txtApPaternoDoc')
    ||$errors->has('txtApMaternoDoc')
    ||$errors->has('txtCURPDoc')
    ||$errors->has('txtEmailDoc')
    )
    <script>
        document.getElementByid('modal-nvo-docente').classList.add('is-active');
    </script>
    @endif
@endsection