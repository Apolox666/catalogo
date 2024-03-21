<h1>{{ $activity->name }}</h1>
<p>Grupo: {{ $activity->group->name }}</p>
<p>Responsables:</p>
<ul>
    @foreach($activity->group->responsibles as $responsible)
        <li>{{ $responsible->name }}</li>
    @endforeach
</ul>
<p>Servicio: {{ $activity->group->service->name }}</p>
<p>Subproceso: {{ $activity->group->service->subprocess->name }}</p>
