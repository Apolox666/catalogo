@foreach($activities as $activity)
    <a href="{{ route('activity.show', $activity->id) }}">{{ $activity->name }}</a>
    <!-- Mostrar más información de la actividad si es necesario -->
@endforeach