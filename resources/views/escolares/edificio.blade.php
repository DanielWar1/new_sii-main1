@extends('layouts.plantilla')

@section('content')
<div class="card alturabloque">
    <header class="card-header">
        <p class="card-header-title">
            Edificios y Salones
        </p>
    </header>
    <div class="card-content">

        <div class="column buttons ">
            <a href="{{ route('home') }}" class="button is-danger"><i class="fa-solid fa-arrow-left"></i>Regresar</a>
            <button class="button is-info js-modal-trigger" data-target="modal-nvo-edificio"><i class="fa-solid fa-plus"></i>Nuevo Edificio</button>
            <button class="button is-info js-modal-trigger" data-target="modal-nvo-salon"><i class="fa-solid fa-plus"></i>Nuevo Salon</button>
        </div>

        @if (session('Correcto'))
        <div class="notification is-success">
            <button class="delete"></button>
            {{ session('Correcto') }}
        </div>
        @endif
        @if (session('Error'))
        <div class="notification is-danger">
            <button class="delete"></button>
            {{ session('Error') }}
        </div>
        @endif

        <div class="columns is-multiline is-mobile">
            <div class="column is-6-desktop is-6-tablet is-12-mobile">
                <!-- Primera card -->
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            Edificios
                        </p>
                    </header>
                    <div class="card-content">
                        <div class="columns is-multiline is-mobile">
                        </div>
                        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                            <thead>
                                <tr class="has-text-centered">
                                    <th>NOMBRE EDIFICIO</th>
                                    <th>DESCRIPCION</th>
                                    <th>OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($edificios as $item)
                                <tr>
                                    <td>{{$item->nombre_edificio}}</td>
                                    <td>{{$item->descripcion}}</td>

                                    <td>
                                        <div class="field is-grouped">
                                            <button class="button is-success js-modal-trigger" data-target="modal-{{$item->nombre_edificio}}"><i class="fa-solid fa-pen-to-square"></i></button>
                                            <form action="{{ route('EdificioEliminar', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="button is-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este Edificio?')">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </div>
                                        <div id="modal-{{$item->nombre_edificio}}" class="modal">
                                            <div class="modal-background"></div>
                                            <div class="modal-content">
                                                <div class="box">
                                                    <p class="title is-5 has-text-centered">Modificar Edificio</p>
                                                    <form method="POST" action="{{route('EdificioEditar', $item->id)}}">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="field is-4">
                                                            <label class="label">Nombre Edificio</label>
                                                            <input class="input" value="{{$item->nombre_edificio}}" name="UpNombreEdificio">
                                                        </div>
                                                        <div class="field is-4">
                                                            <label class="label">Descripcion Edificio</label>
                                                            <input class="input" value="{{$item->descripcion}}" name="UpDescripcionEdificio">
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
                    </div>
                </div>
            </div>
            <div class="column is-6-desktop is-6-tablet is-12-mobile">
                <!-- Segunda card -->
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            Salones
                        </p>
                    </header>
                    <div class="card-content">
                        <div class="columns is-multiline is-mobile">
                        </div>
                        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                            <thead>
                                <tr class="has-text-centered">
                                    <th>NOMBRE SALON</th>
                                    <th>ID EDIFICIO</th>
                                    <th>OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($salones as $salon)
                                <tr>
                                    <td>{{$salon->nombre_salon}}</td>
                                    <td>{{$salon->edificio->nombre_edificio}}</td>

                                    <td>
                                        <div class="field is-grouped">
                                            <button class="button is-success js-modal-trigger" data-target="modal-{{$salon->nombre_salon}}"><i class="fa-solid fa-pen-to-square"></i></button>
                                            <form action="{{ route('SalonesEliminar', $salon->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="button is-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este SALON?')">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </div>
                                        <div id="modal-{{$salon->nombre_salon}}" class="modal">
                                            <div class="modal-background"></div>
                                            <div class="modal-content">
                                                <div class="box">
                                                    <p class="title is-5 has-text-centered">Modificar Salon</p>
                                                    <form method="POST" action="{{route('SalonesEditar', $salon->id)}}">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="field is-4">
                                                            <label class="label">Nombre Salon</label>
                                                            <input class="input" value="{{$salon->nombre_salon}}" name="UpNombreSalon">
                                                        </div>
                                                        <div class="field is-4">
                                                            <label class="label">Edificio Id</label>
                                                            <input class="input" value="{{$salon->edificio_id}}" name="UpEdificioIdSalon">
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
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal crear nuevo edificio -->
        <div id="modal-nvo-edificio" class="modal">
            <div class="modal-background"></div>

            <div class="modal-content">
                <div class="box">
                    <p class="title is-5 has-text-centered">Agregar Edificio</p>
                    <form method="POST" action="{{ route('EdificioCrear') }}">
                        @csrf
                        @method('POST')
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Nombre del Edificio:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name="txtNombreEdif" value="{{ old('txtNombreEdif') }}">
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-key"></i>
                                    </span>
                                </div>
                                @error('txtNombreEdif')
                                <p class="help is-danger">Ingresa el Nombre del Edificio</p>
                                @enderror
                            </div>
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Descripción del Edificio:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name="txtDescripcionEdif" value="{{ old('txtDescripcionEdif') }}">
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                                @error('txtDescripcionEdif')
                                <p class="help is-danger">Ingresa la descripción del Edificio</p>
                                @enderror
                            </div>
                        </div>
                        <div class="has-text-centered">
                            <button class="button is-primary" type="submit"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar</button>
                        </div>
                    </form>
                </div>
            </div>

            <button class="modal-close is-large" aria-label="close"></button>
        </div>

        <!-- Modal crear nuevo salón -->
        <div id="modal-nvo-salon" class="modal">
            <div class="modal-background"></div>

            <div class="modal-content">
                <div class="box">
                    <p class="title is-5 has-text-centered">Agregar Salón</p>
                    <form method="POST" action="{{ route('SalonesCrear') }}">
                        @csrf
                        @method('POST')
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Nombre del Salón:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name="txtNombreSalon" value="{{ old('txtNombreSalon') }}">
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-key"></i>
                                    </span>
                                </div>
                                @error('txtNombreSalon')
                                <p class="help is-danger">Ingresa el Nombre del Salón</p>
                                @enderror
                            </div>
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">ID Edificio:</label>
                                <div class="control has-icons-left">
                                    <div class="select">
                                        <select name="txtEdificioIdSalon">
                                            @foreach ($edificios as $edificio)
                                            <option value="{{$edificio->id}}">{{ $edificio->nombre_edificios }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('txtEdificioIdSalon')
                                    <p class="help is-danger">Ingresa el ID del Edificio</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="has-text-centered">
                            <button class="button is-primary" type="submit"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar</button>
                        </div>
                    </form>
                </div>
            </div>

            <button class="modal-close is-large" aria-label="close"></button>
        </div>

    </div>

    @if ($errors->has('txtNombreEdif') || $errors->has('txtDescripcionEdif'))
    <script>
        document.getElementById('modal-nvo-edificio').classList.add('is-active');
    </script>
    @endif

    @if ($errors->has('txtNombreSalon') || $errors->has('txtEdificioIdSalon'))
    <script>
        document.getElementById('modal-nvo-salon').classList.add('is-active');
    </script>
    @endif

</div>
@endsection
